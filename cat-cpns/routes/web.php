<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
                ->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
                ->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
                ->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout')
                ->middleware('auth');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // User dashboard
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
    
    // Riwayat tes routes
    Route::get('/riwayat', [DashboardController::class, 'riwayatTes'])->name('riwayat.index');
    
    // CAT Test routes
    Route::get('/test', [TestController::class, 'index'])->name('test.index');
    Route::post('/test/start', [TestController::class, 'start'])->name('test.start');
    Route::get('/test/{session}/take', [TestController::class, 'take'])->name('test.take');
    Route::post('/test/{session}/answer', [TestController::class, 'answer'])->name('test.answer');
    Route::post('/test/{session}/navigate', [TestController::class, 'navigate'])->name('test.navigate');
    Route::get('/test/{session}/result', [TestController::class, 'result'])->name('test.result');
    Route::delete('/test/{session}/cancel', [TestController::class, 'cancel'])->name('test.cancel');
    
    // Certificate routes
    Route::get('/certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}', [\App\Http\Controllers\CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{certificate}/download', [\App\Http\Controllers\CertificateController::class, 'download'])->name('certificates.download');
    Route::get('/certificates/{certificate}/pdf-data', [\App\Http\Controllers\CertificateController::class, 'getPdfData'])->name('certificates.pdf-data');
    Route::get('/certificates/verify/{code}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificates.verify');
    
    // Notification routes
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/notifications/unread-count', [\App\Http\Controllers\NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [\App\Http\Controllers\NotificationController::class, 'getRecentNotifications'])->name('notifications.recent');
    Route::delete('/notifications/{notification}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // Timer routes
    Route::post('/test/{session}/auto-submit', [TestController::class, 'autoSubmit'])->name('test.auto-submit');
    Route::post('/test/{session}/pause-timer', [TestController::class, 'pauseTimer'])->name('test.pause-timer');
    Route::post('/test/{session}/resume-timer', [TestController::class, 'resumeTimer'])->name('test.resume-timer');
    Route::post('/test/{session}/extend-timer', [TestController::class, 'extendTimer'])->name('test.extend-timer');
    Route::get('/test/{session}/timer-stats', [TestController::class, 'getTimerStats'])->name('test.timer-stats');

    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        
        // User management routes
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);

        // Role switching routes (for testing)
        Route::get('/role-switch', [\App\Http\Controllers\Admin\RoleSwitchController::class, 'index'])->name('admin.role-switch.index');
        Route::post('/role-switch', [\App\Http\Controllers\Admin\RoleSwitchController::class, 'switchTo'])->name('admin.role-switch.switch');
        Route::post('/role-switch-back', [\App\Http\Controllers\Admin\RoleSwitchController::class, 'switchBack'])->name('admin.role-switch.back');

        // Excel routes (must be before resource to avoid conflicts)
        Route::get('/soals/upload', [\App\Http\Controllers\Admin\SoalController::class, 'uploadForm'])->name('admin.soals.upload');
        Route::post('/soals/import', [\App\Http\Controllers\Admin\SoalController::class, 'import'])->name('admin.soals.import');
        Route::get('/soals/export', [\App\Http\Controllers\Admin\SoalController::class, 'export'])->name('admin.soals.export');
        Route::get('/soals/template', [\App\Http\Controllers\Admin\SoalController::class, 'downloadTemplate'])->name('admin.soals.template');

        // Bulk delete route (must be before resource to avoid conflicts)
        Route::post('/soals/bulk-delete', [\App\Http\Controllers\Admin\SoalController::class, 'bulkDelete'])->name('admin.soals.bulk-delete');

        // Soal management routes
        Route::resource('soals', \App\Http\Controllers\Admin\SoalController::class)->names([
            'index' => 'admin.soals.index',
            'create' => 'admin.soals.create',
            'store' => 'admin.soals.store',
            'show' => 'admin.soals.show',
            'edit' => 'admin.soals.edit',
            'update' => 'admin.soals.update',
            'destroy' => 'admin.soals.destroy',
        ]);

        // Monitoring hasil ujian routes
        Route::get('/monitoring-hasil', [\App\Http\Controllers\DashboardController::class, 'monitoringHasil'])->name('admin.monitoring-hasil');
        Route::get('/monitoring-hasil/{session}', [\App\Http\Controllers\DashboardController::class, 'showHasilDetail'])->name('admin.monitoring-hasil.show');

        // Analytics routes
        Route::get('/analytics', [\App\Http\Controllers\DashboardController::class, 'analytics'])->name('admin.analytics');
    });
});

// Temporary route to bulk update old questions without Pilihan E
Route::get('/fix-soal-lama', function () {
    // 1. Update soal TKP yang pilihan E-nya masih kosong
    \App\Models\Soal::where('kategori', 'TKP')
        ->whereNull('pilihan_e')
        ->update([
            'pilihan_e' => 'Tidak ada jawaban yang sesuai (Ditambahkan otomatis)',
            'poin_e' => 1 // Poin terendah untuk TKP
        ]);

    // 2. Update soal TWK dan TIU yang pilihan E-nya masih kosong
    \App\Models\Soal::where('kategori', '!=', 'TKP')
        ->whereNull('pilihan_e')
        ->update([
            'pilihan_e' => 'Semua jawaban di atas salah (Ditambahkan otomatis)',
            'poin_e' => 0
        ]);

    return "Sukses! Ratusan soal lama berhasil disuntikkan Pilihan E secara otomatis.";
});
