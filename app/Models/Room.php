<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoomType;
use App\Models\Reservation;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Type(){
        return $this->belongsTo(RoomType::class, 'type_id', 'id');
    }

    public function Reservation(){
        return $this->belongsTo(Reservation::class, 'id', 'room_id');
    }

    public function Picture(){
        return $this->belongsTo(Picture::class, 'id', 'room_id');
    }
}
