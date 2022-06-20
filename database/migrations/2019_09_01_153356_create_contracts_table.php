<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('creator_id');
            $table->integer('contract_template_id')->nullable();
            $table->integer('unit_id');
            $table->integer('rental_price');
            $table->string('rental_currency');
            $table->integer('deposit_price');
            $table->string('deposit_currency');
            $table->integer('payment_period');
            $table->integer('payment_method_id');
            $table->integer('payment_account_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('notes')->nullable();
            $table->integer('contract_terminate_id')->nullable();
            $table->longText('image')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('status_id');
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
        Schema::dropIfExists('contracts');
    }
}
