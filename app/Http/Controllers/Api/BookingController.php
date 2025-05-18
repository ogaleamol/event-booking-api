<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ]);

        $event = Event::find($data['event_id']);

        $existing = Booking::where('event_id', $event->id)
                            ->where('attendee_id', $data['attendee_id'])
                            ->exists();
        if ($existing) {
            return response()->json(['error' => 'Attendee already booked this event'], 409);
        }

        if ($event->bookings()->count() >= $event->capacity) {
            return response()->json(['error' => 'Event is fully booked'], 400);
        }

        $booking = Booking::create($data);
        return response()->json($booking, 201);
    }
}