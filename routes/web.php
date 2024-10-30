<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('landing-page');
    }
})->name('landing-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/playground', 'test')->name('playground');

// Added Resources
Route::middleware(['auth', 'verified'])->group(function() {
    // Appointments (Custom controllers)
    Route::get('appointments/{appointment}/payment', [AppointmentController::class, 'payment'])->name('appointments.payment');
    Route::post('appointments/{appointment}/processPayment', [AppointmentController::class, 'processPayment'])->name('appointments.processPayment');
    Route::get('appointments/{appointment}/payment-success', [AppointmentController::class, 'processPaymentView'])->name('appointments.payment-success');
});

// Appointments
Route::resource('appointments', AppointmentController::class)->middleware(['auth', 'verified']);
Route::resource('users', UserController::class)->middleware(['auth', 'verified', 'isAdmin']);



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
