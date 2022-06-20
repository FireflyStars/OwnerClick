<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class Event extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';
    protected $fillable = ['type', 'eventable_type', 'eventable_id', 'data'];
    protected $primaryKey = 'id';


    protected function getDataAttribute($value){
        return json_decode($value,true);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }
}
