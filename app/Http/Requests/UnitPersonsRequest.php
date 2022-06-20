<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnitPersonsRequest extends FormRequest
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
            'person_id.*' => [
                'required','integer'
            ],
            'share.*' => [
                'required','lte:1'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'person_id.*' => __('dashboard.person'),
            'share.*' => __('dashboard.share_ratio'),
        ];
    }
}
