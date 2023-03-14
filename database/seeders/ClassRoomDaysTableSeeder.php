<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoomDays;

class ClassRoomDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_days = [
            ['class_id'=>'1', 'days'=>'Monday', 'start_time'=>'09:00:00', 'end_time'=>'18:00:00'],
            ['class_id'=>'1', 'days'=>'Wednesday', 'start_time'=>'09:00:00', 'end_time'=>'18:00:00'],

            ['class_id'=>'2', 'days'=>'Monday', 'start_time'=>'08:00:00', 'end_time'=>'18:00:00'],
            ['class_id'=>'2', 'days'=>'Thursday', 'start_time'=>'08:00:00', 'end_time'=>'18:00:00'],
            ['class_id'=>'2', 'days'=>'Saturday', 'start_time'=>'08:00:00', 'end_time'=>'18:00:00'],

            ['class_id'=>'3', 'days'=>'Tuesday', 'start_time'=>'15:00:00', 'end_time'=>'22:00:00'],
            ['class_id'=>'3', 'days'=>'Friday', 'start_time'=>'15:00:00', 'end_time'=>'22:00:00'],
            ['class_id'=>'3', 'days'=>'Saturday', 'start_time'=>'15:00:00', 'end_time'=>'22:00:00']
           
        ];

        foreach($class_days as $value){
            ClassRoomDays::updateOrCreate(['class_id' => $value['class_id'], 'days' => $value['days'],  'start_time' => $value['start_time'], 'end_time' => $value['end_time']], $value);
        }
    }
}
