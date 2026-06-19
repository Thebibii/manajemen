<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua data event, diurutkan dari tanggal terdekat
        $events = Event::orderBy('tanggal', 'asc')->get();

        // Menambahkan atribut dinamis sisa_kuota ke setiap object event
        $events->each(function ($event) {
            $event->sisa_kuota = $event->sisaKuota();
        });

        // Mengembalikan view (sesuaikan nama file blade Anda, contoh: 'events.index')
        return view('welcome', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('panitia');
        // dd($event);
        // Menambahkan properti sisa_kuota untuk halaman detail jika diperlukan
        $event->sisa_kuota = $event->sisaKuota();
        $sudahDaftar = $event->registrations()->where('user_id', auth()->id())->first();
        // Mengembalikan view detail (contoh: 'events.show')
        return view('pages.event', compact('event', 'sudahDaftar'));
    }

    public function explore(Request $request)
    {
        $query = Event::query()
            ->when($request->search, function ($q, $search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            })
            ->when($request->periode, function ($q, $periode) {
                match ($periode) {
                    'bulan_ini'    => $q->whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year),
                    'bulan_depan'  => $q->whereMonth('tanggal', now()->addMonth()->month)->whereYear('tanggal', now()->addMonth()->year),
                    'minggu_ini'   => $q->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]),
                    'minggu_depan' => $q->whereBetween('tanggal', [now()->addWeek()->startOfWeek(), now()->addWeek()->endOfWeek()]),
                    default        => null,
                };
            });

        match ($request->urutan) {
            'waktu_terjauh' => $query->orderBy('tanggal', 'desc'),
            'nama_az'       => $query->orderBy('nama', 'asc'),
            'nama_za'       => $query->orderBy('nama', 'desc'),
            default         => $query->orderBy('tanggal', 'asc'), // waktu_terdekat
        };

        $events = $query->paginate(12)->withQueryString();

        $events->through(function ($event) {
            $event->sisa_kuota = $event->sisaKuota();
            return $event;
        });

        return view('pages.explore', compact('events'));
    }
}
