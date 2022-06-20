<?php

namespace App\Models;

use App\Events\FixtureCreated;
use App\Events\FixtureDeleted;
use App\Events\FixtureUpdated;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fixtures';
    protected $fillable = ['creator_id', 'name', 'unit_id', 'comment', 'count', 'status_id'];

    protected $primaryKey = 'id';

    CONST FIXTURE_STATUS_PASSIVE = 0;
    CONST FIXTURE_STATUS_ACTIVE = 1;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => FixtureCreated::class,
        'updated' => FixtureUpdated::class,
        'deleted' => FixtureDeleted::class
    ];


    function getStats($badge = false)
    {
        switch ($this->status_id) {
            case self::FIXTURE_STATUS_PASSIVE:
                $name = __('dashboard.out_of_use');
                $badgeClass = 'badge-secondary';
                break;
            case self::FIXTURE_STATUS_ACTIVE:
                $name = __('dashboard.in_use');
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

    static function getStatus()
    {
        $types = [
            self::FIXTURE_STATUS_ACTIVE =>[
                'id' => self::FIXTURE_STATUS_ACTIVE,
                'name' => __('dashboard.in_use')],
            self::FIXTURE_STATUS_PASSIVE =>[
                'id' => self::FIXTURE_STATUS_PASSIVE,
                'name' => __('dashboard.out_of_use')],
        ];

        return $types;
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
    public function unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_id');
    }





}
