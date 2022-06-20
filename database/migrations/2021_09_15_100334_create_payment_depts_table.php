<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_depts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('creator_id');
            $table->integer('contract_id')->nullable();
            $table->integer('payment_method_id');
            $table->integer('payment_account_id')->nullable();
            $table->tinyInteger('payment_type_id')->nullable();
            $table->float('amount');
            $table->float('amount_dept')->default(0);
            $table->string('currency');
            $table->text('comment')->nullable();
            $table->date('due_date')->nullable();
            $table->tinyInteger('status_id');
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('payment_depts');
    }
}
