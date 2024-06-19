<?php

namespace App\AppPlugin\Customers\Models;


use App\AppPlugin\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UsersCustomersWishList extends Model {

    protected $table = "users_customers_wish_list";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;

    public function customer(): BelongsTo {
        return $this->belongsTo(UsersCustomers::class, 'customer_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class,'product_id');
    }

}
