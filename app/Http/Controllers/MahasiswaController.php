<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //

    public function profile()
    {
        $user = auth()->user();
        return view('pages.mahasiswa.profile', compact('user'));
    }

    public function events()
    {
        $eventSaya = auth()->user()
            ->registeredEvents()
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.mahasiswa.events', compact('eventSaya'));
    }
}
