<?php

namespace App\Http\Controllers\Api;

use \Carbon\Carbon;
use App\Models\Booking;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRequest;

class BookingController extends Controller
{
    public function slotsAvailable(Request $request)
    {
        $classRooms = ClassRoom::with('availableDays')->orderBy('sort_order', 'ASC')->get();

        $slotDisplay = array();
        if ($classRooms) {
            foreach ($classRooms as $key => $classRoom) {  
                $slotDisplay[$key]['class_room'] = $classRoom->name;

                if ($classRoom->has('availableDays')) {
                    foreach ($classRoom->availableDays as $key1 => $roomSlots) {
                        $slotDisplay[$key]['rooms'][$key1]['day'] = $roomSlots->days;
                        $slotDisplay[$key]['rooms'][$key1]['slots'] = Booking::timeSlots($roomSlots, $classRoom);
                    }
                }
            }
        }

        return response()->json(['success' => $slotDisplay]);
    }

    public function store(StoreRequest $request, ClassRoom $classRoom) 
    {
        $isDaysExists = $classRoom->availableDays()->where('days', $request->day)
        ->whereRaw("'$request->slot' BETWEEN start_time AND end_time")
        ->exists();

        if (! $isDaysExists) {
            return apiError("Please select a valid slot.");
        }
        
        $existingBookings = $classRoom->bookings()->where('day', $request->day)->where('slot', $request->slot)->count();
        
        if ($existingBookings >= $classRoom->capacity) {
            return apiError("The slot is full, Please try another slot.");
        }
        
        $request['start_date']   = Carbon::createFromDate($request->start_date)->format('Y-m-d');
        
        $booking = Booking::create($request->all());
        
        return apiSuccess([
            'booking_id' => $booking->id,
            'booking_id' => 'Booking submitted Successfully!'
        ]);
    }

    public function destroy(Request $request, Booking $booking)
    {
        $booking->start_date
        $start->diff($end)->format('%H:%I:%S');
        $isAllowed = $booking->whereRaw("start_date > DATE_ADD(NOW(), INTERVAL 24 HOUR)")->exists();

        if (! $isAllowed) {
            return apiError("The booking cannot be canceled less than 24 hours in advance");
        }

        $booking->delete();

        return apiSuccess([
            'success' => 'Booking deleted Successfully!',
        ]);
    }
}