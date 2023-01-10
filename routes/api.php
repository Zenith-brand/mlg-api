<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TimesheetController;


Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('all_users', [ApiController::class, 'get_users']);
    Route::get('timesheets', [TimesheetController::class, 'get_timesheets']);
    Route::apiResources([
        'clients' => ClientController::class,

    ]);
});
