<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ConfirmProfileRequest extends FormRequest
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
            'language' => ['required'],
            'location' => ['required'],
            'currency' => ['required'],
            'timezone' => ['required'],
            'date_format' => ['required'],
            'time_format' => ['required'],
        ];
    }
    public function attributes()
    {
        return [
            'language' => __('dashboard.language'),
            'location' => __('dashboard.location'),
            'currency' => __('dashboard.money_currency'),
            'timezone' => __('dashboard.timezone'),
            'date_format' => __('dashboard.date_format'),
            'time_format' => __('dashboard.time_format'),
        ];
    }
}
