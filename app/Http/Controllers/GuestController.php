<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Toaster;

class GuestController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function partnerShip(){
        return view('home.partnership');
    }

    public function requestDemo(){
        return view('home.request-demo');
    }
    public function home(){
        return view('home.home');
    }

    // Store Contact Form data
    public function ContactUsForm(ContactRequest $request) {
//
//        // Form validation
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email',
//            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
//            'subject'=>'required',
//            'message' => 'required'
//        ]);

        //  Store data in database
        Contact::create($request->all());

        //
        toast(__('home.received_message'),'success');
        return back()->with('success',__('home.received_message'));
    }

    public function userAgreement(){
        return view('home.user-agreement');
       // return __('contracts.user-agreement');
    }

    public function privacyPolicy(){
        return view('home.privacy-policy');

       // return __('contracts.privacy-policy');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function howItWorks(){
        return view('home.how-it-works');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function aboutUs(){
        return view('home.about-us');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function features(){
        return view('home.features');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function faq(){
        return view('home.faq');

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contact(){
        return view('home.contact');

    }

}
