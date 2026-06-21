<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalPendaftar = Registration::count();
        $totalPending = Registration::where('status', 'pending')->count();
        $totalDiterima = Registration::where('status', 'diterima')->count();

        $registrasiPerEvent = Event::has('registrations')
            ->withCount('registrations')
            ->orderBy('registrations_count', 'desc')
            ->take(5)
            ->get(['id', 'nama']);

        $eventLabels = $registrasiPerEvent->pluck('nama');
        $eventData   = $registrasiPerEvent->pluck('registrations_count');

        $totalDitolak = Registration::where('status', 'ditolak')->count();

        return view('pages.dashboard', compact(
            'totalEvents',
            'totalPendaftar',
            'totalPending',
            'totalDiterima',
            'totalDitolak',
            'eventLabels',
            'eventData'
        ));
    }
}
