<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_changes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('change_type')->nullable();;
            $table->integer('contract_id');
            $table->integer('creator_id')->nullable();
            $table->integer('contract_template_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('rental_price')->nullable();
            $table->string('rental_currency')->nullable();
            $table->integer('deposit_price')->nullable();
            $table->string('deposit_currency')->nullable();
            $table->integer('payment_period')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->integer('payment_account_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->integer('contract_terminate_id')->nullable();
            $table->longText('image')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('status_id')->nullable();
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
        Schema::dropIfExists('contract_changes');
    }
}
