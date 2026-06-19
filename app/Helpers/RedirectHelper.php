<?php

namespace App\Helpers;

class RedirectHelper
{
    public static function afterLogin(): string
    {
        $user = auth()->user();

        if ($user?->isPanitia()) return route('dashboard');
        if ($user?->isMahasiswa()) return route('mahasiswa.profile');

        return route('home');
    }
}
