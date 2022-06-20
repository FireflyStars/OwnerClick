<?php

namespace App\Models;

use App\Events\ContractTerminated;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class ContractTerminate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contract_terminates';
    protected $fillable = ['contract_id', 'creator_id', 'date', 'type_id', 'reason'];

    protected $primaryKey = 'id';


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => ContractTerminated::class,
    ];


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
    public function creator()
    {
        return $this->hasOne('App\Models\User','id','creator_id');
    }

}
