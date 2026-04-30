<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ProgramController;
use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\DonationController;
use App\Http\Controllers\Public\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');

Route::prefix('program')->name('programs.')->group(function () {
    Route::get('/', [ProgramController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProgramController::class, 'show'])->name('show');
});

Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

Route::prefix('donasi')->name('donation.')->group(function () {
    Route::get('/', [DonationController::class, 'index'])->name('index');
    Route::post('/', [DonationController::class, 'store'])->name('store');
    Route::get('/sukses', [DonationController::class, 'success'])->name('success');
});

Route::prefix('kontak')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';