<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

// app/Http/Controllers/RegistrationController.php
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function store(Event $event)
    {
        if ($event->registrations()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'Anda sudah mendaftar pada event ini.');
        }

        if ($event->jumlahDiterima() >= $event->kuota) {
            return back()->with('error', 'Kuota event sudah penuh.');
        }

        Registration::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran berhasil, menunggu konfirmasi panitia.');
    }

    // public function indexAll(Request $request)
    // {
    //     $query = Registration::with(['user', 'event'])
    //         ->whereHas('event', fn($q) => $q->where('user_id', auth()->id()));

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     if ($request->filled('event_id')) {
    //         $query->where('event_id', $request->event_id);
    //     }

    //     $registrations = $query->latest()->paginate(15)->withQueryString();

    //     $events = auth()->user()->events()->orderBy('nama')->get(); // untuk dropdown filter

    //     return view('pages.panitia.registrations.index', compact('registrations', 'events'));
    // }

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

        $registrations = $query->latest()
            ->paginate(15)
            ->withQueryString();

        $events = auth()->user()
            ->events()
            ->orderBy('nama')
            ->get();

        $stats = [
            'total' => Registration::whereHas(
                'event',
                fn($q) => $q->where('user_id', auth()->id())
            )->count(),

            'pending' => Registration::whereHas(
                'event',
                fn($q) => $q->where('user_id', auth()->id())
            )->where('status', 'pending')->count(),

            'diterima' => Registration::whereHas(
                'event',
                fn($q) => $q->where('user_id', auth()->id())
            )->where('status', 'diterima')->count(),

            'ditolak' => Registration::whereHas(
                'event',
                fn($q) => $q->where('user_id', auth()->id())
            )->where('status', 'ditolak')->count(),
        ];

        return view(
            'pages.panitia.registrations.index',
            compact(
                'registrations',
                'events',
                'stats'
            )
        );
    }

    public function indexForEvent(Event $event)
    {
        $registrations = $event->registrations()->with('user')->latest()->get();
        return view('registrations.peserta', compact('event', 'registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        abort_if($registration->event->user_id !== auth()->id(), 403);

        $request->validate(['status' => 'required|in:diterima,ditolak,pending']);

        if ($request->status === 'diterima' && $registration->status !== 'diterima') {
            $event = $registration->event;

            if ($event->jumlahDiterima() >= $event->kuota) {
                return back()->with('error', 'Kuota event sudah penuh, tidak bisa menerima peserta lagi.');
            }
        }

        $registration->status = $request->status;

        if ($request->status === 'diterima' && ! $registration->ticket_code) {
            $registration->ticket_code = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(10));
        }

        $registration->save();

        return back()->with('success', 'Status pendaftaran diperbarui.');
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

        // $pdf = Pdf::loadView('pages.mahasiswa.ticket-pdf', compact('registration'))
        //     ->setPaper([0, 0, 340, 520], 'portrait'); // ukuran custom mirip kartu tiket
        // $pdf = Pdf::loadView('pages.mahasiswa.ticket-pdf', compact('registration'))
        //     ->setPaper([0, 0, 340, 520], 'portrait')
        //     ->setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        // $pdf = Pdf::loadView('pages.mahasiswa.ticket-pdf', compact('registration'))
        //     ->setPaper([0, 0, 340, 520], 'portrait')
        //     ->setOption(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = Pdf::loadView('pages.mahasiswa.ticket-pdf', compact('registration'))
            ->setPaper([0, 0, 340, 520], 'portrait')
            ->setOption(['isRemoteEnabled' => true]);
        $filename = 'tiket-' . $registration->ticket_code . '.pdf';

        return $pdf->download($filename);
    }
}
