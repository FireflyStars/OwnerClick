<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContractRenewalRequest extends FormRequest
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
            'rental_price' => [
                'required', 'numeric'
            ],
            'end_date' => [
                'required', 'date_format:' . auth()->user()->date_format
            ],
        ];
    }

    public function attributes()
    {
        return [
            'rental_price' => __('dashboard.new_rent_fee'),
            'end_date' => __('dashboard.end_date'),
        ];
    }

}
