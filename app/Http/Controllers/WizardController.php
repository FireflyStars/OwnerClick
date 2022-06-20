<?php

namespace App\Http\Controllers;

use App\Exceptions\UnitOwnersException;
use App\Http\Requests\ConfirmProfileRequest;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\ContractTemplate;
use App\Http\Requests\ContractRequest;
use App\Models\Contract;
use App\Models\Country;
use App\Models\DateTime;
use App\Models\Payment;
use App\Models\PaymentAccount;
use App\Models\PaymentDept;
use App\Models\Person;
use App\Models\Timezone;
use App\Models\Unit;
use App\Models\UnitPerson;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WizardController extends Controller
{


    /**
     * @return \Illuminate\View\View
     */
    public function newContract($unit_id = null)
    {
        if (Unit::ownersCount($unit_id) == 0) {
            throw new UnitOwnersException();
        }

        $contract = new Contract();

        if(PaymentAccount::query()->count('id')>0){
        $contract->payment_method_id = Payment::PAYMENT_METHOD_BANK_TRANSFER;
        }

        $data = [
            'contract' => $contract,
            'newPerson' => new Person(),
            'formMethod' => 'post',
            'formAction' => 'contracts.store',
            'unit_id' => $unit_id,
            'unitPerson' => [],
        ];


        return view('wizard.persons', $data);
        return view('tutorial.persons', $data);

    }

    public function profile(Request $request)
    {
        $data = [
            'formMethod' => 'put',
            'formActionPerson' => 'wizard.confirm-person',
            'formActionGeographic' => 'wizard.confirm-geographic',
            'person' => new Person()
        ];
        $data['timezones'] = array_map(function ($item) {
            return $item = ['id' => $item->name, 'name' => "($item->offset) $item->name"];
        }, Timezone::Orderby('offset')->get()->all());
        $data['profile'] = auth()->user();
        $data['currencies'] = Country::currencies();
        $data['dateFormats'] = DateTime::getDateFormats();
        $data['timeFormats'] = DateTime::getTimeFormats();
        $data['language'] = [];
        foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
            $data['language'][] = ['id' => $value['regional'], 'name' => $value['native']];
        }

        if ($request->ajax()) {
            return view('tutorial.profile-confirm', $data);
        } else {
            return view('tutorial.profile-confirm', $data);
        }
    }

    /**
     * Update the profile
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmGeographic(ConfirmProfileRequest $request)
    {
        $all = $request->all();
        Auth::user()->update($all);
        $data = ['status' => true,
            'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.geographic_settings_updated')]];
        return \response()->json($data);
    }

    /**
     * Update the profile
     *
     * @param \App\Http\Requests\PersonRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmPerson(PersonRequest $request)
    {
//        $all = $request->merge(['confirm_profile_at' => Carbon::now()->toString()])->all();
        $person = Person::query()->where('user_id', Auth::id())->first();
        if (!$person) {
            $person = new Person($request->all());
            $person->creator_id = Auth::id();
            $person->user_id = Auth::id();
        } else {
            $person->fill($request->all());
        }

        $person->save();

        auth()->user()->update(['confirm_profile_at' => Carbon::now()->toString()]);


        $data = ['status' => true,
            'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.profile_settings_updated')]];
        return \response()->json($data);
    }

}
