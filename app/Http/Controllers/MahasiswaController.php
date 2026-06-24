<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //

    public function profile()
    {
        $user = auth()->user();
        $title = __('messages.Profile');
        return view('pages.mahasiswa.profile', compact('user', 'title'));
    }

    public function events()
    {
        $query = auth()->user()
            ->registeredEvents()
            ->orderBy('tanggal', 'desc');

        if ($status = request('status')) {
            $query->wherePivot('status', $status);
        }

        $eventSaya = $query->get();
        $title = __('messages.Event Saya');
        return view('pages.mahasiswa.events', compact('eventSaya', 'title'));
    }
}
