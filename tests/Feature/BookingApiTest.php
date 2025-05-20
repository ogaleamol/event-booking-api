<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Database\Factories\AttendeeFactory;
use Database\Factories\EventFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_attendee_can_book_an_event()
    {
        $user = User::factory()->create();
        $attendee = Attendee::factory()->create();
        $event = Event::factory()->create([
            'user_id' => $user->id,
            'title' => 'test event',
            'description' => 'test event description',
            'start_time' => now()->addDays(1),
            'end_time' => now()->addDays(2),
            'country_id' => 1,
            'capacity' => 2,
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);
    }
}
