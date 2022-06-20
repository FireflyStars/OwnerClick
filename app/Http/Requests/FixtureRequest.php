<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FixtureRequest extends FormRequest
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

            'unit_id' => [
                'required',   'integer'
            ],
            'name' => [
                'required', 'string'
            ],
            'comment' => [
                'string','nullable'
            ],
            'count' => [
                'required', 'string'
            ],
            'status_id' => [
                'required', 'integer'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'unit_id' => __('dashboard.unit'),
            'name' => __('dashboard.fixture_name'),
            'comment' => __('dashboard.comment'),
            'count' => __('dashboard.piece_unit'),
            'status_id' => __('dashboard.status'),
        ];
    }

}
