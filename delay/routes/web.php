<?php

use App\Http\Controllers\AddMusicController;
use App\Http\Controllers\BecomeMusicianController;
use App\Http\Controllers\GenreSearchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Musician;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/registration');
});

Route::get('/registration', [RegistrationController::class, 'index']);
Route::post('/registration/check', [RegistrationController::class, 'register']);


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/check', [LoginController::class, 'login']);

Route::get('/new', function () { return view('new'); });
Route::get('/popular', function () { return view('popular'); });
Route::get('/musician', function () { return view('musician'); });
Route::get('/genres', function () { return view('genres'); });


Route::get('/search', [GenreSearchController::class, 'search']);
Route::get('/genres', [GenreSearchController::class, 'index']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/become_musician', [BecomeMusicianController::class, 'index']);
Route::post('/become_musician', [BecomeMusicianController::class, 'store']);

Route::post('/become_musician', [BecomeMusicianController::class, 'store']);

Route::get('/musician', [Musician::class, 'index']);


Route::group(['prefix' => 'musician'], function () {
    Route::get('/add_music', [AddMusicController::class, 'index']);
    Route::post('/add_music', [AddMusicController::class, 'store']);
});
