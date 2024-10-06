<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;

Route::middleware('firebaseAuth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
});

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::inertia('/login', 'Auth/Login')->name('login');
Route::inertia('/register', 'Auth/Register')->name('register');
Route::post('/register', [AuthController::class, 'register']);
