<?php

namespace App\AppPlugin\Orders\Seeder;


use App\AppPlugin\Customers\Models\ShoppingOrder;
use App\AppPlugin\Customers\Models\ShoppingOrderAddress;
use App\AppPlugin\Customers\Models\ShoppingOrderProduct;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Orders\Models\ShippingCity;
use App\AppPlugin\Orders\Models\ShippingRates;
use App\AppPlugin\Orders\Models\ShoppingOrderLog;
use App\Helpers\AdminHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class OrdersSeeder extends Seeder {

    public function run(): void {

        ShoppingOrderAddress::unguard();
        $tablePath = public_path('db/shopping_order_addresses.sql');
        DB::unprepared(file_get_contents($tablePath));

        ShoppingOrder::unguard();
        $tablePath = public_path('db/shopping_orders.sql');
        DB::unprepared(file_get_contents($tablePath));

        ShoppingOrderProduct::unguard();
        $tablePath = public_path('db/shopping_order_products.sql');
        DB::unprepared(file_get_contents($tablePath));

//        ShoppingOrderLog::unguard();
//        $tablePath = public_path('db/shopping_order_logs.sql');
//        DB::unprepared(file_get_contents($tablePath));

        ShippingCity::unguard();
        $tablePath = public_path('db/shopping_shipping_cat.sql');
        DB::unprepared(file_get_contents($tablePath));

        ShippingRates::unguard();
        $tablePath = public_path('db/shopping_shipping_rate.sql');
        DB::unprepared(file_get_contents($tablePath));

        City::query()->where('country_id','!=',66)->delete();

        $name = "احمد مصطفى";
        $user = User::create([
            'name' => $name,
            'slug' => AdminHelper::Url_Slug($name),
            'email' => 'a.mostafa@cottton.shop',
            'password' => Hash::make('a.mostafa@cottton.shop'),
            'roles_name' => ['admin'],
        ]);

        $role = Role::findByName('admin');
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }

}
