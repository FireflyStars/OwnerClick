<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'language' => ['required', 'min:2'],
            'location' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('dashboard.name'),
            'email' => __('dashboard.unit'),
            'language' => __('dashboard.language'),
            'location' => __('dashboard.location'),
        ];
    }
}
