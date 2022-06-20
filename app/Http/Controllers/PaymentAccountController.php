<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentAccountRequest;
use App\Models\PaymentAccount;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PaymentAccountController extends Controller
{


    /**
     * @param PaymentAccount $paymentAccount
     * @return \Illuminate\View\View
     */
    public function index(PaymentAccount $paymentAccount)
    {

        $data = [
            'paymentAccounts' => $paymentAccount->paginate(15)
        ];
        if(request()->ajax()){
            return view('payment-accounts.index', $data)->renderSections()['content'];
        }else{
            return view('payment-accounts.index', $data);
        }

    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['paymentAccount'] = PaymentAccount::find($id);
        return view('payment-accounts.detail',$data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'paymentAccount' => new PaymentAccount(),
            'formMethod' => 'post',
            'formAction' => 'payment-accounts.store'
        ];
        return view('payment-accounts.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\PaymentAccount $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PaymentAccountRequest $request, PaymentAccount $model)
    {
        $model = PaymentAccount::create($request->merge(['creator_id' => Auth::id()])->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' =>  __('alert.payment_account_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->account_name]]);
    }

    /**
     * @param \App\Models\PaymentAccount $paymentAccount
     * @return \Illuminate\View\View
     */
    public function edit(PaymentAccount $paymentAccount)
    {
        $data = [
            'paymentAccount' => $paymentAccount,
            'formMethod' => 'PUT',
            'formAction' => 'payment-accounts.update'
        ];

        return view('payment-accounts.create', $data);
    }

    /**
     * @param \App\Http\Requests\PaymentAccountRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PaymentAccountRequest $request, PaymentAccount $paymentAccount)
    {
        $paymentAccount->update($request->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.payment_account_updated_successfully')]]);
    }

    /**
     * @param \App\Models\PaymentAccount $paymentAccount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PaymentAccount $paymentAccount)
    {
        $paymentAccount->delete();

/*        return redirect()->route('payment-accounts.index')->withStatus(__('Gayrimenkul silme işlemi başarıyla gerçekleşmiştir.'));*/
    }
}
