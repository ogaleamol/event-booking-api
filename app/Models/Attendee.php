<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Attendee",
 *     type="object",
 *     title="Attendee",
 *     description="Attendee model",
 *     required={"id", "name", "email"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Jane Doe"),
 *     @OA\Property(property="email", type="string", example="jane@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T13:00:00Z")
 * )
 */
class Attendee extends Model {
    protected $fillable = ['name', 'email'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}