<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/registration');
});

Route::get('/registration', function () {
    return view('reg');
});

Route::get('/login', function () {
    return view('log');
});

Route::post('/registration/check', [RegistrationController::class, 'register']);

Route::post('/login/check', [LoginController::class, 'login']);

