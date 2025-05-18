<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\BookingController;

Route::post('/api/events', [EventController::class, 'store']);
Route::apiResource('attendees', AttendeeController::class);
Route::post('bookings', [BookingController::class, 'store']);
Route::get('/', function () {
    return view('welcome');
});
