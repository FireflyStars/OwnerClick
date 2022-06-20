<?php

namespace App\Models;

use App\Events\OutgoingCreated;
use App\Events\OutgoingDeleted;
use App\Events\OutgoingUpdated;
use App\Scopes\OwnerScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Outgoing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'outgoings';
    protected $fillable = ['creator_id','unit_id','contract_id','payment_type_id','amount', 'currency','outgoing_date','name','comment'];

    protected $primaryKey = 'id';
/*    protected $dates = ['payment_date'];
    protected $dateFormat = 'Y/m/d';*/

    CONST OUTGOING_TYPE_TAX = 1;
    CONST OUTGOING_TYPE_REPAIR = 2;
    CONST OUTGOING_TYPE_OTHER = 3;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => OutgoingCreated::class,
        'updated' => OutgoingUpdated::class,
        'deleted' => OutgoingDeleted::class
    ];


    function __construct(array $attributes = [])
    {
        $this->currency = Auth::user()->currency;
        parent::__construct($attributes);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User','id','creator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contract()
    {
        return $this->hasOne('App\Models\Contract','id','contract_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_id');
    }

    public function setOutgoingDateAttribute( $value ) {
        $this->attributes['outgoing_date'] = (Carbon::createFromFormat('d/m/Y',$value))->format('Y/m/d');
    }

    public function getOutgoingDateAttribute( $value ) {
        return  (new Carbon($value))->format('d/m/Y');
    }

    static function getPropertyTypes()
    {
        $types = [
            self::OUTGOING_TYPE_TAX =>[
                'id' => self::OUTGOING_TYPE_TAX,
                'name' => __('dashboard.tax')],
            self::OUTGOING_TYPE_REPAIR =>[
                'id' => self::OUTGOING_TYPE_REPAIR,
                'name' => __('dashboard.renovation')],
            self::OUTGOING_TYPE_OTHER =>[
                'id' => self::OUTGOING_TYPE_OTHER,
                'name' => __('dashboard.other')],
        ];
        return $types;
    }


}
