<?php

use App\Http\Controllers\AddMusicController;
use App\Http\Controllers\BecomeMusicianController;
use App\Http\Controllers\MusicianProfile;
use App\Http\Controllers\MusicianProfileController;
use App\Http\Controllers\MyMusicController;
use App\Http\Controllers\PlaylistController;
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


Route::get('/search', [GenreSearchController::class, 'search']);
Route::get('/genres', [GenreSearchController::class, 'index']);
Route::get('/genres/{genre_name}', [GenreSearchController::class, 'show']);

Route::post('/addTrack', [PlaylistController::class, 'addTrack']);
Route::post('/removeTrack', [PlaylistController::class, 'removeTrack']);
Route::get('/playlistTracks', [PlaylistController::class, 'getPlaylistTracks']);



Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/increase-listenings/{id}', [TrackController::class, 'increaseListenings']);
Route::get('/skeleton-load', [TrackController::class, 'index']);

Route::get('/become_musician', [BecomeMusicianController::class, 'index']);
Route::post('/become_musician', [BecomeMusicianController::class, 'store']);

Route::get('/searchMusician', [MusicianController::class, 'search']);

//Route::get('/musician/{type}', [AddMusicController::class, 'show']);

Route::get('/collection/{listener_name}', [MyMusicController::class, 'index']);

Route::get('/track/{id}', [TrackController::class, 'showModal']);

Route::group(['prefix' => 'musicianProfile'], function () {
    Route::get('/', [MusicianProfileController::class, 'show']);
    Route::put('/edit', [MusicianProfileController::class, 'update']);
    Route::put('/updateTrack/{id}', [MusicianProfileController::class, 'updateTrack']);
    Route::delete('/deleteTrack/{id}', [MusicianProfileController::class, 'deleteTrack']);

});


Route::group(['prefix' => 'musician'], function () {
    Route::get('/single', [AddMusicController::class, 'show']);
    Route::get('/add_music', [AddMusicController::class, 'index']);
    Route::post('/add_music', [AddMusicController::class, 'store']);
    Route::post('/add_music_album', [AddMusicController::class, 'storeAlbum']);
    Route::get('/', [MusicianController::class, 'index']);
    Route::get('/show/{musician_name}', [MusicianController::class, 'show']);
});
