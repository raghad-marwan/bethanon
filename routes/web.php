<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [DonationController::class, 'index'])->name('home');
Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
Route::get('/donate', [DonationController::class, 'showDonateForm'])->name('donate');
Route::post('/donation/store', [DonationController::class, 'storeDonation'])->name('donation.store');

Route::get('/login', function () { return redirect('/'); })->name('login');

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/organization/login', [AuthController::class, 'showLoginForm'])->name('organization.login');
Route::post('/organization/login', [AuthController::class, 'login']);

Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->middleware('auth:admin');
Route::get('/organization/dashboard', function () { return view('organization.dashboard'); })->middleware('auth:organization');

Route::post('/logout', function () {
    $guard = Auth::guard('admin')->check() ? 'admin' : 'organization';
    Auth::guard($guard)->logout();
    return redirect('/');
});

Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/statistics', [AdminController::class, 'statistics']);
    Route::get('/donations', [AdminController::class, 'donations']);
    Route::get('/donations/monthly', [AdminController::class, 'donationsMonthly']);
    Route::get('/donations/pending', [AdminController::class, 'donationsPending']);
    Route::get('/donations/{id}/confirm', [AdminController::class, 'confirmDonation']);
    Route::get('/donations/{id}/reject', [AdminController::class, 'rejectDonation']);
    Route::get('/appeals', [AdminController::class, 'appeals']);
    Route::get('/appeals/create', [AdminController::class, 'createAppeal']);
    Route::post('/appeals', [AdminController::class, 'storeAppeal']);
    Route::delete('/appeals/{id}', [AdminController::class, 'deleteAppeal']);
    Route::get('/appeals/{id}/approve', [AdminController::class, 'approveAppeal']);
    Route::get('/appeals/{id}/reject', [AdminController::class, 'rejectAppeal']);
    Route::get('/notifications', [AdminController::class, 'notifications']);
    Route::post('/notifications', [AdminController::class, 'storeNotification']);
    Route::delete('/notifications/{id}', [AdminController::class, 'deleteNotification']);
    Route::get('/withdrawals', [AdminController::class, 'withdrawals']);
    Route::post('/withdrawals', [AdminController::class, 'storeWithdrawal']);
    Route::get('/organizations', [AdminController::class, 'organizations']);
    Route::get('/organizations/{id}/approve', [AdminController::class, 'approveOrganization']);
    Route::get('/organizations/{id}/reject', [AdminController::class, 'rejectOrganization']);
});
