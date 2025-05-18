<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $fillable = ['name', 'iso_code'];

    public function events() {
        return $this->hasMany(Event::class);
    }
}