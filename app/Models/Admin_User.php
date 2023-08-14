<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_User extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'name', 'email', 'password'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'admin_id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class, 'admin_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'admin_id');
    }
    public function staffUsers()
    {
        return $this->hasMany(Staff_User::class, 'admin_id');
    }
    public function customers()
    {
        return $this->hasMany(User::class, 'admin_id');
    }
}
