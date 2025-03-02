<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logoutUser'])->name('logout');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register/{referral_code?}', [AuthController::class, 'register']);
Route::post('/register/{referral_code?}', [AuthController::class, 'store']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.link');

Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    // Route::get('/register/{referral_code?}', [AuthController::class, 'register'])->name('login');

        // ->where('referral_code', '.*'); // Biarkan kosong jika tidak ada
    Route::get('/approve-registration/{user_id}', [AdminController::class, 'approveRegistration'])->name('approve.registration');
    Route::get('/list-registration', [AdminController::class, 'showPendingRegistrations'])->name('list.registration');
    Route::get('/commissions', [AdminController::class, 'commissions'])->name('commissions');
    Route::post('/commissions/transfer', [AdminController::class,'commissionTransfer'])->name('commission.transfer');
    // Route::get('/list-registration', [AdminController::class, 'showPendingRegistrations'])->name('list-registration');
    Route::post('/register', [AuthController::class, 'store']);
    
    Route::get('/index', [PageController::class, 'index'])->name('index');

    Route::get('/registered-users', [PageController::class, 'showRegisteredUsers'])->name('registered.users');

    Route::get('/registered-users/details/{referral_code}', [PageController::class, 'showUsersDetails']);

    Route::get('/referral-hierarchy', [PageController::class, 'showHierarchyPage'])->name('org.chart');
    Route::get('/api/referral-hierarchy', [PageController::class, 'referralHierarchy']);

    
});