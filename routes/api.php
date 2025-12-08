<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Api\ContactController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::post('/password/otp', [PasswordResetController::class, 'sendOtp']);
Route::post('/password/verify-otp', [PasswordResetController::class, 'verifyOtp']);
Route::post('/password/update', [PasswordResetController::class, 'updatePassword']);
//contact
Route::post('/contact/submit', [ContactController::class, 'store']);


Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
// Admin only
Route::middleware(['auth:api','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard']);
    Route::post('/subscriptions', [ContactController::class, 'communityStore']);
    }); 

