<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_accounts';
    protected $fillable = ['creator_id', 'type_id', 'owner_name','account_name', 'iban'];

    protected $primaryKey = 'id';

    CONST PAYMENT_ACCOUNT_TYPE_CASH = 1;
    CONST PAYMENT_ACCOUNT_TYPE_BANK = 2;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User','id','creator_id');
    }



}
