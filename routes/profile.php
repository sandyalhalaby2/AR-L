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


route::get('removeUser' , [\App\Http\Controllers\api\ProfileController::class , 'destroy']) ;

route::post('updateProfile' , [\App\Http\Controllers\api\ProfileController::class , 'update']) ;

route::post('insertImage' , [\App\Http\Controllers\api\ProfileController::class , 'User_insert_image']) ;

route::get('GetUser/{id}' , [\App\Http\Controllers\api\ProfileController::class , 'GetUser']) ;

route::get('profile' , [\App\Http\Controllers\api\ProfileController::class , 'profile']) ;

route::post('reset_password' , [\App\Http\Controllers\api\ProfileController::class , 'resetPassword']) ;


