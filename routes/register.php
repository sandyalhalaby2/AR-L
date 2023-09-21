<?php

use Illuminate\Support\Facades\Route;

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


//Register
Route::post('signup' , [\App\Http\Controllers\api\RegisterController::class , 'SignUp'] ) ;

Route::post('login' , [\App\Http\Controllers\api\RegisterController::class , 'LogIn']) ;

Route::get('logout' , [\App\Http\Controllers\api\RegisterController::class , 'LogOut'])->middleware('auth:sanctum') ;


//Otp Verify
Route::post('/otp/generate' , [\App\Http\Controllers\api\AuthOtpController::class , 'generate']) ;

Route::post('/otp/verify' , [\App\Http\Controllers\api\AuthOtpController::class , 'OtpVerifyAccount']) ;


//Forgot Password
Route::post('/user/password/email', [\App\Http\Controllers\api\ForgotPasswordController::class, 'userForgotPassword']);

Route::post('user/password/code/check', [\App\Http\Controllers\api\ForgotPasswordController::class, 'userCheckCode']);

Route::post('/user/password/reset', [\App\Http\Controllers\api\ForgotPasswordController::class, 'userResetPassword']);
