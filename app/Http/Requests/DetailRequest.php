<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DetailRequest extends FormRequest
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
            'type_id' => [
                'required', 'integer'
            ],
            'unit_id' => [
                'required', 'integer'
            ],
            'detail' => [
                'required', 'string'
            ],
            'value' => [
                'required', 'string'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'type_id' => __('dashboard.type'),
            'unit_id' => __('dashboard.unit'),
            'detail' => __('dashboard.detail'),
            'value' => __('dashboard.value'),
        ];
    }

}
