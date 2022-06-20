<?php

namespace App\Models;

use App\Events\PropertyCreated;
use App\Events\PropertyDeleted;
use App\Events\PropertyUpdated;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';
    protected $fillable = [
        'name', 'creator_id', 'type_id', 'country_id', 'city_id', 'state_id', 'region', 'zip_code', 'building_no',  'address', 'rental_price'
    ];


    protected $primaryKey = 'id';

    const PROPERTY_TYPE_COMMERCIAL = 1;
    const PROPERTY_TYPE_INDUSTRIAL = 2;
    const PROPERTY_TYPE_LAND = 3;
    const PROPERTY_TYPE_BUILDING = 4;
    const PROPERTY_TYPE_PROJECT_SITE = 5;
    const PROPERTY_TYPE_SINGLE = 6;
    const PROPERTY_TYPE_PARKING_SPACE = 7;
    const PROPERTY_TYPE_MARINA = 8;
    const PROPERTY_TYPE_OTHER = 9;

//    const PROPERTY_TYPE_BUILDING = 5;
//    const PROPERTY_TYPE_COMMERCIAL = 5;
//    const PROPERTY_TYPE_INDUSTRIAL = 5;
//    const PROPERTY_TYPE_LAND = 5;

    const PROPERTY_TYPE_COMMERCIAL_ICON_CLASS = 'briefcase';
    const PROPERTY_TYPE_INDUSTRIAL_ICON_CLASS = 'industry';
    const PROPERTY_TYPE_LAND_ICON_CLASS = 'expand';
    const PROPERTY_TYPE_BUILDING_ICON_CLASS = 'building';
    const PROPERTY_TYPE_PROJECT_SITE_ICON_CLASS = 'city';
    const PROPERTY_TYPE_SINGLE_ICON_CLASS = 'house-user';
    const PROPERTY_TYPE_PARKING_SPACE_ICON_CLASS = 'parking';
    const PROPERTY_TYPE_MARINA_ICON_CLASS = 'ship';
    const PROPERTY_TYPE_OTHER_ICON_CLASS = 'map-marker-alt';

    const PROPERTY_STATUS_LOAD = 0;
    const PROPERTY_STATUS_FOR_RENT = 1;


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => PropertyCreated::class,
        'updated' => PropertyUpdated::class,
        'deleted' => PropertyDeleted::class
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Unit::class, 'property_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->belongsTo(ItemOrder::class, 'id','item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User','id','creator_id');
    }


    function getTypeIcon()
    {
        return self::getIconClass($this->type_id);
    }

    function getTypeName()
    {
        return self::getTypes()[$this->type_id]['name'];
    }



    static function getTypes()
    {
        $types = [
            self::PROPERTY_TYPE_COMMERCIAL => ['id' => self::PROPERTY_TYPE_COMMERCIAL, 'name' => __('dashboard.property_type_commercial')],
            self::PROPERTY_TYPE_INDUSTRIAL => ['id' => self::PROPERTY_TYPE_INDUSTRIAL, 'name' => __('dashboard.property_type_industrial')],
            self::PROPERTY_TYPE_LAND => ['id' => self::PROPERTY_TYPE_LAND, 'name' =>__('dashboard.property_type_land')],
            self::PROPERTY_TYPE_BUILDING => ['id' => self::PROPERTY_TYPE_BUILDING, 'name' => __('dashboard.property_type_building')],
            self::PROPERTY_TYPE_PROJECT_SITE => ['id' => self::PROPERTY_TYPE_PROJECT_SITE, 'name' => __('dashboard.property_type_project_site')],
            self::PROPERTY_TYPE_SINGLE => ['id' => self::PROPERTY_TYPE_SINGLE, 'name' => __('dashboard.property_type_single_house')],
            self::PROPERTY_TYPE_PARKING_SPACE => ['id' => self::PROPERTY_TYPE_PARKING_SPACE, 'name' => __('dashboard.property_type_parking_space')],
            self::PROPERTY_TYPE_MARINA => ['id' => self::PROPERTY_TYPE_MARINA, 'name' => __('dashboard.property_type_marina')],
            self::PROPERTY_TYPE_OTHER => ['id' => self::PROPERTY_TYPE_OTHER, 'name' => __('dashboard.property_type_other')],
        ];

        return $types;

    }

    static function getIconClass($typeId)
    {
        $types = [
            self::PROPERTY_TYPE_COMMERCIAL => self::PROPERTY_TYPE_COMMERCIAL_ICON_CLASS,
            self::PROPERTY_TYPE_INDUSTRIAL => self::PROPERTY_TYPE_INDUSTRIAL_ICON_CLASS,
            self::PROPERTY_TYPE_LAND => self::PROPERTY_TYPE_LAND_ICON_CLASS,
            self::PROPERTY_TYPE_BUILDING => self::PROPERTY_TYPE_BUILDING_ICON_CLASS,
            self::PROPERTY_TYPE_PROJECT_SITE => self::PROPERTY_TYPE_PROJECT_SITE_ICON_CLASS,
            self::PROPERTY_TYPE_SINGLE => self::PROPERTY_TYPE_SINGLE_ICON_CLASS,
            self::PROPERTY_TYPE_PARKING_SPACE => self::PROPERTY_TYPE_PARKING_SPACE_ICON_CLASS,
            self::PROPERTY_TYPE_MARINA => self::PROPERTY_TYPE_MARINA_ICON_CLASS,
            self::PROPERTY_TYPE_OTHER => self::PROPERTY_TYPE_OTHER_ICON_CLASS,
        ];
        if(isset($types[$typeId])){
            return $types[$typeId];
        }
        return $types[self::PROPERTY_TYPE_OTHER];
        return $types;
    }

    static function getStatus($badge = false, $status)
    {
        switch ($status) {
            case self::PROPERTY_STATUS_FOR_RENT:
                $name = __('dashboard.rent');
                $badgeClass = 'badge-warning';
                break;
            case self::PROPERTY_STATUS_LOAD:
                $name = __('dashboard.rented');
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


}
