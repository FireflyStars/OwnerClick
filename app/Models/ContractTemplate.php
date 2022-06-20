<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contract_templates';
    protected $fillable = ['creator_id', 'name', 'template'];

    protected $primaryKey = 'id';


}
