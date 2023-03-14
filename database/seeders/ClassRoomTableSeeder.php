<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoom;

class ClassRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_room = [
            ['room'=>'A', 'capacity'=>'10', 'sort_order'=>'1'],
            ['room'=>'B', 'capacity'=>'15', 'sort_order'=>'2'],
            ['room'=>'C', 'capacity'=>'7', 'sort_order'=>'3']         
        ];

        foreach($class_room as $value){
            ClassRoom::updateOrCreate(['room' => $value['room'], 'capacity' => $value['capacity'],  'sort_order' => $value['sort_order']], $value);
        }
    }
}
