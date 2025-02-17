<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register/{referral_code?}', [AuthController::class, 'register']);
// Route::get('/register/{referral_code?}', [AuthController::class, 'register'])->name('login');

    // ->where('referral_code', '.*'); // Biarkan kosong jika tidak ada

Route::post('/register', [AuthController::class, 'store']);
Route::post('/register/{referral_code?}', [AuthController::class, 'store']);
Route::get('/index', [PageController::class, 'index'])->name('index');

