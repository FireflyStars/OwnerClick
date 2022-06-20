<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::unprepared( file_get_contents( "vendor/dr5hn/countries-states-cities-database/sql/states.sql" ) );
        \DB::unprepared('UPDATE states SET name = REPLACE(name, "PROVINCE", "") WHERE name LIKE "%PROVINCE%"');
        \DB::unprepared('UPDATE states SET name = REPLACE(name, "Province", "") WHERE name LIKE "%Province%"');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     Schema::dropIfExists('states');
    }
}
