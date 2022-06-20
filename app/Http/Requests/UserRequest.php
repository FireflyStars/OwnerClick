<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            ],
            'language' => ['required', 'min:2'],
            'location' => ['required'],
            'currency' => ['required', 'min:2'],
            'timezone' => ['required', 'min:2'],
            'date_format' => ['required', 'min:2'],
            'time_format' => ['required', 'min:2'],
            'password' => [
                $this->route()->user ? 'nullable' : 'required', 'confirmed', 'min:6'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('dashboard.name'),
            'email' => __('dashboard.unit'),
            'language' => __('dashboard.language'),
            'location' => __('dashboard.location'),
            'currency' => __('dashboard.money_currency'),
            'timezone' => __('dashboard.timezone'),
            'date_format' => __('dashboard.date_format'),
            'time_format' => __('dashboard.time_format'),
            'password' => __('dashboard.password'),
        ];
    }


}
