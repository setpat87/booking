<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoomDays extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = ['class_room_id','days','start_time','end_time'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}