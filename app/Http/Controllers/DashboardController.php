<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $eventIds = Event::where('user_id', $userId)->pluck('id');

        $totalEvents = $eventIds->count();

        $totalPendaftar = Registration::whereIn('event_id', $eventIds)->count();

        $totalPending = Registration::whereIn('event_id', $eventIds)
            ->where('status', 'pending')
            ->count();

        $totalDiterima = Registration::whereIn('event_id', $eventIds)
            ->where('status', 'diterima')
            ->count();

        $totalDitolak = Registration::whereIn('event_id', $eventIds)
            ->where('status', 'ditolak')
            ->count();

        $registrasiPerEvent = Event::where('user_id', $userId)
            ->has('registrations')
            ->withCount('registrations')
            ->orderBy('registrations_count', 'desc')
            ->take(5)
            ->get(['id', 'nama']);

        $eventLabels = $registrasiPerEvent->pluck('nama');
        $eventData   = $registrasiPerEvent->pluck('registrations_count');

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
