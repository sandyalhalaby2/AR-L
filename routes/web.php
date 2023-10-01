<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::controller(AuthController::class)->group(function () {
    Route::get('/' , [AuthController::class , 'login']) ;

    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//continue with google
Route::get('auth/google', [AuthController::class , 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class,'handleGoogleCallback']);

//continue with facebook
Route::get('/login/facebook',  [AuthController::class , 'redirectToFacebook']);
Route::get('/login/facebook/callback',  [AuthController::class,'handleFacebookCallback']);


Route::middleware('auth')->group(function () {


    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('/profile',[AuthController::class , 'update'])->name('profile.update');

    Route::controller(\App\Http\Controllers\LevelController::class)->prefix('levels')->group(function () {
        Route::get('', 'index')->name('levels');
        Route::get('create', 'create')->name('levels.create');
        Route::post('store', 'store')->name('levels.store');
        Route::get('show/{id}', 'show')->name('levels.show');
        Route::get('edit/{id}', 'edit')->name('levels.edit');
        Route::put('edit/{id}', 'update')->name('levels.update');
        Route::delete('destroy/{id}', 'destroy')->name('levels.destroy');
    });




    Route::controller(\App\Http\Controllers\SkillController::class)->prefix('skills')->group(function () {
        Route::get('','index')->name('allSkills');
        Route::get('/{id}','level_skill')->name('skills');
        Route::post('search', 'search')->name('skills.search') ;
    });

    Route::controller(\App\Http\Controllers\SubSkillController::class)->prefix('sub_skills')->group(function () {
        Route::get('/{id}','Skill_SubSkill')->name('sub_skills') ;
        Route::get('create/{id}', 'create')->name('sub_skills.create');
        Route::post('store/{id}', 'store')->name('sub_skills.store');
        Route::get('show/{id}', 'show')->name('sub_skills.show');
        Route::get('edit/{id}', 'edit')->name('sub_skills.edit');
        Route::put('edit/{id}', 'update')->name('sub_skills.update');
        Route::delete('destroy/{id}', 'destroy')->name('sub_skills.destroy');

    });


        Route::controller(\App\Http\Controllers\ExerciseController::class)->prefix('exercises')->group(function () {
        Route::get('/{id}', 'sub_skill_exercise')->name('exercises');
        Route::get('create/{id}', 'create')->name('exercises.create');
        Route::post('store/{id}', 'store')->name('exercises.store');
        Route::get('show/{id}', 'show')->name('exercises.show');
        Route::get('edit/{id}', 'edit')->name('exercises.edit');
        Route::put('edit/{id}', 'update')->name('exercises.update');
        Route::delete('destroy/{id}', 'destroy')->name('exercises.destroy');
        Route::post('search', 'search')->name('exercises.search') ;

    });



    Route::controller(\App\Http\Controllers\AnswerDetailsController::class)->prefix('answer_details')->group(function () {
        Route::get('/{exercise_id}', 'exercise_answer_details')->name('answer_details');
        Route::get('create', 'create')->name('answer_details.create');
        Route::post('store/{exercise_id}', 'store')->name('answer_details.store');
        Route::get('show/{id}', 'show')->name('answer_details.show');
        Route::get('edit/{id}', 'edit')->name('answer_details.edit');
        Route::put('edit/{id}', 'update')->name('answer_details.update');
        Route::delete('destroy/{id}', 'destroy')->name('answer_details.destroy');
    });



    Route::controller(\App\Http\Controllers\UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users');
        Route::post('/block/{id}' ,'block')->name('users.block') ;
        Route::post('search', 'search')->name('users.search') ;

    });


});
