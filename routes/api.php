<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as AuthController;
use App\Http\Controllers\Api\CommonController as CommonController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('/set-password', [AuthController::class, 'setPassword']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/otp-submit', [AuthController::class, 'otpSubmit']);
    Route::get('/article/{type}', [CommonController::class, 'getArticle']);
    Route::get('/news', [CommonController::class, 'getNewses']);
    
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/fcm-update', [AuthController::class, 'fcmUpdate']);
        Route::get('/resend-otp', [AuthController::class, 'resendOtp']);
        Route::post('/profile-update/{type}', [CommonController::class, 'profileUpdate']);
        Route::get('/subject-list', [CommonController::class, 'subjectList']);
        Route::get('/university-list', [CommonController::class, 'universityList']);
        Route::get('/university-list/{id}', [CommonController::class, 'getUniversity']);
        Route::post('/profile-image', [CommonController::class, 'profileImageUpdate']);
        Route::post('/application-submit', [CommonController::class, 'applicationSubmit']);
        Route::get('/applications', [CommonController::class, 'getApplications']);
        Route::get('/profile', [CommonController::class, 'getProfile']);
        Route::post('/education-submit', [CommonController::class, 'educationSubmit']);
        Route::post('/professional-submit', [CommonController::class, 'professionalSubmit']);
        Route::post('/other-submit', [CommonController::class, 'otherSubmit']);
    });
});
