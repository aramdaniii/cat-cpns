<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Public API endpoints
Route::prefix('v1')->group(function () {
    // Public verification endpoint (commented out - Api\CertificateController not found)
    // Route::get('/certificates/verify/{code}', [\App\Http\Controllers\Api\CertificateController::class, 'verify']);
    
    // Public soal categories (commented out - Api\SoalController not found)
    // Route::get('/soals/categories', [\App\Http\Controllers\Api\SoalController::class, 'categories']);
});

// Protected API endpoints (require authentication)
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // User profile
    Route::get('/profile', [\App\Http\Controllers\Api\UserController::class, 'profile']);
    Route::put('/profile', [\App\Http\Controllers\Api\UserController::class, 'updateProfile']);
    
    // Test management
    Route::get('/test/sessions', [\App\Http\Controllers\Api\TestController::class, 'sessions']);
    Route::post('/test/start', [\App\Http\Controllers\Api\TestController::class, 'start']);
    Route::get('/test/{session}/questions', [\App\Http\Controllers\Api\TestController::class, 'questions']);
    Route::post('/test/{session}/answer', [\App\Http\Controllers\Api\TestController::class, 'answer']);
    Route::post('/test/{session}/complete', [\App\Http\Controllers\Api\TestController::class, 'complete']);
    Route::get('/test/{session}/result', [\App\Http\Controllers\Api\TestController::class, 'result']);
    
    // Questions (commented out - Api\SoalController not found)
    // Route::get('/soals', [\App\Http\Controllers\Api\SoalController::class, 'index']);
    // Route::get('/soals/{soal}', [\App\Http\Controllers\Api\SoalController::class, 'show']);
    
    // Certificates (commented out - Api\CertificateController not found)
    // Route::get('/certificates', [\App\Http\Controllers\Api\CertificateController::class, 'index']);
    // Route::get('/certificates/{certificate}', [\App\Http\Controllers\Api\CertificateController::class, 'show']);
    // Route::get('/certificates/{certificate}/download', [\App\Http\Controllers\Api\CertificateController::class, 'download']);
    
    // Notifications (commented out - Api\NotificationController not found)
    // Route::get('/notifications', [\App\Http\Controllers\Api\NotificationController::class, 'index']);
    // Route::post('/notifications/{notification}/read', [\App\Http\Controllers\Api\NotificationController::class, 'markAsRead']);
    // Route::post('/notifications/read-all', [\App\Http\Controllers\Api\NotificationController::class, 'markAllAsRead']);
    
    // Analytics (commented out - Api\AnalyticsController not found)
    // Route::middleware(['admin'])->group(function () {
    //     Route::get('/analytics/overview', [\App\Http\Controllers\Api\AnalyticsController::class, 'overview']);
    //     Route::get('/analytics/test-stats', [\App\Http\Controllers\Api\AnalyticsController::class, 'testStats']);
    //     Route::get('/analytics/user-stats', [\App\Http\Controllers\Api\AnalyticsController::class, 'userStats']);
    // });
});
