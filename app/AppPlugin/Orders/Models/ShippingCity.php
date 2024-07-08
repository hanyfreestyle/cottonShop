<?php

namespace App\AppPlugin\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ShippingCity extends Model {

    protected $table = "shopping_shipping_cat";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function rates(): HasMany {
        return $this->hasMany(ShippingRates::class,'cat_id','id')->orderBy('price_from');
    }

}
