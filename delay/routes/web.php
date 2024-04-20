<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/registration');
});

Route::get('/registration', function () { return view('reg'); });
Route::post('/registration/check', [RegistrationController::class, 'register']);


Route::get('/login', function () { return view('log'); });
Route::post('/login/check', [LoginController::class, 'login']);

Route::get('/new', function () { return view('new'); });
Route::get('/popular', function () { return view('popular'); });
Route::get('/musician', function () { return view('musician'); });
Route::get('/genres', function () { return view('genres'); });


Route::get('/search', [App\Http\Controllers\GenreSearchController::class, 'search']);
Route::get('/genres', [App\Http\Controllers\GenreSearchController::class, 'index']);

Route::group(['prefix' => 'musician'], function () {
    Route::get('/add_music', [App\Http\Controllers\AddMusicController::class, 'index']);
});
