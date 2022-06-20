<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class ContractPersons extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'persons_contracts';
    protected $fillable = [
        'person_id', 'contract_id', 'creator_id', 'type_id','share','status_id'
    ];

    protected $primaryKey = 'id';

    CONST CONTRACT_PERSONS_TYPE_OWNER = 1;
    CONST CONTRACT_PERSONS_TYPE_TENANT = 2;
    CONST CONTRACT_PERSONS_TYPE_GUARANTOR = 3;

    CONST CONTRACT_PERSONS_STATUS_PASSIVE = 0;
    CONST CONTRACT_PERSONS_STATUS_ACTIVE = 1;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function person()
    {
        return $this->hasOne('App\Models\Person','id','person_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contracts()
    {
        return $this->hasMany('App\Models\Contract','id','contract_id');
    }

    public static function getTypes(){
        $types = [
            self::CONTRACT_PERSONS_TYPE_OWNER =>[
                'id' => self::CONTRACT_PERSONS_TYPE_OWNER,
                'name' => __('dashboard.owner')],
            self::CONTRACT_PERSONS_TYPE_TENANT =>[
                'id' => self::CONTRACT_PERSONS_TYPE_TENANT,
                'name' => __('dashboard.tenant')],
            self::CONTRACT_PERSONS_TYPE_GUARANTOR =>[
                'id' => self::CONTRACT_PERSONS_TYPE_GUARANTOR,
                'name' => __('dashboard.guarantor')],
        ];
        return $types;
    }

    function getType($badge = false)
    {

        $name =  ContractPersons::getTypes()[$this->type_id]['name'];
        if ($badge) {
            $result = "<span class='badge badge-info'>$name</span>";
        } else {
            $result = $name;
        }
        return $result;

    }





}
