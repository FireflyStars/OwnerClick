<?php
//use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractTemplateController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemOrderController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\PaymentAccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDeptController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PushController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitPersonsController;
use App\Http\Controllers\WizardController;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login/{provider}/callback', [LoginController::class, 'providerCallback'])->name('social.providerCallback')->middleware('guest');
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.redirect')->middleware('guest');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    //    Route::get('/login/{provider}/callback', 'Auth[LoginController::class,'handleProviderCallback']);
//    Route::get('/login/{provider}', 'Auth[LoginController::class,'redirectToProvider']);
    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');


    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');

  //  Auth::routes(['verify' => true]);
    Auth::routes();
    Route::group(['middleware' => ['auth']], function () {
        Route::post('/push', [PushController::class, 'store']);
        Route::get('/push/events/{unit_id?}', [PushController::class, 'events'])->name('push.events');
        Route::get('/push/notifications', [PushController::class, 'notifications'])->name('push.notifications');
        Route::get('/push/notifications/read/{notification_id?}', [PushController::class, 'readNotifications'])->name('push.notifications.read');
        Route::get('/push/notifications/unread/{notification_id?}', [PushController::class, 'unreadNotifications'])->name('push.notifications.unread');

        Route::get('/home/payment-donut-chart/{unit_id?}', [HomeController::class, 'paymentDonutChart'])->name('home.payment-donut-chart');
        Route::get('/home/events-info/{unit_id?}', [HomeController::class, 'eventsInfo'])->name('home.events-info');
        Route::get('/home/overdue-payments/{unit_id?}', [HomeController::class, 'overduePayments'])->name('home.overdue-payments');
        Route::get('/home/last-payments/{unit_id?}', [HomeController::class, 'lastPayments'])->name('home.last-payments');
        Route::get('/home/last-notes/{unit_id?}', [HomeController::class, 'lastNotes'])->name('home.last-notes');
        Route::get('/home/near-expires', [HomeController::class, 'nearExpires'])->name('home.near-expires');
        Route::get('/home/payments', [HomeController::class, 'payments'])->name('home.payments');
        Route::get('/home/summary-info', [HomeController::class, 'summaryInfo'])->name('home.summary-info');
        Route::get('/home/overdue', [HomeController::class, 'overdue'])->name('home.overdue');
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
//        Route::resource('user', UserController::class, ['except' => ['show']]);
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
        Route::get('profile/public-data', [ProfileController::class, 'publicData'])->name('profile.public-data');

        Route::get('contracts/wizards/units/{unit_id?}', [WizardController::class, 'newContract'])->name('wizard.contracts');

        Route::get('wizard/confirm', [WizardController::class, 'profile'])->name('wizard.profile',);

        Route::put('wizard/confirm-geographic', [WizardController::class, 'confirmGeographic'])->name('wizard.confirm-geographic');
        Route::put('wizard/confirm-person', [WizardController::class, 'confirmPerson'])->name('wizard.confirm-person');

        Route::get('calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
        Route::resource('calendar', CalendarController::class);
        Route::resource('reminders', ReminderController::class);

        Route::resource('payment-accounts', PaymentAccountController::class);
        Route::resource('persons', PersonController::class);
        Route::resource('details', DetailController::class);
        Route::resource('notes', NoteController::class);
        Route::get('analysis/contract', [AnalysisController::class, 'contract'])->name('analysis.contract');
        Route::resource('analysis', AnalysisController::class);

        Route::put('permission/user/{user_id}/permission/{permission_name}/change', [PermissionController::class, 'change'])->name('permission.change');
        Route::resource('permissions', PermissionController::class);

        Route::put('payments/{payment_id}/passive', [PaymentController::class, 'passive'])->name('payments.passive');
        Route::get('payments/{payment_id}/active', [PaymentController::class, 'active'])->name('payments.active');
        Route::get('payments/total-dept', [PaymentController::class, 'totalDept'])->name('payments.total-dept');
        Route::get('payments/payments', [PaymentController::class, 'payments'])->name('payments.payments');
        Route::resource('payments', PaymentController::class);
        Route::resource('payment-depts', PaymentDeptController::class);

        Route::resource('outgoings', OutgoingController::class);
        Route::resource('units', UnitController::class);
        Route::resource('search', SearchController::class);

        Route::get('units/{unit_id}/files', [UnitController::class, 'files'])->name('units.files');
        Route::get('units/{unit_id}/notes', [UnitController::class, 'notes'])->name('units.notes');
        Route::get('units/{unit_id}/assignments', [UnitController::class, 'assignments'])->name('units.assignments');
        Route::get('units/{unit_id}/expenses', [UnitController::class, 'expenses'])->name('units.expenses');
        Route::get('units/{unit_id}/fixtures', [UnitController::class, 'fixtures'])->name('units.fixtures');
        Route::get('units/{unit_id}/payment-depts', [UnitController::class, 'paymentDepts'])->name('units.payment-depts');
        Route::get('units/{unit_id}/tenants', [UnitController::class, 'tenants'])->name('units.tenants');
        Route::get('units/{unit_id}/details', [UnitController::class, 'details'])->name('units.details');
        Route::get('units/{unit_id}/owners', [UnitPersonsController::class, 'edit'])->name('units.owners');
        Route::get('units/{unit_id}/dashboard', [HomeController::class, 'dashboard'])->name('units.dashboard');
        Route::get('units/{unit_id}/calendar', [CalendarController::class, 'index'])->name('units.calendar');
        Route::get('units/{unit_id}/dashboard/payments', [HomeController::class, 'payments'])->name('units.dashboard.payments');
        Route::get('units/{unit_id}/dashboard/overdue', [HomeController::class, 'overdue'])->name('units.dashboard.overdue');
        Route::get('units/{unit_id}/dashboard/payment-info', [HomeController::class, 'overdue'])->name('units.dashboard.overdue');
        Route::get('units/{unit_id}/dashboard/amountof-dept-info', [HomeController::class, 'amountOfDeptInfo'])->name('units.dashboard.amountof-dept-info');
        Route::get('units/{unit_id}/dashboard/payment-info', [HomeController::class, 'paymentInfo'])->name('units.dashboard.payment-info');


        Route::post('item-order/update', [ItemOrderController::class, 'update'])->name('item-order.update');

        Route::post('files/delete/', [FileController::class, 'destroy'])->name('files.delete');
        Route::get('files/list/', [FileController::class, 'fileList'])->name('files.list');
        Route::get('files/get/{hash}', [FileController::class, 'get'])->name('files.get');
        Route::get('files/download/{hash}', [FileController::class, 'download'])->name('files.download');
        Route::post('files/upload/', [FileController::class, 'upload'])->name('files.upload');
        Route::resource('files', FileController::class);
        Route::get('units/{unit_id}/persons', [UnitPersonsController::class, 'edit'])->name('unit-person.create');
        Route::post('units/{unit_id}/persons', [UnitPersonsController::class, 'store'])->name('unit-person.store');
        Route::put('units/{unit_id}/persons', [UnitPersonsController::class, 'update'])->name('unit-person.update');
        Route::resource('properties', PropertyController::class);

        Route::put('contracts/{contract_id}/terminate', [ContractController::class, 'terminate'])->name('contract.terminate');
        Route::get('contracts/{contract_id}/renewal', [ContractController::class, 'getRenewal'])->name('contract.get-renewal');
        Route::post('contracts/{contract_id}/renewal', [ContractController::class, 'renewal'])->name('contract.renewal');
        Route::resource('contracts', ContractController::class);
        Route::resource('contract-templates', ContractTemplateController::class);
        Route::resource('fixtures', FixtureController::class);
    });
});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [GuestController::class, 'home'])->name('home.home');
    Route::get('/partnership', [GuestController::class, 'partnerShip'])->name('guest.partnership');
    Route::post('/partnership', [GuestController::class, 'ContactUsForm'])->name('contact.store');
    Route::get('/request-demo', [GuestController::class, 'requestDemo'])->name('guest.request-demo');
    Route::post('/request-demo', [GuestController::class, 'ContactUsForm'])->name('contact.store');
    Route::get('/user-agreement', [GuestController::class, 'userAgreement'])->name('contracts.user-agreement');
    Route::get('/privacy-policy', [GuestController::class, 'privacyPolicy'])->name('contracts.privacy-policy');
    Route::get('/how-it-works', [GuestController::class, 'howItWorks'])->name('guest.how-it-works');
    Route::get('/about-us', [GuestController::class, 'aboutUs'])->name('guest.about-us');
    Route::get('/features', [GuestController::class, 'features'])->name('guest.features');
    Route::get('/faq', [GuestController::class, 'faq'])->name('guest.faq');
    Route::get('/contact', [GuestController::class, 'contact'])->name('guest.contact');

//Route::get('/', function () {
//    header('location:/partnership');
//    die;
//});


    Route::get('mysitemap', function () {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $translations['/'] = [['language' => "x-default", 'url' => LaravelLocalization::getLocalizedURL('en', '/')]];
        $translations['/request-demo'] = [['language' => "x-default", 'url' => LaravelLocalization::getLocalizedURL('en', 'request-demo')]];
        $translations['/partnership'] = [['language' => "x-default", 'url' => LaravelLocalization::getLocalizedURL('en', 'partnership')]];
        $translations['/login'] = [['language' => "x-default", 'url' => LaravelLocalization::getLocalizedURL('en', 'login')]];
        $translations['/password/reset'] = [['language' => "x-default", 'url' => LaravelLocalization::getLocalizedURL('en', 'password/reset')]];
        $translations['/register'] = [['language' => "x-default", 'url' => LaravelLocalization::getLocalizedURL('en', 'register')]];

        foreach (LaravelLocalization::getSupportedLocales() as $key => $language) {
            $translations['/'][] = ['language' => $key, 'url' => LaravelLocalization::getLocalizedURL($key, '/')];
            $translations['/request-demo'][] = ['language' => $key, 'url' => LaravelLocalization::getLocalizedURL($key, '/request-demo')];
            $translations['/partnership'][] = ['language' => $key, 'url' => LaravelLocalization::getLocalizedURL($key, '/partnership')];
            $translations['/login'][] = ['language' => $key, 'url' => LaravelLocalization::getLocalizedURL($key, '/login')];
            $translations['/password/reset'][] = ['language' => $key, 'url' => LaravelLocalization::getLocalizedURL($key, '/password/reset')];
            $translations['/register'][] = ['language' => $key, 'url' => LaravelLocalization::getLocalizedURL($key, '/register')];
        }
        $sitemap->add(LaravelLocalization::getLocalizedURL('en', '/'), '2021-01-25T20:10:00+02:00', '1.0', 'monthly', null, null, $translations['/']);
        $sitemap->add(LaravelLocalization::getLocalizedURL('en', '/request-demo'), '2021-01-25T20:10:00+02:00', '0.9', 'monthly', null, null, $translations['/request-demo']);
        $sitemap->add(LaravelLocalization::getLocalizedURL('en', '/partnership'), '2021-01-26T12:30:00+02:00', '0.9', 'monthly', null, null, $translations['/partnership']);
        $sitemap->add(LaravelLocalization::getLocalizedURL('en', '/login'), '2021-01-26T12:30:00+02:00', '0.8', 'monthly', null, null, $translations['/login']);
        $sitemap->add(LaravelLocalization::getLocalizedURL('en', '/password/reset'), '2021-01-26T12:30:00+02:00', '0.5', 'monthly', null, null, $translations['/password/reset']);
        $sitemap->add(LaravelLocalization::getLocalizedURL('en', '/register'), '2021-01-26T12:30:00+02:00', '0.8', 'monthly', null, null, $translations['/register']);


        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        // this will generate file sitemap.xml to your public folder

    });


## BU KISIM SONRADAN API HALINE GETIRILECEK.
    Route::get('api/countries', function (\Illuminate\Http\Request $request) {
        if ($request->query('withFlag') == true) {
            $countries = \App\Models\Country::all(['id', \Illuminate\Support\Facades\DB::raw('CONCAT(emoji," ",name) AS name')]);
        } else {
            $countries = \App\Models\Country::all(['id', 'name', 'emoji']);
        }
        return $countries->toJson();
    })->name('country');


    Route::get('api/states/{country_id}', function (\Illuminate\Http\Request $request, $country_id) {
        $states = \App\Models\State::query()->where('country_id', $country_id)->orderBy('name')->get(['id', 'name']);
        return $states->toJson();
    })->name('states');


    Route::get('api/cities/{state_id}', function (\Illuminate\Http\Request $request, $state_id) {
        $cities = \App\Models\City::query()->where('state_id', $state_id)->orderBy('name')->get(['id', 'name']);
        return $cities->toJson();
    })->name('cities');

    Route::get('api/templates/{template_id}', function (\Illuminate\Http\Request $request, $template_id) {
        $contactTemplate = \App\Models\ContractTemplate::query()->where('id', $template_id)->get(['id', 'template']);
        return $contactTemplate->toJson();
    })->name('contractTemplate');

});

