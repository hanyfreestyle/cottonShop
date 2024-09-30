<?php

namespace App\AppPlugin\Orders\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PayMobResponses extends Model {
    protected $table = "shopping_paymob_responses";
    protected $primaryKey = 'id';

}
