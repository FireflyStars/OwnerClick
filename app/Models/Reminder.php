<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;
use Thomasjohnkane\Snooze\Models\ScheduledNotification;

class Reminder extends Model
{
    protected $table = 'reminders';
    protected $fillable = ['type_id', 'contract_id', 'creator_id', 'fixture_id', 'note_id', 'outgoing_id', 'payment_id', 'unit_id','title','note','send_at'];

    protected $primaryKey = 'id';

    CONST REMINDER_TYPE_DEFAULT = 0;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_id');
    }
}
