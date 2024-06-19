<?php

namespace App\AppPlugin\Crm\Customers\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class CrmCustomers extends Model {

    protected $table = "crm_customers";
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function scopeDef(Builder $query): Builder {
        return $query->where('id','!=',0);
    }

}
