<?php

namespace App\Models;

use App\Events\UnitPersonCreated;
use App\Events\UnitPersonDeleted;
use App\Events\UnitPersonUpdated;
use App\Scopes\OwnerScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UnitPerson extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persons_properties';
    protected $fillable = [
        'creator_id', 'type_id', 'unit_id', 'share','status_id'
    ];






    protected $primaryKey = 'id';

    CONST UNIT_PERSONS_TYPE_OWNER = 1;
    CONST UNIT_PERSONS_TYPE_TENANT = 2;

    CONST UNIT_PERSONS_STATUS_PASSIVE = 0;
    CONST UNIT_PERSONS_STATUS_ACTIVE = 1;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => UnitPersonCreated::class,
        'updated' => UnitPersonUpdated::class,
        'deleted' => UnitPersonDeleted::class
    ];


    static function getUnitPersonTypes()
    {
        $types = [
            self::UNIT_PERSONS_TYPE_OWNER =>[
                'id' => self::UNIT_PERSONS_TYPE_OWNER,
                'name' => __('dashboard.owner')],
            self::UNIT_PERSONS_TYPE_TENANT =>[
                'id' => self::UNIT_PERSONS_TYPE_TENANT,
                'name' => __('dashboard.tenant')],
        ];
        return $types;
    }


    public function setShareAttribute($value)
    {
        $numbers = explode("/", $value);
        if(is_string($value) AND isset( $numbers[1])) {
            $value = round($numbers[0] / $numbers[1], 6);
            $this->attributes['share'] = $value;
        }else{
            $this->attributes['share'] = $value;
        }
    }


    function getStatus($badge = false)
    {
        switch ($this->status_id) {
            case self::UNIT_PERSONS_STATUS_PASSIVE:
                $name = __('dashboard.old');
                $badgeClass = 'badge-secondary';
                break;
            case self::UNIT_PERSONS_STATUS_ACTIVE:
                $name = __('dashboard.active');
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






    //   /**
 //    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 //    */
 //   public function city(){
 //       return $this->belongsTo('App\Models\City');
 //   }
//
 //   /**
 //    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 //    */
 //   public function country(){
 //       return $this->belongsTo('App\Models\Country');
 //   }
//
 //   /**
 //    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 //    */
 //   public function state(){
 //       return $this->belongsTo('App\Models\State');
 //   }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function person()
    {
        return $this->hasOne('App\Models\Person','id','person_id');
    }

}
