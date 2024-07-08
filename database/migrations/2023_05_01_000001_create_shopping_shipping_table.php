<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('shopping_shipping_cat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->json("city_id")->nullable();
            $table->integer("is_active")->default(1);
        });

        Schema::create('shopping_shipping_rate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_id');
            $table->integer('price_from');
            $table->integer('price_to');
            $table->integer('rate');

            $table->foreign('cat_id')->references('id')->on('shopping_shipping_cat')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('shopping_shipping_rate');
        Schema::dropIfExists('shopping_shipping_cat');
    }

};
