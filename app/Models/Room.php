<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['room_name', 'description', 'accommodates', 'beds', 'bed_type', 'amenities','price_per_night','image_path'];

    // Define relationships
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'room_name', 'room_name');
}

   
}
