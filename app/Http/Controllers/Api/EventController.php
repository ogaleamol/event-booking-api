<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        return Event::with('country')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'country_id' => 'required|exists:countries,id',
            'capacity' => 'required|integer|min:1',
        ]);
        return Event::create($data);
    }

    public function show(Event $event) {
        return $event->load('country');
    }

    public function update(Request $request, Event $event) {
        $data = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
            'country_id' => 'sometimes|exists:countries,id',
            'capacity' => 'sometimes|integer|min:1',
        ]);
        $event->update($data);
        return $event;
    }

    public function destroy(Event $event) {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
