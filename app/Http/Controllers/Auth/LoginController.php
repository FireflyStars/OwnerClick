<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginHistory;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DateTime;
use App\Models\SocialAccount;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

//
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
//
//    protected function authenticated(Request $request, $user)
//    {
//        return redirect(RouteServiceProvider::HOME);
//    }

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function providerCallback(Request $request, string $provider)
    {
        try {

            $social_user = Socialite::driver($provider)->stateless()->user();
//            $social_user = Socialite::driver($provider)->user();

            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id' => $social_user->getId()
            ])->first();

            // If Social Account Exist then Find User and Login
            if ($account) {
                Auth::login($account->user, true);
                event(new LoginHistory($account->user));
                $filename = $this->getAvatarFilename($account->user);
                if($filename == ''){
                    $user = \auth()->user();
                    $user->avatar = $filename;
                    $user->update(['avatar']);
                }
                return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
            }

            // Find User
            $user = User::where([
                'email' => $social_user->getEmail()
            ])->first();

            // If User not get then create new user
            if (!$user) {
                $getCurrenctLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
                $getCurrentRegional = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleRegional();
                $countryISO2 = explode('_', $getCurrentRegional);
                if (count($countryISO2) != 0) {
                    $countryISO2 = $countryISO2[1];
                }

                $filename = $this->getAvatarFilename($social_user);

                $user = User::create([
                    'name' => $social_user->getName(),
                    'email' => $social_user->getEmail(),
                    'avatar' => $filename,
                    'provider_id' => $social_user->getId(),
                    'provider' => $provider,
                    'language' => $getCurrentRegional,
                    'location' => $getCurrenctLocale,
                    'timezone' => \config('app.timezone', 'UTC'),
                    'date_format' => DateTime::getDateFormats()[0]['id'],
                    'time_format' => DateTime::getTimeFormats()[0]['id'],
                    'currency' => Country::query()->where('iso2', $countryISO2)->get('currency')->first()->currency,
                ]);
                if ($user->markEmailAsVerified()) {
                    event(new Verified($user));
                }
            }

            // Login
            Auth::login($user, true);
            event(new LoginHistory($user));
            $filename = $this->getAvatarFilename($social_user);
            $user->avatar = $filename;
            $user->update(['avatar']);

            // Create Social Accounts
            $user->socialAccounts()->create([
                'provider_id' => $social_user->getId(),
                'social_id' => $social_user->getId(),
                'provider_name' => $provider,
                'avatar' => $social_user->getAvatar(),
            ]);


            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->intended($this->redirectPath());

        } catch (\Exception $e) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->intended($this->redirectPath());
        }
    }
//    /**
//     * Redirect the user to the Google authentication page.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function redirectToProvider($provider)
//    {
//        return Socialite::driver($provider)->redirect();
//
//    }

//    /**
//     * Obtain the user information from Google. https://console.developers.google.com/apis/credentials/oauthclient/
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function handleProviderCallback($provider)
//    {
//        /**
//         * @var User
//         */
//        $userSocial = Socialite::driver($provider)->user();
//
//        /**
//         * @var User $user
//         */
//        $user = User::where(['email' => $userSocial->getEmail()])->first();
//
//        if (!$user) {
//            $getCurrenctLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
//            $getCurrentRegional = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleRegional();
//            $countryISO2 = explode('_', $getCurrentRegional);
//            if (count($countryISO2) != 0) {
//                $countryISO2 = $countryISO2[1];
//            }
//            $user = User::create([
//                'name' => $userSocial->getName(),
//                'email' => $userSocial->getEmail(),
//                'avatar' => $userSocial->getAvatar(),
//                'provider_id' => $userSocial->getId(),
//                'provider' => $provider,
//                'language' => $getCurrentRegional,
//                'location' => $getCurrenctLocale,
//                'timezone' => \config('app.timezone', 'UTC'),
//                'date_format' => DateTime::getDateFormats()[0]['id'],
//                'time_format' => DateTime::getTimeFormats()[0]['id'],
//                'currency' => Country::query()->where('iso2', $countryISO2)->get('currency')->first()->currency,
//            ]);
//            if ($user->markEmailAsVerified()) {
//                event(new Verified($user));
//            }
//            $paymentAccount = new PaymentAccount();
//            $paymentAccount->creator_id = $user->id;
//            $paymentAccount->owner_name = "";
//            $paymentAccount->type_id = PaymentAccount::PAYMENT_ACCOUNT_TYPE_CASH;
//            $paymentAccount->account_name = "Nakit";
//            $paymentAccount->save();
//        }
//        auth()->login($user);
//        return redirect()->to('/home');
//
//    }

//    /**
//     * Obtain the user information from Twitter.
//     *
//     * @return Response
//     */
//    public function handleProviderCallback(Request $request, $provider)
//    {
//        $user = Socialite::driver($provider)->stateless()->user();
//        $authUser = $this->findOrCreateUser($user, $provider);
//        Auth::login($authUser, true);
//        //todo LoginHistory eventi normal login kısmınada konulması gerekmektedir.
//        event(new LoginHistory($user));
//        return redirect($this->redirectTo);
//    }
//
//    /**
//     * If a user has registered before using social auth, return the user
//     * else, create a new user object.
//     * @param  $user Socialite user object
//     * @param $provider Social auth provider
//     * @return  User
//     */
//    public function findOrCreateUser($user, $provider)
//    {
//        $authUser = User::where('provider_id', $user->id)->first();
//        if ($authUser) {
//            return $authUser;
//        }
//
//
//        $getCurrenctLocale = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
//        $getCurrentRegional = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleRegional();
//        $countryISO2 = explode('_', $getCurrentRegional);
//        if (count($countryISO2) != 0) {
//            $countryISO2 = $countryISO2[1];
//        }
//        $country = Country::query()->where('iso2', $countryISO2)->get(['currency', 'id'])->first();
//
//        $filename = '';
//        if (!is_null($user->getAvatar()) or $user->getAvatar() != "") {
//            $fileContents = file_get_contents($user->getAvatar());
//            $filename = Str::random(9) . "-" . auth()->id() . '.jpg';
//            Storage::put('public/avatars/' . $filename, $fileContents);
//        }
//
//        $user = User::create([
//            'name' => $user->getName(),
//            'email' => $user->getEmail(),
//            'avatar' => $filename,
////            'provider_id' => $user->getId(),
////            'provider' => $provider,
//            'language' => $getCurrentRegional,
//            'location' => $country->id,
//            'timezone' => \config('app.timezone', 'UTC'),
//            'date_format' => DateTime::getDateFormats()[0]['id'],
//            'time_format' => DateTime::getTimeFormats()[0]['id'],
//            'currency' => $country->currency,
//        ]);
//
//
//        if (!$user->hasVerifiedEmail()) {
//            $user->markEmailAsVerified();
//        }
//
//
//
//        return $user;
//    }
    /**
     * @param $user
     * @return string
     */
    public function getAvatarFilename($user): string
    {
        $filename = '';
        if (!is_null($user->getAvatar()) or $user->getAvatar() != "") {
            $fileContents = file_get_contents($user->getAvatar());
            $filename = Str::random(9) . "-" . auth()->id() . '.jpg';
            Storage::disk('public')->put('avatars/' . $filename, $fileContents);
        }
        return $filename;
    }
}
