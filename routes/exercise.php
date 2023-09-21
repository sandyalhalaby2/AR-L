<?php

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
Route::post('create' , [\App\Http\Controllers\api\ExerciseController::class , 'store']) ;

Route::post('update/{id}' , [\App\Http\Controllers\api\ExerciseController::class , 'update']) ;

Route::post('delete/{id}' , [\App\Http\Controllers\api\ExerciseController::class , 'destroy']) ;
