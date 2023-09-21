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



Route::middleware('auth')->group(function () {


    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('/profile',[AuthController::class , 'update'])->name('profile.update');



    Route::controller(\App\Http\Controllers\CourseController::class)->prefix('courses')->group(function () {
        Route::get('', 'index')->name('courses');
        Route::get('create', 'create')->name('courses.create');
        Route::post('store', 'store')->name('courses.store');
        Route::get('show/{id}', 'show')->name('courses.show');
        Route::get('edit/{id}', 'edit')->name('courses.edit');
        Route::put('edit/{id}', 'update')->name('courses.update');
        Route::delete('destroy/{id}', 'destroy')->name('courses.destroy');
    });




    Route::controller(\App\Http\Controllers\LessonController::class)->prefix('lessons')->group(function () {
        Route::get('','index')->name('allLessons');
        Route::get('/{id}','course_lesson')->name('lessons');
        Route::get('create/{id}', 'create')->name('lessons.create');
        Route::post('store/{id}', 'store')->name('lessons.store');
        Route::get('show/{id}', 'show')->name('lessons.show');
        Route::get('edit/{id}', 'edit')->name('lessons.edit');
        Route::put('edit/{id}', 'update')->name('lessons.update');
        Route::delete('destroy/{id}', 'destroy')->name('lessons.destroy');
        Route::post('search', 'search')->name('lessons.search') ;
    });



    Route::controller(\App\Http\Controllers\ExerciseController::class)->prefix('exercises')->group(function () {
        Route::get('','index')->name('allExercises');
        Route::get('/{id}', 'lesson_exercise')->name('exercises');
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
