<?php

namespace App\AppPlugin\Customers\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingOrder extends Model {


    protected $table = "shopping_orders";
    protected $primaryKey = 'id';


    public function getFormatteDate() {
        return Carbon::parse($this->order_date)->locale(app()->getLocale())->translatedFormat('jS F Y');

    }

    public function getFormatteDateOrderView() {
        return Carbon::parse($this->order_date)->locale(app()->getLocale())->translatedFormat('Y-m-d');

    }


    public function products(): HasMany {
        return $this->hasMany(ShoppingOrderProduct::class, 'order_id', 'id');
    }

    public function log(): HasMany {
        return $this->hasMany(ShoppingOrderLog::class, 'order_id');
    }


}
