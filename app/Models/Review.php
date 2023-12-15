<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_name', 'rating', 'comment', 'room_comment'];

    //    protected $fillable = ['name', 'rating', 'comment', 'reservation_id'];

    // Define relationships
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adminUser()
    {
        return $this->belongsTo(Admin_User::class, 'admin_id');
    }
}
