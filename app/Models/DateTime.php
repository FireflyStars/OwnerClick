<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateTime extends Model
{
    use HasFactory;


    /**
     * @return \string[][]
     */
    static function getDateFormats()
    {
        return [
            ['id' => 'm/d/Y', 'name' => __('dashboard.month_day_year')],
            ['id' => 'd/m/Y', 'name' => __('dashboard.day_month_year')],
        ];
    }

    /**
     * @return \string[][]
     */
    static function getJavascriptDateFormats()
    {
        return [
            'm/d/Y' => 'MM/DD/YYYY',
            'd/m/Y' => 'DD/MM/YYYY',
        ];
    }


    /**
     * @return \string[][]
     */
    static function getTimeFormats()
    {
        return [
            ['id' => '1', 'name' => __('dashboard.24_hour')],
            ['id' => '2', 'name' => __('dashboard.am_pm')],
        ];
    }

    /**
     * @return \string[][]
     */
    static function getTimeFormatsFromPhp()
    {
        return [
            1 => 'H:i',
            2 => 'h:i a',
        ];
    }

    /**
     * @return \string[][]
     */
    static function getJavascriptTimeFormats()
    {
        return [
            0 => 'hh:mm tt',
            1 => 'hh:mm'
        ];
    }
}
