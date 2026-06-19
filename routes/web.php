<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RegistrationController;

// dashboard pages
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/event/{event}', [HomeController::class, 'show'])->name('events.show');
Route::get('/explore', [HomeController::class, 'explore'])->name('explore');



// calender pages
Route::get('/calendar', function () {
    return view('pages.calender', ['title' => 'Calendar']);
})->name('calendar');

// profile pages
// Route::get('/profile', function () {
//     return view('pages.profile', ['title' => 'Profile']);
// })->name('profile');


// form pages
Route::get('/form-elements', function () {
    return view('pages.form.form-elements', ['title' => 'Form Elements']);
})->name('form-elements');

// tables pages
Route::get('/basic-tables', function () {
    return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
})->name('basic-tables');

// pages

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');

// error pages
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

// chart pages
Route::get('/line-chart', function () {
    return view('pages.chart.line-chart', ['title' => 'Line Chart']);
})->name('line-chart');

Route::get('/bar-chart', function () {
    return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
})->name('bar-chart');


// authentication pages
Route::get('/signin', function () {
    return view('pages.auth.signin', ['title' => 'Sign In']);
})->name('signin');

Route::get('/signup', function () {
    return view('pages.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

// ui elements pages
Route::get('/alerts', function () {
    return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
})->name('alerts');

Route::get('/avatars', function () {
    return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
})->name('avatars');

Route::get('/badge', function () {
    return view('pages.ui-elements.badges', ['title' => 'Badges']);
})->name('badges');

Route::get('/buttons', function () {
    return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
})->name('buttons');

Route::get('/image', function () {
    return view('pages.ui-elements.images', ['title' => 'Images']);
})->name('images');

Route::get('/videos', function () {
    return view('pages.ui-elements.videos', ['title' => 'Videos']);
})->name('videos');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:panitia');

    Route::middleware('role:panitia')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('role:panitia')->prefix('panitia')->name('panitia.')->group(function () {
        // Route::get('/dashboard', [PanitiaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/events', [EventController::class, 'index'])->name('events.index');

        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::get('/events/{event}/show', [EventController::class, 'show'])->name('events.show');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

        Route::get('/events/{event}/peserta', [RegistrationController::class, 'indexForEvent'])->name('registrations.peserta');
        // routes/web.php — tambahkan di dalam grup role:panitia
        Route::get('/peserta', [RegistrationController::class, 'indexAll'])->name('registrations.index');
        Route::patch('/registrations/{registration}/status', [RegistrationController::class, 'updateStatus'])->name('registrations.updateStatus');
    });

    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
        Route::get('/events', [MahasiswaController::class, 'events'])->name('events');

        Route::post('/events/{event}/daftar', [RegistrationController::class, 'store'])->name('registrations.store');
        Route::get('/registrations/{registration}/tiket', [RegistrationController::class, 'ticket'])->name('registrations.ticket');
        Route::get('/ticket/{registration}/download', [RegistrationController::class, 'downloadTicket'])
            ->name('ticket.download');
    });
});

require __DIR__ . '/auth.php';
