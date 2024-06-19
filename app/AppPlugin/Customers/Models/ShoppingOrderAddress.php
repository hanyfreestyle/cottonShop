<?php

namespace App\AppPlugin\Customers\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingOrderAddress extends Model {

    protected $table = "shopping_order_addresses";
    protected $primaryKey = 'id';
    public $timestamps = false;

}
