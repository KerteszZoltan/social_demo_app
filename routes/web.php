<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\RegistrationController;
use App\Http\Controllers\AUTH\LoginController;
use App\Http\Controllers\AUTH\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\UserMiddleware;




Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['middleware'=>UserMiddleware::class], function(){
    Route::get('/users', [UserController::class, 'index'])->name('allusers');
    Route::post('/users', [UserController::class, 'update']);
});
