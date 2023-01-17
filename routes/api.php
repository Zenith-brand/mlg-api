<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateNoteController;
use App\Http\Controllers\ClientNoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNoteController;




Route::post('login', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [AuthController::class, 'logout']);
    // Route::get('get_user', [ApiController::class, 'get_user']);
    // Route::get('all_users', [ApiController::class, 'get_users']);
    Route::get('timesheets', [TimesheetController::class, 'get_timesheets']);
    Route::get('clients/{client}/locations', [ClientController::class, 'get_address_by_client']);
    Route::get('users/{user}/locations', [UserController::class, 'get_address_by_user']);
    Route::get('candidates/{candidate}/locations', [CandidateController::class, 'get_address_by_candidate']);
    Route::get('invoices', [ApiController::class, 'index_invoices']);
    Route::get('invoices/incoming', [ApiController::class, 'get_incoming_invoices']);
    Route::get('invoices/outgoing', [ApiController::class, 'get_outgoing_invoices']);
    

    Route::apiResources([
        'users' => UserController::class,
        'users.notes' => UserNoteController::class,
        'clients' => ClientController::class,
        'clients.notes' => ClientNoteController::class,
        'candidates' => CandidateController::class,
        'candidates.notes' => CandidateNoteController::class,
        'activity' => ActivityController::class,
    ]);
});

Route::fallback(function(){
    return response()->json([
        'status code' => 404,
        'message' => 'Page Not Found. If error persists, contact info@medical-locums.co.uk'], 404);
});
