<?php

namespace App\AppPlugin\Customers\Seeder;

use App\AppPlugin\Customers\Models\UsersCustomers;
use App\AppPlugin\Customers\Models\UsersCustomersAddress;
use App\AppPlugin\Customers\Models\UsersCustomersWishList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersCustomersSeeder extends Seeder {

    public function run(): void {

        UsersCustomers::unguard();
        $tablePath = public_path('db/users_customers.sql');
        DB::unprepared(file_get_contents($tablePath));

        UsersCustomersAddress::unguard();
        $tablePath = public_path('db/users_customers_addresses.sql');
        DB::unprepared(file_get_contents($tablePath));

//        UsersCustomersWishList::unguard();
//        $tablePath = public_path('db/users_customers_wish_list.sql');
//        DB::unprepared(file_get_contents($tablePath));

   }

}
