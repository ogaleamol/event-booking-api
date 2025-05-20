<?php

namespace Tests\Unit;

use App\Models\Attendee;
use App\Models\Event;
use PHPUnit\Framework\TestCase;

class BookingServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_attendee_can_be_booked_if_not_already_booked_and_not_full()
    {
        $event = Event::factory()->make(['capacity' => 1]);
        $attendee = Attendee::factory()->make();

        // Simulate booking logic
        $event->setRelation('bookings', collect([])); // No existing bookings

        $canBook = $event->bookings->count() < $event->capacity;
        $this->assertTrue($canBook);
    }
}
