<?php

namespace App\Models;

use App\Events\DetailCreated;
use App\Events\DetailDeleted;
use App\Events\DetailUpdated;
use App\Events\NoteCreated;
use App\Events\NoteDeleted;
use App\Events\NoteUpdated;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'details';
    protected $fillable = ['type_id','unit_id','creator_id','detail', 'value'];

    protected $primaryKey = 'id';


    CONST DETAIL_TYPE_PROPERTY = 1;

    CONST DETAIL_STATUS_ACTIVE = 1;
    CONST DETAIL_STATUS_PASSIVE = 0;

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => DetailCreated::class,
        'updated' => DetailUpdated::class,
        'deleted' => DetailDeleted::class
    ];

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
    public function unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_id');
    }

}
