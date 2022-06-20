<?php

namespace App\Http\Requests;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contract_template_id' => [
                'required_if:contract,newContract', 'string'
            ],
            'rental_price' => [
                'required', 'numeric'
            ],
            'deposit_price' => [
                'required', 'numeric'
            ],
            'payment_method_id' => [
                'required', 'integer'
            ],
            'payment_account_id' => [
                "required_if:payment_method_id,".Payment::PAYMENT_METHOD_BANK_TRANSFER
            ],
            'start_date' => [
                'required', 'date_format:' . auth()->user()->date_format
            ],
            'end_date' => [
                'required', 'date_format:' . auth()->user()->date_format, 'after:start_date'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'rental_price' => __('dashboard.rent_fee'),
            'deposit_price' => __('dashboard.deposit_fee'),
            'payment_method_id' => __('dashboard.payment_method'),
            'payment_account_id' => __('dashboard.payment_account'),
            'start_date' => __('dashboard.start_date'),
            'end_date' => __('dashboard.end_date'),
        ];
    }
}
