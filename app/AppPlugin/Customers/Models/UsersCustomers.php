<?php

namespace App\AppPlugin\Customers\Models;



use App\AppPlugin\Data\City\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UsersCustomers extends Authenticatable {
    use HasApiTokens,  Notifiable;
    use SoftDeletes;

    protected $guarded = "customer";

    protected $table = "users_customers";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        ///  'roles_name' => 'array',
    ];


    public function wishList(): HasMany {
        return $this->hasMany(UsersCustomersWishList::class,'customer_id');
    }

    public function addresses(): HasMany {
        return $this->hasMany(UsersCustomersAddress::class, 'customer_id')
//            ->with('city')
            ->orderBy('is_default', 'desc');
    }

    public function scopeDef(Builder $query): Builder {
        return $query->where('status', 1)->where('is_active', 1);
    }

    public function scopeDefAdmin(Builder $query): Builder {
        return $query->where('id','!=',0)->with('city');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # orderDate
    public function registerDate(): string {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->translatedFormat('Y-m-d');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     city
    public function city(): BelongsTo {
        return $this->belongsTo(City::class,'city_id','id')->with('translation');
    }

}
