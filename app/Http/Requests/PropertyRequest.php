<?php

namespace App\Http\Requests;

use App\Models\Property;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
                'required', 'min:3','max:255'
            ],
            'type_id' => [
                'required', 'integer'
            ],
            'country_id' => [
                'required', 'integer'
            ],
            'city_id' => [
                'required', 'integer'
            ],
            'state_id' => [
                'required', 'integer'
            ],
//            'region' => [
//                'required', 'string'
//            ],
//            'zip_code' => [
//                'required', 'string'
//            ],
//            'building_no' => [
//                "required_if:type_id,".Property::PROPERTY_TYPE_COMMERCIAL.",".Property::PROPERTY_TYPE_BUILDING.",".Property::PROPERTY_TYPE_INDUSTRIAL.",".Property::PROPERTY_TYPE_PROJECT_SITE
//            ],
            'address' => [
                'required', 'string','min:10'
            ],
            'floor.*' => [
                'string'
            ],
            'apartment_no.*' => [
                'string'
            ],
        ];
    }
    public function attributes()
    {
        return [
            'name' => __('dashboard.property_name'),
            'type_id' => __('dashboard.type'),
            'country_id' => __('dashboard.country'),
            'city_id' => __('dashboard.city'),
            'state_id' => __('dashboard.state'),
            'address' => __('dashboard.address'),
        ];
    }

}
