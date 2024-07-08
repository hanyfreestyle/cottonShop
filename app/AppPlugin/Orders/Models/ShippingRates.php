<?php

namespace App\AppPlugin\Orders\Models;


use Illuminate\Database\Eloquent\Model;


class ShippingRates extends Model {
    protected $table = "shopping_shipping_rate";
    protected $primaryKey = 'id';
    public $timestamps = false;


}
