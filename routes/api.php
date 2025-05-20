<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Basic test route that should always work
#Route::get('/ping', function() {
#    return response()->json(['message' => 'pong']);
#});

// Test POST route
#Route::post('/test-post', [TestController::class, 'test']);

// API routes
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::apiResource('attendees', AttendeeController::class);
Route::post('/attendees', [AttendeeController::class, 'store']);
Route::put('/attendees/{id}', [AttendeeController::class, 'update']);
Route::delete('/attendees/{id}', [AttendeeController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('events', EventController::class);
  
    Route::apiResource('bookings', AttendeeController::class);

    
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
    
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
});