<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceProviderController;
use App\Http\Controllers\Admin\StreamOrderController;
use App\Http\Controllers\Admin\EditProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\StreamNotificationController;
use App\Http\Controllers\Api\ForgotPasswordController;

Route::view('/forgot-password', 'auth.forgot-password')->name('forgot.password');
Route::post('/verify-otp', [ForgotPasswordController::class, 'showResetForm'])->name('forgot.verifyOtp');




Route::prefix('/')->name('admin.')->group(function () {

    // Login Routes
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('auth:admin')->group(function () {

        // ✅ Profile Management
        Route::get('/edit-profile', [EditProfileController::class, 'edit'])->name('profile.edit');


        // ✅ Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // ✅ User Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'view'])->name('view');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggleStatus');

        });



        // ✅ service_provider
        // Inside Route::prefix('admin')->name('admin.')->group(...)
        Route::prefix('service_provider')->name('service_provider.')->group(function () {
            Route::get('/', [ServiceProviderController::class, 'index'])->name('index');
            Route::get('/create', [ServiceProviderController::class, 'create'])->name('create');
            Route::post('/store', [ServiceProviderController::class, 'store'])->name('store');
            Route::get('/{id}/view', [ServiceProviderController::class, 'view'])->name('view');
            Route::get('/{id}/edit', [ServiceProviderController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ServiceProviderController::class, 'update'])->name('update');
Route::delete('/{provider}', [ServiceProviderController::class, 'destroy'])->name('destroy');
            Route::post('/{provider}/toggle-status', [ServiceProviderController::class, 'toggleStatus'])->name('toggleStatus');

        });






        // ✅ stream_order
        Route::prefix('stream_order')->name('stream_order.')->group(function () {
            Route::get('/', [StreamOrderController::class, 'index'])->name('index');
            Route::get('/create', [StreamOrderController::class, 'create'])->name('create');
            Route::get('/edit', [StreamOrderController::class, 'edit'])->name('edit');
            Route::get('/view', [StreamOrderController::class, 'view'])->name('view');
        });

        // ✅ Services
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
            Route::get('/{id}/view', [ServiceController::class, 'view'])->name('view');
            Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');

        });

        // ✅ supports
        Route::prefix('supports')->name('supports.')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('index');
            Route::get('/view', [SupportController::class, 'view'])->name('view');
        });

        Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');


});




        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/read/{id}', [AdminNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::get('/notifications/mark-all', [AdminNotificationController::class, 'markAllAsRead'])->name('notifications.markAll');


    Route::get('/streamList', [StreamNotificationController::class, 'streamList'])->name('streamList');
    Route::get('/joinMeeting/{url?}', [StreamNotificationController::class, 'joinMeeting'])->name('joinMeeting');

    Route::get('/stream-notifications', [StreamNotificationController::class, 'index']);
    Route::post('/stream-notifications', [StreamNotificationController::class, 'store'])->name('stream.create');
    Route::get('/stream-notifications/{id}', [StreamNotificationController::class, 'show']);
    Route::put('/stream-notifications/{id}', [StreamNotificationController::class, 'update']);
    Route::delete('/stream-notifications/{id}', [StreamNotificationController::class, 'destroy']);
    });
});
