<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'contract_id' => [
                'integer'
            ],
            'unit_id' => [
                'integer'
            ],
            'title' => [
                'required', 'string'
            ],
            'note' => [
                'required', 'string'
            ]

        ];
    }

    public function attributes()
    {
        return [
            'contract_id' => __('dashboard.contract'),
            'unit_id' => __('dashboard.unit'),
            'title' => __('dashboard.title'),
            'note' => __('dashboard.note'),
        ];
    }
}
