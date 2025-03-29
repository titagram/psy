<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduledSessionController;

require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Dashboard
Route::get('/therapist/dashboard', function () {
    return view('therapist.dashboard');
})->middleware(['auth', 'role:therapist'])->name('therapist.dashboard');

Route::get('/patient/dashboard', function () {
    return view('patient.dashboard');
})->middleware(['auth', 'role:patient'])->name('patient.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');


Route::resource('/therapist/schedule', ScheduledSessionController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'role:therapist']);

    
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('patient/book', [BookingController::class, 'create'])->name('booking.create');
    Route::post('patient/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::get('patient/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::delete('patient/bookings/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
});
    

