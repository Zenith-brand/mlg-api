<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;


Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::post('send_reset', [PasswordResetRequestController::class, 'sendEmail']);
Route::post('password_reset', [ChangePasswordController::class, 'passwordResetProcess']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('all_users', [ApiController::class, 'get_users']);
    Route::get('all_clients', [ApiController::class, 'get_clients']);
});
