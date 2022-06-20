<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('creator_id');
            $table->integer('unit_id');
            $table->integer('contract_id')->nullable();
            $table->tinyInteger('payment_type_id');
            $table->string('name');
            $table->float('amount');
            $table->string('currency');
            $table->text('comment')->nullable();
            $table->date('outgoing_date');
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
        Schema::dropIfExists('outgoings');
    }
}
