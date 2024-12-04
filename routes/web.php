<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PiketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false,
]);

Route::middleware('auth')->group(function () {
    Route::resource('karyawan', UserController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('piket', PiketController::class);

    Route::get('/home', [UserController::class, 'home'])->name('home');
});


// Route::get('/home', [PiketController::class, 'home'])->name('home');

// Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
// Route::get('jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
// Route::post('jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
// Route::get('jadwal/{id}', [JadwalController::class, 'show'])->name('jadwal.show');
// Route::get('jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
// Route::put('jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
// Route::delete('jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
