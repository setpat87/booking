<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRoomDays;

class ClassRoom extends Model
{    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = ['name','capacity','sort_order'];
    
    public function availableDays()
    {
        return $this->hasMany(ClassRoomDays::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}