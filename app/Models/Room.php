<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'room_name',
        'price_per_night',
        'amenities',
        'room_type',
        'bed_type',
        'image_path',
    ];


}
