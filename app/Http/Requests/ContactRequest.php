<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return auth()->guest();
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
                'required'
            ],
            'email' => [
                'required', 'email'
            ],
            'phone' => [
                'required', 'regex:/^([0-9\s\-\+\(\)]*)$/','min:10'
            ],
            'subject' => [
                'required'
            ],
            'message' => [
                'required'
            ],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('input_name'),
            'email' => __('input_email'),
            'phone' => __('input_phone'),
            'subject' => __('input_subject'),
            'message' => __('input_message'),
        ];
    }
}
