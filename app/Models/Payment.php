<?php

namespace App\Models;

use App\Console\Commands\RepairStatusPayments;
use App\Events\PaymentCreated;
use App\Events\PaymentDeleted;
use App\Events\PaymentUpdated;
use App\Scopes\OwnerScope;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\LaravelLocalization;

class Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';
    protected $fillable = ['creator_id', 'contract_id', 'payment_method_id', 'payment_account_id', 'payment_type_id', 'amount', 'currency', 'payment_date', 'due_date', 'comment', 'status_id', 'ref_payment_id', 'active'];

    protected $primaryKey = 'id';
    protected $dates = ['payment_date', 'due_date'];

    /*    protected $dates = ['payment_date'];
        protected $dateFormat = 'Y/m/d';*/

    // Nakit, Banka, Kredi Kartı, Çek, Senet.
    const PAYMENT_METHOD_CASH = 1;
    const PAYMENT_METHOD_BANK_TRANSFER = 2;
    const PAYMENT_METHOD_CREDIT_CART = 3;
    const PAYMENT_METHOD_CHECK = 4;
    const PAYMENT_METHOD_PROMOSSORY_NOTES = 5;


    const PAYMENT_TYPE_RENT = 1;
    const PAYMENT_TYPE_DEPOSIT = 2;
    const PAYMENT_TYPE_OTHER = 3;

//    const PAYMENT_ACTIVE_TRUE = 1;
//    const PAYMENT_ACTIVE_FALSE = 0;

    protected static function booted()
    {
            static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => PaymentCreated::class,
        'updated' => PaymentUpdated::class,
        'deleted' => PaymentDeleted::class
    ];

    function __construct(array $attributes = [])
    {
        if(isset(Auth::user()->currency)){
            $this->currency = Auth::user()->currency;
        }
        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'creator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contract()
    {
        return $this->hasOne('App\Models\Contract', 'id', 'contract_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne('App\Models\PaymentAccount', 'id', 'payment_account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dept()
    {
        return $this->hasOne('App\Models\PaymentDept', 'id', 'ref_payment_id');
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = (Carbon::createFromFormat(\auth()->user()->date_format, $value))->format('Y/m/d');
    }

    public function getPaymentDateAttribute($value)
    {
        return (new Carbon($value))->format(auth()->user()->date_format);
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = (Carbon::createFromFormat(\auth()->user()->date_format, $value))->format('Y/m/d');
    }

    public function getDueDateAttribute($value)
    {
        return (new Carbon($value))->format(auth()->user()->date_format);
    }

    static function getPaymentTypes()
    {
        $types = [
            self::PAYMENT_TYPE_RENT => [
                'id' => self::PAYMENT_TYPE_RENT,
                'name' => __('dashboard.rent_fee')],
            self::PAYMENT_TYPE_DEPOSIT => [
                'id' => self::PAYMENT_TYPE_DEPOSIT,
                'name' => __('dashboard.deposit_fee')],
            self::PAYMENT_TYPE_OTHER => [
                'id' => self::PAYMENT_TYPE_OTHER,
                'name' => __('dashboard.other')],
        ];
        return $types;
    }

    static function getPaymentMethod()
    {
        $types = [
            self::PAYMENT_METHOD_CASH => [
                'id' => self::PAYMENT_METHOD_CASH,
                'name' => __('dashboard.cash')],
            self::PAYMENT_METHOD_BANK_TRANSFER => [
                'id' => self::PAYMENT_METHOD_BANK_TRANSFER,
                'name' => __('dashboard.bank_transfer')],
            self::PAYMENT_METHOD_CREDIT_CART => [
                'id' => self::PAYMENT_METHOD_CREDIT_CART,
                'name' => __('dashboard.credit_card')],
            self::PAYMENT_METHOD_CHECK => [
                'id' => self::PAYMENT_METHOD_CHECK,
                'name' => __('dashboard.check')],
            self::PAYMENT_METHOD_PROMOSSORY_NOTES => [
                'id' => self::PAYMENT_METHOD_PROMOSSORY_NOTES,
                'name' => __('dashboard.bill')],

        ];
        return $types;
    }


    /**
     * @param $unitId
     * @return array
     */
    static function payments($unitId, $deptPayments = true): array
    {
        //todo Buralarda temizlik yapılması gerekmektedir.
        $data = [];
        if ($unitId != null) {
            $paymentsBuilder = PaymentDept::query()->join('contracts', 'contracts.id', '=', 'payment_depts.contract_id')->where('unit_id', $unitId)->where('payment_depts.active', '=', PaymentDept::PAYMENT_ACTIVE_TRUE);;
            $unit = Unit::find($unitId);
            $data['contract'] = $contract = $unit->contract;
            if (isset($contract)) {
                $data['tenant'] = $contract->contractPerson->first()->person;
            } else {
                $details = Detail::query()->where('type_id', Detail::DETAIL_TYPE_PROPERTY)->where('unit_id', $unitId)->get()->all();
                $data['details'] = $details;
            }

            $data['unit'] = $unit;

            $contracts = Contract::query()
                ->where('unit_id', $unitId)
                ->get()
                ->all();

            $payments = $paymentsBuilder
//                ->whereDate('payments.due_date', '<', Carbon::now())
                ->whereIn('payment_depts.contract_id', array_column($contracts, 'id'));

            $data['payments'] = $payments
                ->orderBy('payment_depts.updated_at', 'desc')
                ->get(['payment_depts.id', 'payment_depts.amount', 'payment_depts.payment_type_id', 'payment_depts.currency', 'payment_depts.comment', 'due_date'])
                ->all();

            $paymentsa = PaymentDept::activePayments()->whereIn('payment_depts.contract_id', array_column($contracts, 'id'))->whereDate('due_date', '<', Carbon::now())->whereIn('status_id',[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]);
            $totalAmount = $paymentsa->sum('amount');
            $totalPayment = $paymentsa->sum('amount_dept');
            $data['amountOfDept'] = $totalAmount - $totalPayment;

        }






//        $data['totalPayment'] = $totalAmount;
//        $data['totalAmount'] = $totalPayment;
        $data['unit_id'] = $unitId;
        return $data;
    }



        static function confirmStatus($paymentId = null): void
        {
            if($paymentId === null){
                $payments = PaymentDept::all();
            }
            foreach ($payments as $payment) {
                if($paymentId === null){
                Auth::login(User::find($payment->creator_id));
                }
                $amount = Payment::query()->where('ref_payment_id', $payment->id)->sum('amount');
                $newStatusId = PaymentDept::detectStatusId($payment->amount, $amount, $payment->due_date, false, true);
                $payment->status_id = $newStatusId;
                $payment->amount_dept = $amount;
                $payment->save();
            }
            Auth::logout();
        }
}
