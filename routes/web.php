<?php

use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    // Route::inertia('/', 'Home', ['users' => User::paginate(10)])->name('home');
    Route::get('/', function (Request $request) {
        return inertia('Home', [
            'users' => User::when($request->search, function ($query) use ($request) {
                $query
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            })->paginate(10)->withQueryString(),
            'searchTerm' => $request->search
        ]);
    })->name('home');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::inertia('/profile', 'Profile', ['users' => User::paginate(10)])->name('profile');
    Route::get('/profile', function () {
        return inertia('Profile', [
            'users' => User::paginate(10)
        ]);
    })->name('profile');
});
Route::middleware('guest')->group(function () {
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::inertia('/signup', 'Auth/Signup')->name('signup');
    Route::post('/signup', [AuthController::class, 'create']);
});


Route::post('/verify-token', [FirebaseController::class, 'verifyToken']);
