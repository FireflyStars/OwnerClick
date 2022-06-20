<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('creator_id');
            $table->integer('type_id');
            $table->integer('person_id');
            $table->integer('unit_id');
            $table->integer('status_id');
            $table->float('share');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons_properties');
    }
}
