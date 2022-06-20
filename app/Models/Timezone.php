<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'timezones';
    protected $fillable = ['name','offset','diff_from_gtm','created_at', 'updated_at'];

    protected $primaryKey = 'id';
}
