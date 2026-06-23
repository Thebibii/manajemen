<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
// app/Http/Controllers/RegistrationController.php
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function store(Event $event)
    {
        try {
            DB::transaction(function () use ($event) {
                // Lock row event agar request lain menunggu sampai transaction ini selesai
                $event = Event::lockForUpdate()->findOrFail($event->id);

                if ($event->registrations()->where('user_id', auth()->id())->exists()) {
                    throw new \Exception('Anda sudah mendaftar pada event ini.');
                }

                if ($event->jumlahDiterima() >= $event->kuota) {
                    throw new \Exception('Kuota event sudah penuh.');
                }

                Registration::create([
                    'event_id' => $event->id,
                    'user_id'  => auth()->id(),
                    'status'   => 'pending',
                ]);
            });

            return back()->with('success', 'Pendaftaran berhasil, menunggu konfirmasi panitia.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function indexAll(Request $request)
    {
        $query = Registration::with(['user', 'event'])
            ->whereHas('event', fn($q) => $q->where('user_id', auth()->id()));

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(15)->withQueryString();

        $events = auth()->user()->events()->orderBy('nama')->get();

        // 1 query untuk semua stats
        $statsRaw = Registration::whereHas('event', fn($q) => $q->where('user_id', auth()->id()))
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $stats = [
            'total'    => $statsRaw->sum(),
            'pending'  => $statsRaw->get('pending', 0),
            'diterima' => $statsRaw->get('diterima', 0),
            'ditolak'  => $statsRaw->get('ditolak', 0),
        ];

        return view('pages.panitia.registrations.index', compact('registrations', 'events', 'stats'));
    }

    public function indexForEvent(Event $event)
    {
        $registrations = $event->registrations()->with('user')->latest()->get();
        return view('registrations.peserta', compact('event', 'registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $registration->load('event');

        abort_if($registration->event->user_id !== auth()->id(), 403);

        $request->validate(['status' => 'required|in:diterima,ditolak,pending']);

        try {
            DB::transaction(function () use ($request, $registration) {
                if ($request->status === 'diterima' && $registration->status !== 'diterima') {
                    $event = Event::lockForUpdate()->findOrFail($registration->event_id);

                    if ($event->jumlahDiterima() >= $event->kuota) {
                        throw new \Exception('Kuota event sudah penuh, tidak bisa menerima peserta lagi.');
                    }
                }

                $registration->status = $request->status;

                if ($request->status === 'diterima' && !$registration->ticket_code) {
                    $registration->ticket_code = Str::upper(Str::random(10));
                }

                $registration->save();
            });

            return back()->with('success', 'Status pendaftaran diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function ticket(Registration $registration)
    {
        abort_if($registration->user_id !== auth()->id(), 403);
        abort_if($registration->status !== 'diterima', 404, 'Tiket belum tersedia.');
        $registration->load(['event', 'user']);
        return view('pages.mahasiswa.ticket', compact('registration'));
    }


    public function downloadTicket(Registration $registration)
    {
        abort_if($registration->user_id !== auth()->id(), 403);
        abort_if($registration->status !== 'diterima', 404, 'Tiket belum tersedia.');

        $registration->load(['event', 'user']);

        $pdf = Pdf::loadView('pages.mahasiswa.ticket-pdf', compact('registration'))
            ->setPaper([0, 0, 340, 520], 'portrait')
            ->setOption(['isRemoteEnabled' => true]);
        $filename = 'tiket-' . $registration->ticket_code . '.pdf';

        return $pdf->download($filename);
    }
}
