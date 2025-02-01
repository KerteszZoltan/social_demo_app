<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\RegistrationController;
use App\Http\Controllers\AUTH\LoginController;
use App\Http\Controllers\AUTH\LogoutController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');