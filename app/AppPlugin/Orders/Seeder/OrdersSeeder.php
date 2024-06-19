<?php

namespace App\AppPlugin\Orders\Seeder;


use App\AppPlugin\Customers\Models\ShoppingOrder;
use App\AppPlugin\Customers\Models\ShoppingOrderAddress;
use App\AppPlugin\Customers\Models\ShoppingOrderProduct;
use App\AppPlugin\Orders\Models\ShoppingOrderLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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

        ShoppingOrderLog::unguard();
        $tablePath = public_path('db/shopping_order_logs.sql');
        DB::unprepared(file_get_contents($tablePath));

   }

}
