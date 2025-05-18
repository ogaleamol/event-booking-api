<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller {
    public function index() {
        return Attendee::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:attendees,email',
        ]);
        return Attendee::create($data);
    }

    public function show(Attendee $attendee) {
        return $attendee;
    }

    public function update(Request $request, Attendee $attendee) {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:attendees,email,' . $attendee->id,
        ]);
        $attendee->update($data);
        return $attendee;
    }

    public function destroy(Attendee $attendee) {
        $attendee->delete();
        return response()->json(['message' => 'Attendee deleted']);
    }
}
