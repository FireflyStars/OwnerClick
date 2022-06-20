<?php

use App\Models\Person;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type_id');
            $table->integer('creator_id');
            $table->bigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('authorized_person')->nullable();;
            $table->string('authorized_person_phone');
            $table->integer('status_id')->default(Person::PERSONS_STATUS_PASSIVE);
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
        Schema::dropIfExists('persons');
    }
}
