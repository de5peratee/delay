<?php

use App\Http\Controllers\AddMusicController;
use App\Http\Controllers\BecomeMusicianController;
use App\Http\Controllers\PopularController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\GenreSearchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MusicianController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/registration');
});

Route::get('/registration', [RegistrationController::class, 'index']);
Route::post('/registration/check', [RegistrationController::class, 'register']);


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/check', [LoginController::class, 'login']);

Route::get('/new', [NewController::class, 'index']);
Route::get('/searchNew', [NewController::class, 'search']);


Route::get('/popular', [PopularController::class, 'index']);


Route::get('/musician', function () { return view('musician'); });


Route::get('/search', [GenreSearchController::class, 'search']);
Route::get('/genres', [GenreSearchController::class, 'index']);
Route::get('/genres/{genre_name}', [GenreSearchController::class, 'show']);



Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/increase-listenings/{id}', [TrackController::class, 'increaseListenings']);


Route::get('/become_musician', [BecomeMusicianController::class, 'index']);
Route::post('/become_musician', [BecomeMusicianController::class, 'store']);

Route::get('/searchMusician', [MusicianController::class, 'search']);

Route::group(['prefix' => 'musician'], function () {
    Route::get('/add_music', [AddMusicController::class, 'index']);
    Route::post('/add_music', [AddMusicController::class, 'store']);
    Route::get('/', [MusicianController::class, 'index']);
    Route::get('/show/{musician_name}', [MusicianController::class, 'show']);
});
