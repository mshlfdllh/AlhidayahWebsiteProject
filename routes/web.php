<?php
// =============================================================
// routes/web.php  —  Public routes
// =============================================================
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ProgramController;
use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\DonationController;
use App\Http\Controllers\Public\ContactController;
use Illuminate\Support\Facades\Route;

// ── Public ──────────────────────────────────────────────────
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

// ── Auth ────────────────────────────────────────────────────
require __DIR__ . '/auth.php';

// ── Admin ───────────────────────────────────────────────────
require __DIR__ . '/admin.php';


// =============================================================
// routes/admin.php  —  Admin routes (protected)
// =============================================================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\GalleryController    as AdminGalleryController;
use App\Http\Controllers\Admin\ProgramController    as AdminProgramController;
use App\Http\Controllers\Admin\NewsController       as AdminNewsController;
use App\Http\Controllers\Admin\DonationController   as AdminDonationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', AdminMiddleware::class])
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Achievements
        Route::resource('prestasi', AdminAchievementController::class);

        // Gallery
        Route::resource('galeri', AdminGalleryController::class);
        Route::post('galeri/{gallery}/toggle-featured', [AdminGalleryController::class, 'toggleFeatured'])
            ->name('galeri.toggle-featured');

        // Programs
        Route::resource('program', AdminProgramController::class);

        // News
        Route::resource('berita', AdminNewsController::class);
        Route::post('berita/{news}/publish', [AdminNewsController::class, 'publish'])
            ->name('berita.publish');

        // Donations
        Route::get('donasi', [AdminDonationController::class, 'index'])->name('donasi.index');
        Route::get('donasi/{donation}', [AdminDonationController::class, 'show'])->name('donasi.show');
        Route::patch('donasi/{donation}/status', [AdminDonationController::class, 'updateStatus'])
            ->name('donasi.update-status');

        // Users
        Route::resource('pengguna', UserController::class);
    });