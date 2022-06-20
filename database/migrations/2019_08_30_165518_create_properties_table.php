<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('creator_id');
            $table->tinyInteger('type_id');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('state_id');
            $table->integer('zip_code')->nullable();
            $table->string('region')->nullable();
            $table->string('building_no')->nullable();
            $table->string('apartment_no')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
            $table->string('address');
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
        Schema::dropIfExists('properties');
    }
}
