<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClientNoteController;



Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('all_users', [ApiController::class, 'get_users']);
    Route::get('timesheets', [TimesheetController::class, 'get_timesheets']);
    Route::get('clients/{client}/location', [ClientController::class, 'get_address_by_client']);

    // Route::get('clients/notes', [ClientController::class, 'get_notes']);
    // Route::get('clients/{user}/notes', [ClientController::class, 'get_notes_by_client']);
    Route::apiResources([
        'clients' => ClientController::class,
        'clients.notes' => ClientNoteController::class,
        'activity' => ActivityController::class,


    ]);
});

Route::fallback(function(){
    return response()->json([
        'status code' => 404,
        'message' => 'Page Not Found. If error persists, contact info@medical-locums.co.uk'], 404);
});
