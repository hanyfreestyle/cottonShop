<?php

return [

//    "Product" => [
//        "old_id" => false,
//        "tags" => true,
//        "brand" => true,
//        "attribute" => true,
//        "table_lang" => false,
//        "table_photos" => false,
//    ],

//    "BlogPost" => [
//        "tags" => true,
//        "table_all_lang" => false,
//        "table_photos" => false,
//        "brand" => true,
//        "youtube" => false,
//        "review" => false,
//    ],


    "Meta" => [
        "name" => true,
    ],

    "Country" => [
        "seo" => true,
    ],

    "City" => [
        "seo" => false,
        "add_photo" => false,
        "add_country" => true,
        "def_country" => 66,
        "deleteData" => false
    ],

    "Area" => [
        "seo" => false,
        "add_photo" => false,
        "add_country" => true,
        "def_country" => 66,
        "add_city" => true,
        "def_city" => 1,
        "deleteData" => false
    ],

    "ConfigData" => [
        "deleteData" => false
    ],
];
