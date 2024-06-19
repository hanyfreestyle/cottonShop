<?php

namespace App\AppPlugin\Customers\Models;



use App\AppPlugin\Data\City\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersCustomersAddress extends Model {
    use SoftDeletes;
    protected $table = "users_customers_addresses";
    protected $primaryKey = 'id';
    protected $fillable = [];



    public function city(): BelongsTo {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(UsersCustomers::class, 'customer_id');
    }

}
