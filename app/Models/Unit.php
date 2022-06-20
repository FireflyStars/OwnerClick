<?php

namespace App\Models;

use App\Events\UnitCreated;
use App\Events\UnitDeleted;
use App\Events\UnitUpdated;
use App\Exceptions\UnitOwnersException;
use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';
    protected $fillable = [
        'name', 'creator_id', 'type_id', 'property_id'
    ];

    protected $primaryKey = 'id';

    const UNIT_TYPE_COMMERCIAL = 1;
    const UNIT_TYPE_INDUSTRIAL = 2;
    const UNIT_TYPE_LAND = 3;
    const UNIT_TYPE_BUILDING = 4;
    const UNIT_TYPE_PROJECT_SITE = 5;
    const UNIT_TYPE_SINGLE = 6;
    const UNIT_TYPE_PARKING_SPACE = 7;
    const UNIT_TYPE_MARINA = 8;
    const UNIT_TYPE_OTHER = 9;
    const UNIT_TYPE_GAS_STATION = 10;
    const UNIT_TYPE_APARTMENT = 11;
    const UNIT_TYPE_WORKSHOP = 12;
    const UNIT_TYPE_MALL = 13;
    const UNIT_TYPE_BUFFET = 14;
    const UNIT_TYPE_OFFICE = 15;
    const UNIT_TYPE_CAFE= 16;
    const UNIT_TYPE_FARM = 17;
    const UNIT_TYPE_WAREHOUSE = 18;
    const UNIT_TYPE_WEDDING_HALL = 19;
    const UNIT_TYPE_SHOP_STORE = 20;
    const UNIT_TYPE_POWER_PLANTS = 21;
    const UNIT_TYPE_FACTORY = 22;
    const UNIT_TYPE_GARAGE_PARKING = 23;
    const UNIT_TYPE_BUSINESS_HALL_OFFICE_FLOOR = 25;
    const UNIT_TYPE_CANTEEN = 26;
    const UNIT_TYPE_COMPLETE_BUILDING = 29;
    const UNIT_TYPE_MINE_QUARRY = 30;
    const UNIT_TYPE_CAR_PARK = 31;
    const UNIT_TYPE_MARKET_PLACE = 32;
    const UNIT_TYPE_PLAZA = 33;
    const UNIT_TYPE_PLAZA_FLOOR = 34;
    const UNIT_TYPE_PREFABRICATED_BUILDING = 35;
    const UNIT_TYPE_RADIO_STATION = 36;
    const UNIT_TYPE_RESIDENCE_OFFICE_FLOOR = 37;
    const UNIT_TYPE_RESTAURANT = 38;
    const UNIT_TYPE_MEDICAL_CENTER = 39;
    const UNIT_TYPE_SPA_BATH_SAUNA = 40;
    const UNIT_TYPE_SPORTS_FACILITY = 41;
    const UNIT_TYPE_DORMUTORY = 42;


    const UNIT_TYPE_COMMERCIAL_ICON_CLASS = 'briefcase';
    const UNIT_TYPE_INDUSTRIAL_ICON_CLASS = 'industry';
    const UNIT_TYPE_LAND_ICON_CLASS = 'expand';
    const UNIT_TYPE_BUILDING_ICON_CLASS = 'building';
    const UNIT_TYPE_PROJECT_SITE_ICON_CLASS = 'city';
    const UNIT_TYPE_SINGLE_ICON_CLASS = 'house-user';
    const UNIT_TYPE_PARKING_SPACE_ICON_CLASS = 'parking';
    const UNIT_TYPE_MARINA_ICON_CLASS = 'ship';
    const UNIT_TYPE_OTHER_ICON_CLASS = 'map-marker-alt';
    const UNIT_TYPE_GAS_STATION_ICON_CLASS = 'charging-station';
    const UNIT_TYPE_APARTMENT_ICON_CLASS = 'door-closed';
    const UNIT_TYPE_WORKSHOP_ICON_CLASS = 'shapes';
    const UNIT_TYPE_MALL_ICON_CLASS = 'tags';
    const UNIT_TYPE_BUFFET_ICON_CLASS = 'store';
    const UNIT_TYPE_OFFICE_ICON_CLASS = 'briefcase';
    const UNIT_TYPE_CAFE_ICON_CLASS = 'coffee';
    const UNIT_TYPE_FARM_ICON_CLASS = 'tractor';
    const UNIT_TYPE_WAREHOUSE_ICON_CLASS = 'warehouse';
    const UNIT_TYPE_WEDDING_HALL_ICON_CLASS = 'birthday-cake';
    const UNIT_TYPE_SHOP_STORE_ICON_CLASS = 'store';
    const UNIT_TYPE_POWER_PLANTS_ICON_CLASS = 'car-battery';
    const UNIT_TYPE_FACTORY_ICON_CLASS = 'industry';
    const UNIT_TYPE_GARAGE_PARKING_ICON_CLASS = 'parking';
    const UNIT_TYPE_BUSINESS_HALL_OFFICE_FLOOR_ICON_CLASS = 'stream';
    const UNIT_TYPE_CANTEEN_ICON_CLASS = 'coffee';
    const UNIT_TYPE_COMPLETE_BUILDING_ICON_CLASS = 'building';
    const UNIT_TYPE_MINE_QUARRY_ICON_CLASS = 'ruler-combined';
    const UNIT_TYPE_CAR_PARK_ICON_CLASS = 'car-alt';
    const UNIT_TYPE_MARKET_PLACE_ICON_CLASS = 'cash-register';
    const UNIT_TYPE_PLAZA_ICON_CLASS = 'city';
    const UNIT_TYPE_PLAZA_FLOOR_ICON_CLASS = 'stream';
    const UNIT_TYPE_PREFABRICATED_BUILDING_ICON_CLASS = 'artstation';
    const UNIT_TYPE_RADIO_STATION_ICON_CLASS = 'broadcast-tower';
    const UNIT_TYPE_RESIDENCE_OFFICE_FLOOR_ICON_CLASS = 'stream';
    const UNIT_TYPE_RESTAURANT_ICON_CLASS = 'utensils';
    const UNIT_TYPE_MEDICAL_CENTER_ICON_CLASS = 'stethoscope';
    const UNIT_TYPE_SPA_BATH_SAUNA_ICON_CLASS = 'bath';
    const UNIT_TYPE_SPORTS_FACILITY_ICON_CLASS = 'running';
    const UNIT_TYPE_DORMUTORY_ICON_CLASS = 'bed';

    const UNIT_STATUS_LOAD = '';
    const UNIT_STATUS_FOR_RENT = '';


    protected static function booted()
    {
        static::addGlobalScope(new OwnerScope);
    }

    protected $dispatchesEvents = [
        'created' => UnitCreated::class,
        'updated' => UnitUpdated::class,
        'deleted' => UnitDeleted::class
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'creator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne('App\Models\Property', 'id', 'property_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persons()
    {
        return $this->hasMany(UnitPerson::class, 'unit_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fixture()
    {
        return $this->belongsTo('App\Models\Fixture');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contracts()
    {
        return $this->belongsTo('App\Models\Contract', 'id', 'unit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo('App\Models\Contract', 'id', 'unit_id')->where('status_id', Contract::CONTRACT_STATUS_ACTIVE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo(ItemOrder::class, 'id', 'item_id');
    }

    function getTypeIcon()
    {
            return self::getIconClass($this->type_id);
    }


    static function getTypes()
    {
        $types = [
            self::UNIT_TYPE_COMMERCIAL => ['id' => self::UNIT_TYPE_COMMERCIAL, 'name' => __('dashboard.unit_type_commercial')],
            self::UNIT_TYPE_INDUSTRIAL => ['id' => self::UNIT_TYPE_INDUSTRIAL, 'name' => __('dashboard.unit_type_industrial')],
            self::UNIT_TYPE_LAND => ['id' => self::UNIT_TYPE_LAND, 'name' => __('dashboard.unit_type_land')],
            self::UNIT_TYPE_BUILDING => ['id' => self::UNIT_TYPE_BUILDING, 'name' => __('dashboard.unit_type_building')],
            self::UNIT_TYPE_PROJECT_SITE => ['id' => self::UNIT_TYPE_PROJECT_SITE, 'name' => __('dashboard.unit_type_project_site')],
            self::UNIT_TYPE_SINGLE => ['id' => self::UNIT_TYPE_SINGLE, 'name' => __('dashboard.unit_type_single')],
            self::UNIT_TYPE_PARKING_SPACE => ['id' => self::UNIT_TYPE_PARKING_SPACE, 'name' => __('dashboard.unit_type_parking_space')],
            self::UNIT_TYPE_MARINA => ['id' => self::UNIT_TYPE_MARINA, 'name' => __('dashboard.unit_type_marina')],
            self::UNIT_TYPE_OTHER => ['id' => self::UNIT_TYPE_OTHER, 'name' => __('dashboard.unit_type_other')],
            self::UNIT_TYPE_GAS_STATION => ['id' => self::UNIT_TYPE_GAS_STATION, 'name' => __('dashboard.unit_type_gas_station')],
            self::UNIT_TYPE_APARTMENT => ['id' => self::UNIT_TYPE_APARTMENT, 'name' => __('dashboard.unit_type_apartment')],
            self::UNIT_TYPE_WORKSHOP => ['id' => self::UNIT_TYPE_WORKSHOP, 'name' => __('dashboard.unit_type_workshop')],
            self::UNIT_TYPE_MALL => ['id' => self::UNIT_TYPE_MALL, 'name' => __('dashboard.unit_type_mall')],
            self::UNIT_TYPE_BUFFET => ['id' => self::UNIT_TYPE_BUFFET, 'name' => __('dashboard.unit_type_buffet')],
            self::UNIT_TYPE_OFFICE => ['id' => self::UNIT_TYPE_OFFICE, 'name' => __('dashboard.unit_type_office')],
            self::UNIT_TYPE_CAFE=> ['id' => self::UNIT_TYPE_CAFE, 'name' => __('dashboard.unit_type_cafe')],
            self::UNIT_TYPE_FARM => ['id' => self::UNIT_TYPE_FARM, 'name' => __('dashboard.unit_type_farm')],
            self::UNIT_TYPE_WAREHOUSE => ['id' => self::UNIT_TYPE_WAREHOUSE, 'name' => __('dashboard.unit_type_warehouse')],
            self::UNIT_TYPE_WEDDING_HALL => ['id' => self::UNIT_TYPE_WEDDING_HALL, 'name' => __('dashboard.unit_type_wedding_hall')],
            self::UNIT_TYPE_SHOP_STORE => ['id' => self::UNIT_TYPE_SHOP_STORE, 'name' => __('dashboard.unit_type_shop_store')],
            self::UNIT_TYPE_POWER_PLANTS => ['id' => self::UNIT_TYPE_POWER_PLANTS, 'name' => __('dashboard.unit_type_power_plants')],
            self::UNIT_TYPE_FACTORY => ['id' => self::UNIT_TYPE_FACTORY, 'name' => __('dashboard.unit_type_factory')],
            self::UNIT_TYPE_GARAGE_PARKING => ['id' => self::UNIT_TYPE_GARAGE_PARKING, 'name' => __('dashboard.unit_type_garage_parking')],
            self::UNIT_TYPE_BUSINESS_HALL_OFFICE_FLOOR => ['id' => self::UNIT_TYPE_BUSINESS_HALL_OFFICE_FLOOR, 'name' => __('dashboard.unit_type_business_hall_office_floor')],
            self::UNIT_TYPE_CANTEEN => ['id' => self::UNIT_TYPE_CANTEEN, 'name' => __('dashboard.unit_type_canteen')],
            self::UNIT_TYPE_COMPLETE_BUILDING => ['id' => self::UNIT_TYPE_COMPLETE_BUILDING, 'name' => __('dashboard.unit_type_complete_building')],
            self::UNIT_TYPE_MINE_QUARRY => ['id' => self::UNIT_TYPE_MINE_QUARRY, 'name' => __('dashboard.unit_type_mine_quarry')],
            self::UNIT_TYPE_CAR_PARK => ['id' => self::UNIT_TYPE_CAR_PARK, 'name' => __('dashboard.unit_type_car_park')],
            self::UNIT_TYPE_MARKET_PLACE => ['id' => self::UNIT_TYPE_MARKET_PLACE, 'name' => __('dashboard.unit_type_market_place')],
            self::UNIT_TYPE_PLAZA => ['id' => self::UNIT_TYPE_PLAZA, 'name' => __('dashboard.unit_type_plaza')],
            self::UNIT_TYPE_PLAZA_FLOOR => ['id' => self::UNIT_TYPE_PLAZA_FLOOR, 'name' => __('dashboard.unit_type_plaza_floor')],
            self::UNIT_TYPE_PREFABRICATED_BUILDING => ['id' => self::UNIT_TYPE_PREFABRICATED_BUILDING, 'name' => __('dashboard.unit_type_prefabricated_building')],
            self::UNIT_TYPE_RADIO_STATION => ['id' => self::UNIT_TYPE_RADIO_STATION, 'name' => __('dashboard.unit_type_radio_station')],
            self::UNIT_TYPE_RESIDENCE_OFFICE_FLOOR => ['id' => self::UNIT_TYPE_RESIDENCE_OFFICE_FLOOR, 'name' => __('dashboard.unit_type_residence_office_floor')],
            self::UNIT_TYPE_RESTAURANT => ['id' => self::UNIT_TYPE_RESTAURANT, 'name' => __('dashboard.unit_type_restaurant')],
            self::UNIT_TYPE_MEDICAL_CENTER => ['id' => self::UNIT_TYPE_MEDICAL_CENTER, 'name' => __('dashboard.unit_type_medical_center')],
            self::UNIT_TYPE_SPA_BATH_SAUNA => ['id' => self::UNIT_TYPE_SPA_BATH_SAUNA, 'name' => __('dashboard.unit_type_spa_bath_sauna')],
            self::UNIT_TYPE_SPORTS_FACILITY => ['id' => self::UNIT_TYPE_SPORTS_FACILITY, 'name' => __('dashboard.unit_type_sports_facility')],
            self::UNIT_TYPE_DORMUTORY => ['id' => self::UNIT_TYPE_DORMUTORY, 'name' => __('dashboard.unit_type_dormutory')],
        ];

        return $types;

    }

    static function getIconClass($typeId)
    {
        $types = [
            self::UNIT_TYPE_COMMERCIAL => self::UNIT_TYPE_COMMERCIAL_ICON_CLASS,
            self::UNIT_TYPE_INDUSTRIAL => self::UNIT_TYPE_INDUSTRIAL_ICON_CLASS,
            self::UNIT_TYPE_LAND => self::UNIT_TYPE_LAND_ICON_CLASS,
            self::UNIT_TYPE_BUILDING => self::UNIT_TYPE_BUILDING_ICON_CLASS,
            self::UNIT_TYPE_PROJECT_SITE => self::UNIT_TYPE_PROJECT_SITE_ICON_CLASS,
            self::UNIT_TYPE_SINGLE => self::UNIT_TYPE_SINGLE_ICON_CLASS,
            self::UNIT_TYPE_PARKING_SPACE => self::UNIT_TYPE_PARKING_SPACE_ICON_CLASS,
            self::UNIT_TYPE_MARINA => self::UNIT_TYPE_MARINA_ICON_CLASS,
            self::UNIT_TYPE_OTHER => self::UNIT_TYPE_OTHER_ICON_CLASS,
            self::UNIT_TYPE_GAS_STATION => self::UNIT_TYPE_GAS_STATION_ICON_CLASS,
            self::UNIT_TYPE_APARTMENT => self::UNIT_TYPE_APARTMENT_ICON_CLASS,
            self::UNIT_TYPE_WORKSHOP => self::UNIT_TYPE_WORKSHOP_ICON_CLASS,
            self::UNIT_TYPE_MALL => self::UNIT_TYPE_MALL_ICON_CLASS,
            self::UNIT_TYPE_BUFFET => self::UNIT_TYPE_BUFFET_ICON_CLASS,
            self::UNIT_TYPE_OFFICE => self::UNIT_TYPE_OFFICE_ICON_CLASS,
            self::UNIT_TYPE_CAFE=> self::UNIT_TYPE_CAFE_ICON_CLASS,
            self::UNIT_TYPE_FARM => self::UNIT_TYPE_FARM_ICON_CLASS,
            self::UNIT_TYPE_WAREHOUSE => self::UNIT_TYPE_WAREHOUSE_ICON_CLASS,
            self::UNIT_TYPE_WEDDING_HALL => self::UNIT_TYPE_WEDDING_HALL_ICON_CLASS,
            self::UNIT_TYPE_SHOP_STORE => self::UNIT_TYPE_SHOP_STORE_ICON_CLASS,
            self::UNIT_TYPE_POWER_PLANTS => self::UNIT_TYPE_POWER_PLANTS_ICON_CLASS,
            self::UNIT_TYPE_FACTORY => self::UNIT_TYPE_FACTORY_ICON_CLASS,
            self::UNIT_TYPE_GARAGE_PARKING => self::UNIT_TYPE_GARAGE_PARKING_ICON_CLASS,
            self::UNIT_TYPE_BUSINESS_HALL_OFFICE_FLOOR => self::UNIT_TYPE_BUSINESS_HALL_OFFICE_FLOOR_ICON_CLASS,
            self::UNIT_TYPE_CANTEEN => self::UNIT_TYPE_CANTEEN_ICON_CLASS,
            self::UNIT_TYPE_COMPLETE_BUILDING => self::UNIT_TYPE_COMPLETE_BUILDING_ICON_CLASS,
            self::UNIT_TYPE_MINE_QUARRY => self::UNIT_TYPE_MINE_QUARRY_ICON_CLASS,
            self::UNIT_TYPE_CAR_PARK => self::UNIT_TYPE_CAR_PARK_ICON_CLASS,
            self::UNIT_TYPE_MARKET_PLACE => self::UNIT_TYPE_MARKET_PLACE_ICON_CLASS,
            self::UNIT_TYPE_PLAZA => self::UNIT_TYPE_PLAZA_ICON_CLASS,
            self::UNIT_TYPE_PLAZA_FLOOR => self::UNIT_TYPE_PLAZA_FLOOR_ICON_CLASS,
            self::UNIT_TYPE_PREFABRICATED_BUILDING => self::UNIT_TYPE_PREFABRICATED_BUILDING_ICON_CLASS,
            self::UNIT_TYPE_RADIO_STATION => self::UNIT_TYPE_RADIO_STATION_ICON_CLASS,
            self::UNIT_TYPE_RESIDENCE_OFFICE_FLOOR => self::UNIT_TYPE_RESIDENCE_OFFICE_FLOOR_ICON_CLASS,
            self::UNIT_TYPE_RESTAURANT => self::UNIT_TYPE_RESTAURANT_ICON_CLASS,
            self::UNIT_TYPE_MEDICAL_CENTER => self::UNIT_TYPE_MEDICAL_CENTER_ICON_CLASS,
            self::UNIT_TYPE_SPA_BATH_SAUNA => self::UNIT_TYPE_SPA_BATH_SAUNA_ICON_CLASS,
            self::UNIT_TYPE_SPORTS_FACILITY => self::UNIT_TYPE_SPORTS_FACILITY_ICON_CLASS,
            self::UNIT_TYPE_DORMUTORY => self::UNIT_TYPE_DORMUTORY_ICON_CLASS,
        ];
        if(isset($types[$typeId])){
            return $types[$typeId];
        }
        return $types[self::UNIT_TYPE_OTHER];
    }

    static function getStatus($badge = false, $status)
    {
        switch ($status) {
            case self::UNIT_STATUS_FOR_RENT:
                $name = __('dashboard.rent');
                $badgeClass = 'badge-warning';
                break;
            case self::UNIT_STATUS_LOAD:
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

    static function ownersCount($unitId)
    {
        return $owners = UnitPerson::query()->where('unit_id', $unitId)->where('type_id', UnitPerson::UNIT_PERSONS_TYPE_OWNER)->count();
    }

    /**
     * @return bool|null
     */
    public function delete()
    {
        DB::beginTransaction();
        try{
            Outgoing::query()->where('unit_id',$this->id)->delete();
            Contract::query()->where('unit_id',$this->id)->delete();
            File::query()->where('unit_id',$this->id)->delete();
            Note::query()->where('unit_id',$this->id)->delete();
            Detail::query()->where('unit_id',$this->id)->delete();
            UnitPerson::query()->where('unit_id',$this->id)->delete();
            Fixture::query()->where('unit_id',$this->id)->delete();
            DB::commit();;
            return parent::delete();
        }catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

    }
}
