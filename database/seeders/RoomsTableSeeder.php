<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'room_name' => 'Mantigue',
                'price_per_night' => 1000,
                'amenities' => 'Hot and cold bath water',
                'bed_type' => 'Queen size',
                'description' => 'Spacious and bright room with private bathroom. Possibility of having two single beds or a double bed.',
                'accommodates' => 2,
                'beds' => 1,
                'image_path' => 'img/Mantigue_room.png',
            ],
            [
                'room_name' => 'Camiguin',
                'price_per_night' => 1000,
                'amenities' => 'Hot and cold bath water',
                'bed_type' => '2 beds',
                'description' => 'Spacious and bright room with private bathroom. Possibility of having two single beds or a double bed.',
                'accommodates' => 2,
                'beds' => 1,
                'image_path' => 'img/Camiguin_room.png',
            ],
            [
                'room_name' => 'Malapascua',
                'price_per_night' => 1500,
                'amenities' => 'Hot and cold bath water',
                'bed_type' => '4 beds Suitable for family',
                'description' => 'Spacious and bright room with private bathroom. Possibility of having two single beds or a double bed.',
                'accommodates' => 4,
                'beds' => 1,
                'image_path' => 'img/Malapascua_room.png',
            ],
            // Add more rooms here...
        ]);
    }
}
