<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRent extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id', 'start_date', 'end_date', 'rent'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
