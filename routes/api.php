<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Admin\StreamOrderController;
use App\Http\Controllers\Admin\StreamNotificationController;

Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp']);
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/stream-orders', [StreamOrderController::class, 'userRequestList']);
    Route::post('/stream-orders-request', [StreamOrderController::class, 'userRequestStreamOrder']);
    Route::get('/stream-orders/{id}', [StreamOrderController::class, 'show']);
    Route::put('/stream-orders/{id}', [StreamOrderController::class, 'update']);
    Route::delete('/stream-orders/{id}', [StreamOrderController::class, 'destroy']);
});

Route::post('generateToken', [StreamNotificationController::class, 'generateToken']);
Route::post('generateRtcToken', [StreamNotificationController::class, 'generateRtcToken'])->name('api.generateRtcToken');

