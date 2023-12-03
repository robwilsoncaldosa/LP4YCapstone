<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $sql = "INSERT INTO \"rooms\" (\"id\", \"room_name\", \"price_per_night\", \"amenities\", \"bed_type\", \"description\", \"accommodates\", \"beds\", \"created_at\", \"updated_at\", \"image_path\") VALUES
        (1, 'Mantigue', 1000, 'Hot and cold bath water', 'Queen size', 'Spacious and bright room with private bathroom. Possibility of having two single beds or a double bed.', 2, 1, NULL, NULL, 'img/Mantigue_room.png'),
        (2, 'Camiguin', 1000, 'Hot and cold bath water', '2 beds', 'Spacious and bright room with private bathroom. Possibility of having two single beds or a double bed.', 2, 1, NULL, NULL, 'img/Camiguin_room.png'),
        (3, 'Malapascua', 1500, 'Hot and cold bath water', '4 beds Suitable for family', 'Spacious and bright room with private bathroom. Possibility of having two single beds or a double bed.', 4, 1, NULL, NULL, 'img/Malapascua_room.png');";

        DB::statement($sql);
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
