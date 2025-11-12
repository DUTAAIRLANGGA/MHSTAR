<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\mhstar\DashboardController;
use App\Http\Controllers\mhstar\SiswaController;
use App\Http\Controllers\mhstar\PenilaianController;
use App\Http\Controllers\mhstar\IndexController;
use App\Http\Controllers\mhstar\RecomenController;
use App\Http\Controllers\mhstar\RecommendationGenerationController;

// Public routes (rute yang bisa diakses tanpa login)
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('mhstar.about-public');
})->name('about');

// Rute rekomendasi publik
Route::get('/rekomendasi', [RecomenController::class, 'rekomendasi'])->name('rekomendasi');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Authenticated routes (rute yang hanya bisa diakses setelah login)
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('penilaian', PenilaianController::class);
    
    // Rute rekomendasi khusus admin
    Route::get('/generate-recommendations', [RecommendationGenerationController::class, 'generateRecommendations'])->name('generate-recommendations');
    
    Route::get('/about-admin', function(){
        return view('mhstar.about-admin');
    })->name('about-admin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
