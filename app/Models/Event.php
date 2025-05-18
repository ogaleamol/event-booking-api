<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = ['user_id', 'title', 'description', 'start_time', 'end_time', 'country_id', 'capacity'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}