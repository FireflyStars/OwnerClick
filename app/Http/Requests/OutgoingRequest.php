<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OutgoingRequest extends FormRequest
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
            'payment_type_id' => [
                'required', 'integer'
            ],
            'amount' => [
                'required', 'numeric'
            ],
            'currency' => [
                'required', 'string'
            ],
            'outgoing_date' => [
                'required', 'date_format:' . auth()->user()->date_format
            ],
            'name' => [
                'string',
            ],
            'comment' => [
                'string','nullable'
            ]

        ];
    }


    public function attributes()
    {
        return [
            'payment_type_id' => __('dashboard.payment_type'),
            'amount' => __('dashboard.amount'),
            'currency' => __('dashboard.money_currency'),
            'outgoing_date' => __('dashboard.outgoing_date'),
            'name' => __('dashboard.name'),
            'comment' => __('dashboard.comment'),
        ];
    }
}
