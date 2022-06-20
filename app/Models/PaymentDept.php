<?php

namespace App\Models;

use App\Console\Commands\RepairStatusPayments;
use App\Events\NoteCreated;
use App\Events\NoteDeleted;
use App\Events\NoteUpdated;
use App\Events\PaymentCreated;
use App\Events\PaymentDeptCreated;
use App\Events\PaymentDeptDeleted;
use App\Events\PaymentDeptUpdated;
use App\Scopes\OwnerScope;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\LaravelLocalization;

class PaymentDept extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_depts';
    protected $fillable = ['creator_id', 'contract_id', 'payment_method_id', 'payment_account_id', 'payment_type_id', 'amount', 'currency', 'payment_date', 'due_date', 'comment', 'status_id', 'ref_payment_id', 'active'];

    protected $primaryKey = 'id';
    protected $dates = ['payment_date', 'due_date'];

    const PAYMENT_STATUS_DELAYED_PAYMENT = 2;
    const PAYMENT_STATUS_OVER_PAYMENT = 3;
    const PAYMENT_STATUS_PARTIAL_PAYMENT = 4;
    const PAYMENT_STATUS_PENDING_PAYMENT = 5;
    const PAYMENT_STATUS_FULL_PAYMENT = 6;
    const PAYMENT_STATUS_WAITING_PAYMENT = 0;
    const PAYMENT_STATUS_PAID = 1;
    const PAYMENT_STATUS_CANCELED = -1;

    const PAYMENT_ACTIVE_TRUE = 1;
    const PAYMENT_ACTIVE_FALSE = 0;

    /*    protected $dates = ['payment_date'];
        protected $dateFormat = 'Y/m/d';*/

    protected $dispatchesEvents = [
        'created' => PaymentDeptCreated::class,
        'updated' => PaymentDeptUpdated::class,
        'deleted' => PaymentDeptDeleted::class
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    function __construct(array $attributes = [])
    {
        if (isset(Auth::user()->currency)) {
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

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = (Carbon::createFromFormat(\auth()->user()->date_format, $value))->format('Y/m/d');
    }

    public function getDueDateAttribute($value)
    {
        return (new Carbon($value))->format(auth()->user()->date_format);
    }

    function getStatus($badge = false)
    {
        if ($this->active == self::PAYMENT_ACTIVE_FALSE) {
            $name = 'Pasif';
            $badgeClass = 'badge-secondary';
        } else {
            $name = self::getSituations()[$this->status_id]['name'];
            $badgeClass = self::getSituations()[$this->status_id]['badgeClass'];
        }

        if ($badge) {
            $result = "<span class='badge $badgeClass'>$name</span>";
        } else {
            $result = $name;
        }

        return $result;
    }


    function getAmaountWithStatusColor($totalBalance, $deptAmount, $dueDate, $currency = null)
    {
        if ($this->status_id === self::PAYMENT_STATUS_FULL_PAYMENT) {
            // $name = 'Ödeme Tamamlandı';
            $textClass = 'badge badge-success';
        } elseif ($this->status_id === self::PAYMENT_STATUS_DELAYED_PAYMENT) {
            //  $name = 'Geciken Ödeme';
            $textClass = 'badge badge-danger';
        } elseif ($this->status_id === self::PAYMENT_STATUS_WAITING_PAYMENT) {
            //$name = 'Ödeme Bekleniyor';
            $textClass = 'badge badge-warning';
        } elseif ($this->status_id === self::PAYMENT_STATUS_PARTIAL_PAYMENT) {
            //$name = 'Kısmi Ödendi';
            $textClass = 'badge badge-danger';
        } elseif ($this->status_id === self::PAYMENT_STATUS_OVER_PAYMENT) {
            //$name = 'Fazla Ödeme';
            $textClass = 'badge badge-danger';
        }
        $numberFormatter = \NumberFormatter::create(str_replace('_', '-', auth()->user()->language), \NumberFormatter::CURRENCY);
//        $result = "<div class='totalPrice $textClass'><span class='price $textClass'>" . $numberFormatter->formatCurrency($this->amount_dept, $currency) . "</span><span class='price $textClass'>/</span><span
//                            class='price $textClass'>" .  $numberFormatter->format($totalBalance,\NumberFormatter::CURRENCY) . "</span></div>";
//        $result = "<div class='totalPrice $textClass'><span
//                            class='price $textClass'>" .  $numberFormatter->format($totalBalance,\NumberFormatter::CURRENCY) . "</span></div>";
        $result = "<div class='totalPrice '><span
                            class=' $textClass'>" .  $numberFormatter->formatCurrency($totalBalance,$currency) . "</span></div>";
        return $result;
    }

    static function detectStatusId($totalBalance, $deptAmount, $dueDate, $badge = false, $onlyStatusId = false)
    {
        $isAfter = Carbon::now(Auth::user()->timezone)->isAfter(Carbon::createFromFormat(\auth()->user()->date_format, $dueDate));
//        $isAfter = Carbon::now(Auth::user()->timezone)->isAfter(Carbon::createFromFormat(\auth()->user()->date_format, $dueDate));

        if ($totalBalance == $deptAmount) {
            $name = __('dashboard.payment_complete');
            $badgeClass = 'badge-success';
            $id = self::PAYMENT_STATUS_FULL_PAYMENT;
        } elseif (!$isAfter and $deptAmount == 0) {
            $name = __('dashboard.payment_awaiting');
            $badgeClass = 'badge-warning';
            $id = self::PAYMENT_STATUS_WAITING_PAYMENT;
        } elseif ($totalBalance > $deptAmount and $deptAmount != 0) {
            $name = __('dashboard.partially_payment');
            $badgeClass = 'badge-danger';
            $id = self::PAYMENT_STATUS_PARTIAL_PAYMENT;
        } elseif ($totalBalance < $deptAmount) {
            $name = __('dashboard.overpayment');
            $badgeClass = 'badge-danger';
            $id = self::PAYMENT_STATUS_OVER_PAYMENT;
        } elseif ($isAfter) {
            $name =  __('dashboard.delay_payment');
            $badgeClass = 'badge-danger';
            $id = self::PAYMENT_STATUS_DELAYED_PAYMENT;
        }
        if ($onlyStatusId) {
            return $id;
        }

        if ($badge) {
            $result = "<span class='badge $badgeClass'>$name</span>";
        } else {
            $result = $name;
        }
        return $result;
    }

    public function confirmPaymentStatus()
    {
        $amount = Payment::query()->where('ref_payment_id', $this->id)->sum('amount');
        $newStatusId = PaymentDept::detectStatusId($this->amount, $amount, $this->due_date, false, true);
        if ($this->amount_dept != $amount or $this->status_id != $newStatusId) {
            $this->status_id = $newStatusId;
            $this->amount_dept = $amount;
            return $this->save();
        }
    }

    public function delete()
    {
        parent::delete();
        Payment::query()->where('ref_payment_id', $this->id)->delete();
        return ;
    }

    static function activePayments()
    {
        $builder = PaymentDept::query()->where('active', '=', PaymentDept::PAYMENT_ACTIVE_TRUE);
        return $builder;
    }

    /**
     * @return string[]
     */
    public static function getSituations(): array
    {
        return [
            self::PAYMENT_STATUS_FULL_PAYMENT => [
                'name' => __('dashboard.payment_complete'),
                'badgeClass' => 'badge-success'
                ],
            self::PAYMENT_STATUS_PENDING_PAYMENT => [
                'name' => __('dashboard.payment_awaiting'),
                'badgeClass' => 'badge-warning'
                ],
            self::PAYMENT_STATUS_PARTIAL_PAYMENT => [
                'name' => __('dashboard.partially_paid'),
                'badgeClass' => 'badge-danger'
                ],
            self::PAYMENT_STATUS_OVER_PAYMENT => [
                'name' => __('dashboard.overpayment'),
                'badgeClass' => 'badge-danger'
                ],
            self::PAYMENT_STATUS_DELAYED_PAYMENT => [
                'name' => __('dashboard.delay_payment'),
                'badgeClass' => 'badge-danger'
                ],
            self::PAYMENT_STATUS_CANCELED => [
                'name' => __('dashboard.cancel'),
                'badgeClass' => 'badge-secondary'
                ],
            self::PAYMENT_STATUS_WAITING_PAYMENT => [
                'name' => __('dashboard.payment_awaiting'),
                'badgeClass' => 'badge-warning'
                ],
            self::PAYMENT_STATUS_PAID => [
                'name' => __('dashboard.paid'),
                'badgeClass' => 'badge-success'
                ],
        ];
    }

}
