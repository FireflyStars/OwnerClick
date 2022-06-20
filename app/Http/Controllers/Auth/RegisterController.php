<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Models\Country;
use App\Models\DateTime;
use App\Models\PaymentAccount;
use App\Models\Timezone;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Ramsey\Uuid\Type\Time;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[],[
            'name' => __('input_name'),
            'email' => __('input_email'),
            'password' => __('input_password'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $getCurrenctLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
        $getCurrentRegional = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleRegional();
        $countryISO2 = explode('_',$getCurrentRegional);
        if(count($countryISO2) != 0){
            $countryISO2 = $countryISO2[1];
        }
        $country = Country::query()->where('iso2', $countryISO2)->get(['currency','id'])->first();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'language' => $getCurrentRegional,
            'location' => $country->id,
            'timezone' => \config('app.timezone', 'UTC'),
            'date_format' => DateTime::getDateFormats()[0]['id'],
            'time_format' => DateTime::getTimeFormats()[0]['id'],
            'currency' => $country->currency,
            'password' => Hash::make($data['password']),
        ]);


        return $user;
    }
}
