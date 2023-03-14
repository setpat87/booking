<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = ['class_room_id','start_date','day','slot','email'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function timeSlots($roomSlots, $classRoom)
    {
        $openTime = strtotime($roomSlots->starttime);
        $closeTime = strtotime($roomSlots->endtime);

        $output = array();
        for( $i = $openTime; $i < $closeTime; $i += 3600) {
            $startSlot = date("H:i",$i);
            $endSlot = date("H:i", strtotime('+1 hour', $i));
            $slotTime = $startSlot.'-'.$endSlot;
            
            $isSlotBooked = $this->isBooked($classRoom->id, $roomSlots->days, $slotTime);    

            if ($isSlotBooked < $classRoom->capacity) {        // Validate the Previous Booking.
                $output[] = $startSlot.'-'.$endSlot;
            }    
        }
        return $output;
    }

    public function isBooked($classRoomId, $day, $slot)
    {
        return Booking::where('class_room_id', $classRoomId)->where('day', $day)->where('slot', $slot)->count();
    }
}