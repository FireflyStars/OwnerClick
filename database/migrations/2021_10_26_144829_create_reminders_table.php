<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('creator_id');
            $table->tinyInteger('type_id');
            $table->bigInteger('contract_id')->nullable();
            $table->bigInteger('fixture_id')->nullable();
            $table->bigInteger('note_id')->nullable();
            $table->bigInteger('outgoing_id')->nullable();
            $table->bigInteger('payment_dept_id')->nullable();
            $table->bigInteger('payment_id')->nullable();
            $table->bigInteger('unit_id')->nullable();
            $table->bigInteger('person_id')->nullable();
            $table->string('title');
            $table->text('note');
            $table->dateTime('send_at');
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
        Schema::dropIfExists('reminders');
    }
}
