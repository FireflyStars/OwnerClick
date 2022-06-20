<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ConvertPaymentsToPaymentDepts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $paymentDepts = \App\Models\Payment::query()->whereNull('ref_payment_id')->get();
        foreach ($paymentDepts as $paymentDept){
            Auth::login(User::find($paymentDept->creator_id));
            $paymentDept = \App\Models\Payment::find($paymentDept->id);
            $new = new \App\Models\PaymentDept();
            $new->creator_id = $paymentDept->creator_id;
            $new->contract_id = $paymentDept->contract_id;
            $new->payment_method_id = $paymentDept->payment_method_id;
            $new->payment_account_id = $paymentDept->payment_account_id;
            $new->payment_type_id = $paymentDept->payment_type_id;
            $new->amount = $paymentDept->amount;
            $new->currency = $paymentDept->currency;
            $new->due_date = $paymentDept->due_date;
            $new->comment = $paymentDept->comment;
            $new->status_id = $paymentDept->status_id;
            $new->active = $paymentDept->active;
            echo $new->save();
            \App\Models\Payment::query()->where('ref_payment_id',$paymentDept->id)->update(['ref_payment_id'=>$new->id]);
            Auth::logout();
        }
        \App\Models\Payment::query()->whereNull('ref_payment_id')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_depts', function (Blueprint $table) {
            //
        });
    }
}
