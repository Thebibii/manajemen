<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua data event, diurutkan dari tanggal terdekat
        $events = Event::withCount('registrations')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Mengembalikan view (sesuaikan nama file blade Anda, contoh: 'events.index')
        return view('welcome', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('panitia');
        $event->loadCount('registrations');
        // Menambahkan properti sisa_kuota untuk halaman detail jika diperlukan
        $sudahDaftar = $event->registrations()->where('user_id', auth()->id())->first();
        // Mengembalikan view detail (contoh: 'events.show')
        return view('pages.event', compact('event', 'sudahDaftar'));
    }

    public function explore(Request $request)
    {
        $query = Event::query()
            ->withCount('registrations')
            ->when($request->search, function ($q, $search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            })
            ->when($request->periode, function ($q, $periode) {
                $bulanDepan = now()->addMonth();
                $mingguDepan = now()->addWeek();

                match ($periode) {
                    'bulan_ini'    => $q->whereMonth('tanggal', now()->month)
                        ->whereYear('tanggal', now()->year),
                    'bulan_depan'  => $q->whereBetween('tanggal', [
                        $bulanDepan->startOfMonth(),
                        $bulanDepan->copy()->endOfMonth(),
                    ]),
                    'minggu_ini'   => $q->whereBetween('tanggal', [
                        now()->startOfWeek(),
                        now()->copy()->endOfWeek(),
                    ]),
                    'minggu_depan' => $q->whereBetween('tanggal', [
                        $mingguDepan->startOfWeek(),
                        $mingguDepan->copy()->endOfWeek(),
                    ]),
                    default        => null,
                };
            });

        match ($request->urutan) {
            'waktu_terjauh' => $query->orderBy('tanggal', 'desc'),
            'nama_az'       => $query->orderBy('nama', 'asc'),
            'nama_za'       => $query->orderBy('nama', 'desc'),
            default         => $query->orderBy('tanggal', 'asc'),
        };

        $events = $query->paginate(4)->withQueryString();

        return view('pages.explore', compact('events'));
    }
}
