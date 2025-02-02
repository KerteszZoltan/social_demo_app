<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\RegistrationController;
use App\Http\Controllers\AUTH\LoginController;
use App\Http\Controllers\AUTH\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Friend\FriendController;
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
    Route::get('/users', [UserController::class, 'index'])->name('allUsers');
    Route::post('/users', [UserController::class, 'updateAdmin']);
    Route::post('/users', [FriendController::class, 'addFriend'])->name('addFriend');
    Route::get('/friends', [FriendController::class, 'friends'])->name('allFriends');
});
