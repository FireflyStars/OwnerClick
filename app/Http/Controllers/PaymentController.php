<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Http\Requests\UserRequest;
use App\Models\PaymentDept;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['payment'] = Payment::find($id);
        $data['refPayments'] = Payment::query()->where(['ref_payment_id' => $id])->get();

        return view('payments.detail', $data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $propertyId = \Illuminate\Support\Facades\Request::input('unit_id');
        $ref_payment_id = \Illuminate\Support\Facades\Request::input('ref_payment_id');

        $payment = new Payment();
        $paymentDept = PaymentDept::find($ref_payment_id);
        $payment->payment_method_id = $paymentDept->payment_method_id;
        $payment->payment_account_id = $paymentDept->payment_account_id;
        $payment->payment_type_id = $paymentDept->payment_type_id;
        $payment->comment = $paymentDept->comment;
        $payment->currency = $paymentDept->currency;
        $payment->amount = $paymentDept->amount - $paymentDept->amount_dept;

        if ($payment->payment_date === null) {
            $payment->payment_date = Carbon::now()->format(\auth()->user()->date_format);
        }

        $data = [
            'payment' => $payment,
            'contracts' => Contract::query()->where('unit_id', $propertyId)->get(['contracts.id', DB::raw("CONCAT(start_date,' - ',end_date) as name")])->toArray(),
            'formMethod' => 'post',
            'formAction' => 'payments.store',
        ];
        return view('payments.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Payment $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PaymentRequest $request, Payment $model)
    {
        $ref_payment_id = \Illuminate\Support\Facades\Request::input('ref_payment_id');
        $payment = PaymentDept::find($ref_payment_id);
        $model = Payment::create($request->merge(['contract_id' => $payment->contract_id, 'creator_id' => Auth::id(), 'status_id' => PaymentDept::PAYMENT_STATUS_PAID, 'currency' => $payment->currency])->all());

        $files = (array)$request->get('files');
        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->payment_id = $model->id;
            $fileUpdate->contract_id = $model->contract_id;
            $fileUpdate->unit_id = Contract::query()->where('id', $model->contract_id)->get(['unit_id'])->first()->unit_id;
            $fileUpdate->save();
        }

        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
    }

    /**
     * @param \App\Models\Payment $payment
     * @return \Illuminate\View\View
     */
    public function edit(Payment $payment)
    {
        $unitId = \Illuminate\Support\Facades\Request::input('unit_id');

        if ($payment->payment_date === null) {
            $payment->payment_date = Carbon::now()->format((\auth()->user()->date_format));
        }


        $data = [
            'payment' => $payment,
            'formMethod' => 'PUT',
            'contracts' => Contract::query()->where('unit_id', $unitId)->get(['contracts.id', DB::raw("CONCAT(start_date,' - ',end_date) as name")])->toArray(),
            'formAction' => 'payments.update'
        ];

        return view('payments.create', $data);
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->payment_id = $payment->id;
            $fileUpdate->contract_id = $payment->contract_id;
            $fileUpdate->unit_id = Contract::query()->where('id', $payment->contract_id)->get(['unit_id'])->first()->unit_id;
            $fileUpdate->save();
        }
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_updated_successfully')], 'data' => ['id' => $payment->id, 'name' => $payment->name]]);
    }

    /**
     * @param \App\Http\Requests\PaymentRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passive($paymentId)
    {
        $payment = PaymentDept::find($paymentId);
        $payment->active = PaymentDept::PAYMENT_ACTIVE_FALSE;
        $payment->update(['active']);
        Payment::query()->where('ref_payment_id', $paymentId)->update(['active' => PaymentDept::PAYMENT_ACTIVE_FALSE]);
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_is_inactive')], 'data' => ['id' => $payment->id, 'name' => $payment->name]]);
    }

    /**
     * @param \App\Http\Requests\PaymentRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active($paymentId)
    {
        $payment = PaymentDept::find($paymentId);
        $payment->active = PaymentDept::PAYMENT_ACTIVE_TRUE;
        $payment->update(['active']);
        Payment::query()->where('ref_payment_id', $paymentId)->update(['active' => PaymentDept::PAYMENT_ACTIVE_TRUE]);

        $data = [
            'status' => true,
            'message' => ['type' => 'success',
                'title' => __('alert.success'),
                'text' =>__('alert.payment_is_active')],
            'data' => ['id' => $payment->id,
                'name' => $payment->name]
        ];

        return \response()->json($data);
    }


    /**
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Payment $payment)
    {
        Payment::query()->where('ref_payment_id', $payment->id)->delete();
        $payment->delete();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function payments(\Illuminate\Http\Request $request, $unitId = null)
    {
        $builder = PaymentDept::activePayments();
        if($request->input('unit_id')){
            $builder->join('contracts','payment_depts.contract_id','=','contracts.id')->whereIn('unit_id', explode(',',$request->input('unit_id')));
        }
        if($request->input('status_id')){
            $builder->whereIn('payment_depts.status_id', $request->input('status_id'));
        }
        if($request->input('start_date')){
            $builder->whereDate('payment_depts.due_date','>=',$request->input('start_date'));
        }
        if($request->input('end_date')){
            $builder->whereDate('payment_depts.due_date','<=',$request->input('end_date'));
        }

        $data['paymentDepts'] = $builder->get('payment_depts.*')->all();
        $data['dashboard'] = true;

        return view('modals.payment-dept', $data);


        return redirect()->route('properties.index');
    }

}
