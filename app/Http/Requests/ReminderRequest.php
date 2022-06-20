<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     *
     * @return array
     */
    public function rules()
    {
        return [

            'title' => [
                'required',   'string'
            ],
            'note' => [
                'required', 'string'
            ],
            'reminder_date' => [
                'required',
            ],
            'reminder_time' => [
                'required',
            ]
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('dashboard.title'),
            'note' => __('dashboard.comment'),
            'reminder_date' => __('dashboard.reminder_date'),
            'reminder_time' => __('dashboard.reminder_time'),
        ];
    }

}
