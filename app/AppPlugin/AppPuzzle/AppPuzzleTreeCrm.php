<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrm {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ProductTree
    static function CrmTree() {
        $modelTree = [
            'CrmCustomers' => self::treeCrmCustomers(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   treeCustomers
    static function treeCrmCustomers() {
        return [
            'view' => true,
            'id' => "CrmCustomers",
            'CopyFolder' => "Crm_Customers",
            'appFolder' => 'Crm/Customers',
            'viewFolder' => 'CrmCustomer',
            'routeFolder' => "crm/",
            'routeFile' => 'customers.php',
            'migrations' => [
                '2021_01_01_000001_create_crm_customers_table.php',
            ],
            'seeder' => ['crm_customers.sql', 'crm_customers_address.sql'],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['customers.php'],
//            'ComponentFolderClass' => ['Site/Customer'],
//            'ComponentFolderView' => ['site/customer'],

        ];
    }


}
