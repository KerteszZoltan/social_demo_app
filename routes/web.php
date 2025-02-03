<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\RegistrationController;
use App\Http\Controllers\AUTH\LoginController;
use App\Http\Controllers\AUTH\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Friend\FriendController;
use App\Http\Controllers\Notifications\NotificationController;
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
    Route::post('/usersAdd', [FriendController::class, 'addFriend'])->name('addFriend');
    Route::get('/friends', [FriendController::class, 'friends'])->name('allFriends');
    Route::post('/friends', [FriendController::class, 'delete'])->name('deleteFriend');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('allNotifications');
    Route::post('/notifications', [NotificationController::class, 'addBack'])->name('addBack');
    Route::post('/decline', [NotificationController::class, 'decline'])->name('decline');
    Route::post('/markread', [NotificationController::class, 'markRead'])->name('markRead');
});
