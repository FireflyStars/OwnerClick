<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentDeptRequest;
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

class PaymentDeptController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['paymentDept'] = PaymentDept::find($id);
        $data['payments'] = Payment::query()->where(['ref_payment_id' => $id])->get();

        return view('payment-depts.detail', $data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $propertyId = \Illuminate\Support\Facades\Request::input('unit_id');
        $paymentDept = new PaymentDept();
        $paymentDept->payment_method_id = Payment::PAYMENT_METHOD_BANK_TRANSFER;

        $data = [
            'paymentDept' => $paymentDept,
            'contracts' => Contract::query()->where('unit_id', $propertyId)->get(['contracts.id', DB::raw("CONCAT(start_date,' - ',end_date) as name")])->toArray(),
            'formMethod' => 'post',
            'formAction' => 'payment-depts.store',
        ];
        return view('payment-depts.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\PaymentDept $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PaymentDeptRequest $request, PaymentDept $model)
    {

        $model = PaymentDept::create($request->merge(['creator_id' => Auth::id(), 'status_id' => PaymentDept::PAYMENT_STATUS_WAITING_PAYMENT])->all());
        $files = (array)$request->get('files');
        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->payment_dept_id = $model->id;
            $fileUpdate->contract_id = $model->contract_id;
            $fileUpdate->unit_id = Contract::query()->where('id', $model->contract_id)->get(['unit_id'])->first()->unit_id;
            $fileUpdate->save();
        }

        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_dept_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
    }

    /**
     * @param \App\Models\PaymentDept $paymentDept
     * @return \Illuminate\View\View
     */
    public function edit(PaymentDept $paymentDept)
    {
        $unitId = \Illuminate\Support\Facades\Request::input('unit_id');

        $data = [
            'paymentDept' => $paymentDept,
            'formMethod' => 'PUT',
            'contracts' => Contract::query()->where('unit_id', $unitId)->get(['contracts.id', DB::raw("CONCAT(start_date,' - ',end_date) as name")])->toArray(),
            'formAction' => 'payment-depts.update'
        ];

        return view('payment-depts.create', $data);
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PaymentDeptRequest $request, PaymentDept $paymentDept)
    {
        $paymentDept->update($request->all());
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->payment_dept_id = $paymentDept->id;
            $fileUpdate->contract_id = $paymentDept->contract_id;
            $fileUpdate->unit_id = Contract::query()->where('id', $paymentDept->contract_id)->get(['unit_id'])->first()->unit_id;
            $fileUpdate->save();
        }
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_dept_updated_successfully')], 'data' => ['id' => $paymentDept->id, 'name' => $paymentDept->name]]);
    }

    /**
     * @param \App\Http\Requests\PaymentDeptRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passive($paymentDeptId)
    {
        $paymentDept = PaymentDept::find($paymentDeptId);
        $paymentDept->active = PaymentDept::PAYMENT_ACTIVE_FALSE;
        $paymentDept->update(['active']);
        Payment::query()->where('ref_payment_id', $paymentDeptId)->update(['active' => PaymentDept::PAYMENT_ACTIVE_FALSE]);
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_dept_is_inactive')], 'data' => ['id' => $paymentDept->id, 'name' => $paymentDept->name]]);
    }

    /**
     * @param \App\Http\Requests\PaymentDeptRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active($paymentDeptId)
    {
        $paymentDept = Payment::find($paymentDeptId);
        $paymentDept->active = PaymentDept::PAYMENT_ACTIVE_TRUE;
        $paymentDept->update(['active']);
        Payment::query()->where('ref_payment_id', $paymentDeptId)->update(['active' => PaymentDept::PAYMENT_ACTIVE_TRUE]);

        $data = [
            'status' => true,
            'message' => ['type' => 'success',
                'title' => __('alert.success'),
                'text' => __('alert.payment_dept_is_active')],
            'data' => ['id' => $paymentDept->id,
                'name' => $paymentDept->name]
        ];

        return \response()->json($data);
    }


    /**
     * @param \App\Models\PaymentDept $paymentDept
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PaymentDept $paymentDept)
    {
        $paymentDept->delete();
    }

}
