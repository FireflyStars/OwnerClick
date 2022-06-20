<?php

namespace App\Models;

use App\Events\ContractCreated;
use App\Events\ContractDeleted;
use App\Events\ContractUpdated;
use App\Scopes\OwnerScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Template\Template;

class Contract extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */


    const PAYMENT_PERIOD_YEARLY = 1;
    const PAYMENT_PERIOD_MONTHLY = 12;
    const PAYMENT_PERIOD_3_MONTHLY = 4;
    const PAYMENT_PERIOD_6_MONTHLY = 2;
    const PAYMENT_PERIOD_DAILY = 365;


    const CONTRACT_STATUS_CANCELED = -1;
    const CONTRACT_STATUS_WAITING = 0;
    const CONTRACT_STATUS_ACTIVE = 1;


    protected $table = 'contracts';
    protected $fillable = ['creator_id', 'contract_template_id', 'unit_id', 'rental_price', 'deposit_price', 'rental_currency', 'deposit_currency', 'payment_period', 'payment_method_id', 'payment_account_id', 'guarantor_name', 'guarantor_phone', 'guarantor_identification_number', 'start_date', 'end_date', 'notes', 'terminate_id', 'image', 'file_id', 'status_id'];
    protected $primaryKey = 'id';

    protected $dates = ['start_date', 'end_date'];

    //protected $dateFormat = 'Y-m-d';

    function __construct(array $attributes = [])
    {
        if(isset(Auth::user()->currency)){
            $this->rental_currency = Auth::user()->currency;
            $this->deposit_currency = Auth::user()->currency;
        }
        parent::__construct($attributes);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => ContractCreated::class,
//        'updated' => ContractUpdated::class,
        'deleted' => ContractDeleted::class
    ];


    static function getPaymentPeriods()
    {
        $periods = [
            self::PAYMENT_PERIOD_MONTHLY => ['id' => self::PAYMENT_PERIOD_MONTHLY, 'name' => 'Aylık'],
            self::PAYMENT_PERIOD_YEARLY => ['id' => self::PAYMENT_PERIOD_YEARLY, 'name' => 'Yıllık'],
            self::PAYMENT_PERIOD_3_MONTHLY => ['id' => self::PAYMENT_PERIOD_3_MONTHLY, 'name' => '3 Aylık'],
            self::PAYMENT_PERIOD_6_MONTHLY => ['id' => self::PAYMENT_PERIOD_6_MONTHLY, 'name' => '6 Aylık'],
            self::PAYMENT_PERIOD_DAILY => ['id' => self::PAYMENT_PERIOD_DAILY, 'name' => 'Günlük'],
        ];

        return $periods;

    }


    public function getStatus($badge = false)
    {
        return self::status($badge, $this->status_id);
    }

    public static function status($badge = false, $status)
    {
        switch ($status) {
            case self::CONTRACT_STATUS_CANCELED:
                $name = 'İptal';
                $badgeClass = 'badge-danger';
                break;
            case self::CONTRACT_STATUS_WAITING:
                $name = 'Beklemede';
                $badgeClass = 'badge-warning';
                break;
            case self::CONTRACT_STATUS_ACTIVE:
                $name = 'Geçerli';
                $badgeClass = 'badge-success';
                break;
        }

        if ($badge) {
            $result = "<span class='badge $badgeClass'>$name</span>";
        } else {
            $result = $name;
        }

        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function template()
    {
        return $this->hasOne('App\Models\ContractTemplate', 'id', 'contract_template_id');
    }

    /**
     * @return ContractTemplate
     */
    public function getTemplateAttribute()
    {
        if (is_null($this->sales)) {
            $template = new ContractTemplate();
            $template->name = __('dashboard.undefined');
            return $template;
        }
    }

    public function expiryDay()
    {
        return \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::createFromFormat(auth()->user()->date_format, $this->end_date), false);
    }

    public function isExpired()
    {
        if ($this->expiryDay() <= 0) {
            return true;
        }
        return false;
    }

    public function renewal()
    {


    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\Person', 'user_id', 'creator_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne('App\Models\Unit', 'id', 'unit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dept()
    {
        return $this->hasMany('App\Models\PaymentDept', 'id', 'contract_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function contractPerson()
    {
        return $this->hasMany('App\Models\ContractPersons', 'contract_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paymentAccount()
    {
        return $this->hasOne('App\Models\PaymentAccount', 'id','payment_account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contractFile()
    {
        return $this->hasOne('App\Models\File', 'id', 'file_id');
    }



    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = (Carbon::createFromFormat(\auth()->user()->date_format, $value))->format('Y/m/d');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = (Carbon::createFromFormat(\auth()->user()->date_format, $value))->format('Y/m/d');
    }

    public function getStartDateAttribute($value)
    {
        return (new Carbon($value))->format(auth()->user()->date_format);
    }

    public function getEndDateAttribute($value)
    {
        return (new Carbon($value))->format(auth()->user()->date_format);
    }

    /**
     * @param $contract
     */
    public static function createPaymentDepts($contract, $startedDateCarbon, $endedDateCarbon): void
    {
        switch ($contract->payment_period) {
            case Contract::PAYMENT_PERIOD_DAILY:
                $periodCount = $endedDateCarbon->diffInDays($startedDateCarbon);
                break;
            case Contract::PAYMENT_PERIOD_MONTHLY:
                $periodCount = $endedDateCarbon->diffInMonths($startedDateCarbon);
                break;
            case Contract::PAYMENT_PERIOD_3_MONTHLY:
                $periodCount = $endedDateCarbon->diffInQuarters($startedDateCarbon);
                break;
            case Contract::PAYMENT_PERIOD_6_MONTHLY:
                $periodCount = $endedDateCarbon->diffInYears($startedDateCarbon) * 2;
                break;
            case Contract::PAYMENT_PERIOD_YEARLY:
                $periodCount = $endedDateCarbon->diffInYears($startedDateCarbon);
                break;
        }
        for ($i = 0; $i < $periodCount; $i++) {
            $tempDate = $startedDateCarbon->clone();

            switch ($contract->payment_period) {
                case Contract::PAYMENT_PERIOD_DAILY:
                    $due_date = $tempDate->addDays($i)->format(\auth()->user()->date_format);
                    $dateRange = $due_date . " - " . $tempDate->addDays(1)->format(\auth()->user()->date_format) . " " .  __('dashboard.rent_payment');
                    break;
                case Contract::PAYMENT_PERIOD_MONTHLY:
                    $due_date = $tempDate->addMonthsNoOverflow($i)->format(\auth()->user()->date_format);
                    $dateRange = $due_date . " - " . $tempDate->addMonthsNoOverflow(1)->format(\auth()->user()->date_format) . " " .  __('dashboard.rent_payment');
                    break;
                case Contract::PAYMENT_PERIOD_3_MONTHLY:
                    $due_date = $tempDate->addMonthsNoOverflow($i * 3)->format(\auth()->user()->date_format);
                    $dateRange = $due_date . " - " . $tempDate->addMonthsNoOverflow(3)->format(\auth()->user()->date_format) . " " .  __('dashboard.rent_payment');
                    break;
                case Contract::PAYMENT_PERIOD_6_MONTHLY:
                    $due_date = $tempDate->addMonthsNoOverflow($i * 6)->format(\auth()->user()->date_format);
                    $dateRange = $due_date . " - " . $tempDate->addMonthsNoOverflow(6)->format(\auth()->user()->date_format) . " " .  __('dashboard.rent_payment');
                    break;
                case Contract::PAYMENT_PERIOD_YEARLY:
                    $due_date = $tempDate->addYears($i)->format(\auth()->user()->date_format);
                    $dateRange = $due_date . " - " . $tempDate->addYears()->format(\auth()->user()->date_format) . " " .  __('dashboard.rent_payment');
                    break;
            }

            $rentalPayment = new PaymentDept();
            $rentalPayment->creator_id = Auth::id();
            $rentalPayment->contract_id = $contract->id;
            $rentalPayment->payment_method_id = (int)$contract->payment_method_id;
            $rentalPayment->payment_account_id = $contract->payment_account_id;
            $rentalPayment->payment_type_id = Payment::PAYMENT_TYPE_RENT;
            $rentalPayment->amount = $contract->rental_price;
            $rentalPayment->currency = $contract->rental_currency;
            $rentalPayment->due_date =$due_date;
            $rentalPayment->status_id = PaymentDept::PAYMENT_STATUS_WAITING_PAYMENT;
            $rentalPayment->comment = $dateRange;
            $rentalPayment->save();
        }
    }

    public function finishSave(array $options)
    {

        $dirtyData = $this->getDirty();
        unset($dirtyData['updated_at']);
        parent::finishSave($options); // TODO: Change the autogenerated stub
        if(count($dirtyData)>0){
        $contractChange = new ContractChange($dirtyData);
        $contractChange->contract_id = $this->id;
        $contractChange->creator_id = \auth()->user()->id;
        $contractChange->save();
        }
    }

    public function delete()
    {
        PaymentDept::query()->where('contract_id',$this->id)->delete();
        Payment::query()->where('contract_id',$this->id)->delete();
        Outgoing::query()->where('contract_id',$this->id)->delete();
        ContractChange::query()->where('contract_id',$this->id)->delete();
        ContractTerminate::query()->where('contract_id',$this->id)->delete();
        File::query()->where('contract_id',$this->id)->delete();
        return parent::delete();
    }


}
