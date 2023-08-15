<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_User extends Model
{
    use HasFactory;
    protected $fillable = ['staff_id', 'name', 'email', 'password'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'staff_id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class, 'staff_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'staff_id');
    }
    
    public function customers()
    {
        return $this->hasMany(User::class, 'staff_id');
    }
}
