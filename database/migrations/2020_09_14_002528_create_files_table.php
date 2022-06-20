<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('creator_id');
            $table->tinyInteger('type_id');
            $table->integer('contract_id')->nullable();
            $table->integer('fixture_id')->nullable();
            $table->integer('note_id')->nullable();
            $table->integer('outgoing_id')->nullable();
            $table->integer('payment_dept_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('person_id')->nullable();
            $table->string('name');
            $table->string('hash');
            $table->string('path');
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('temp')->default(1);
            $table->date('upload_date');
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
        Schema::dropIfExists('files');
    }
}
