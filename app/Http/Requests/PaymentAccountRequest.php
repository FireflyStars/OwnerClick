<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentAccountRequest extends FormRequest
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
            'account_name' => [
                'required', 'string'
            ],
            'owner_name' => [
                'required','string'
            ],
            'iban' => [
                'required','string'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'account_name' => __('dashboard.record_name'),
            'owner_name' => __('dashboard.owner_account'),
            'iban' => __('dashboard.iban'),
        ];
    }
}
