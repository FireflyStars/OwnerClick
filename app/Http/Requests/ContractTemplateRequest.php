<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContractTemplateRequest extends FormRequest
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
            'name' => [
                'required', 'string'
            ],
            'template' => [
                'required', 'string'
            ],
        /*    'contractTemplateFile' => [
                'required', 'file'
            ],*/
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('dashboard.name'),
            'template' => __('dashboard.template'),
        ];
    }
}
