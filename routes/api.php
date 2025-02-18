<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\BudgetController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\NetWorthController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\SocialLoginController;
use App\Http\Controllers\API\Auth\ResetPasswordController;

// Guest routes
Route::group(['middleware' => 'guest:api'], function () {
    // Register
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('/verify-email', [RegisterController::class, 'VerifyEmail']);
    Route::post('/resend-otp', [RegisterController::class, 'ResendOtp']);

    // Login
    Route::post('login', [LoginController::class, 'login']);

    // Social login
    Route::post('/google/login', [SocialLoginController::class, 'googleLogin']);

    // Forgot password
    Route::post('/forget-password', [ResetPasswordController::class, 'forgotPassword']);
    Route::post('/verify-otp', [ResetPasswordController::class, 'VerifyOTP']);
    Route::post('/reset-password', [ResetPasswordController::class, 'ResetPassword']);
});

// Authenticated routes
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/refresh-token', [LoginController::class, 'refreshToken']);
    Route::post('/logout', [LogoutController::class, 'logout']);

    // BudgetController routes
    Route::controller(BudgetController::class)->group(function () {
        Route::get('/get-incomes', 'getIncomes');
        Route::get('/get-expenses', 'getExpenses');
        Route::get('/get-savings', 'getSavings');
        Route::get('/get-taxes', 'getTaxes');
        Route::post('/incomes', 'saveIncome');
        Route::post('/expenses', 'saveExpense');
        Route::post('/savings', 'saveSaving');
        Route::post('/taxes', 'saveTax');
    });

    // BlogController routes
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blogs', 'getActiveBlogs');
        Route::get('/blogs/{slug}', 'getBlogBySlug');
    });


    //NetWorthController routes
    Route::controller(NetWorthController::class)->group(function () {
        Route::get('/net-worth', 'getNetWorth');
        Route::post('/net-worth', 'storeNetWorth');
        Route::post('/net-worth/{id}', 'updateNetWorth');
        Route::delete('/net-worth/{id}', 'destroyNetWorth');
        Route::delete('/bulk-delete-net-worth', 'bulkDeleteNetWorth');
    });

});

