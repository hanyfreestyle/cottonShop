<?php

namespace App\AppPlugin\Orders\Models;


use App\AppPlugin\Customers\Models\ShoppingOrderAddress;
use App\AppPlugin\Customers\Models\ShoppingOrderProduct;
use App\AppPlugin\Customers\Models\UsersCustomers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use SoftDeletes;

    protected $fillable = [''];
    protected $table = "shopping_orders";
    protected $primaryKey = 'id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    customer
    public function customer(): BelongsTo {
        return $this->belongsTo(UsersCustomers::class, 'customer_id');
    }

    public function address(): BelongsTo {
        return $this->belongsTo(ShoppingOrderAddress::class, 'address_id');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # products
    public function products(): HasMany {
        return $this->hasMany(ShoppingOrderProduct::class, 'order_id');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # orderDate
    public function orderDate(): string {
        return Carbon::parse($this->order_date)->locale(app()->getLocale())->translatedFormat('Y-m-d');
    }

    public function deliveryDate(): string {
        return Carbon::parse($this->delivery_date)->locale(app()->getLocale())->translatedFormat('Y-m-d');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeDef
    public function scopeDef(Builder $query): Builder {
        return $query->with('address');
    }

    public function orderlog(): HasMany {
        return $this->hasMany(ShoppingOrderLog::class, 'order_id')->with('user');
    }
}
