<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'code', 'iso2', 'iso3', 'phonecode', 'capital', 'currency', 'created_at', 'updated_at','flag'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany('App\Models\State');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function city()
    {
        return $this->hasMany('App\Models\City');
    }

    public function getUserCountry(){

    }

    public static function currencies(){
        return self::query()->get(['currency as name'])->unique('name')->toArray();
    }

}
