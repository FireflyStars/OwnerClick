<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items_order_users';
    protected $fillable = ['id', 'user_id', 'item_type', 'item_id', 'order', 'created_at', 'updated_at'];

    protected $primaryKey = 'id';

    CONST ITEMORDER_ITEM_TYPE_PROPERTIES = 1;
    CONST ITEMORDER_ITEM_TYPE_UNITS = 2;

}
