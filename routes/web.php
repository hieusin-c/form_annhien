<?php

use App\Http\Controllers\Admin\ConsultationDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HealthConsultationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HealthConsultationController::class, 'index'])->name('consultation.index');
Route::post('/consultation', [HealthConsultationController::class, 'store'])->name('consultation.store');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Admin Dashboard Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/consultations', [ConsultationDashboardController::class, 'index'])->name('admin.consultations.index');
    Route::patch('/consultations/{consultation}', [ConsultationDashboardController::class, 'update'])->name('admin.consultations.update');
    Route::delete('/consultations/{consultation}', [ConsultationDashboardController::class, 'destroy'])->name('admin.consultations.destroy');
    Route::get('/consultations/check-updates', [ConsultationDashboardController::class, 'checkUpdates'])->name('admin.consultations.check_updates');
});
