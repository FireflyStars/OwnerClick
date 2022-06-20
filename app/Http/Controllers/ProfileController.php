<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\DateTime;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Timezone;
use App\Models\User;
use Carbon\Traits\Date;
use Cknow\Money\LocaleTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Money\Currencies\CurrencyList;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Money;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $profile)
    {
        $data['timezones'] = array_map(function($item){return $item = ['id'=>$item->name,'name' =>"($item->offset) $item->name"]; },Timezone::Orderby('offset')->get()->all());
        $data['profile'] = auth()->user();
        $data['currencies'] = Country::currencies();
        $data['dateFormats'] = DateTime::getDateFormats();
        $data['timeFormats'] = DateTime::getTimeFormats();
        $data['language'] = [];
        foreach(LaravelLocalization::getSupportedLocales() as $key => $value){
            $data['language'][] = ['id' => $value['regional'], 'name' => $value['native']];
        }
        return view('profile.edit',$data);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

        auth()->user()->update($request->all());
        $changeLang = explode('_',\auth()->user()->language)[0];
        App::setLocale($changeLang);
        LaravelLocalization::setLocale($changeLang);
        session(['locale' => $changeLang]);
        $segments = str_replace(url('/'), '', url()->previous());
        $segments = array_filter(explode('/', $segments));
        array_shift($segments);
        array_unshift($segments, $changeLang);

        return redirect(implode('/', $segments))->withStatus(__('alert.profile_successfully_updated'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('alert.password_successfully_updated'));
    }


    /**
     * Change the password
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publicData()
    {
        return auth()->user()->publicData();
    }
}
