<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('shopping_order_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("city");
            $table->text("address");
            $table->string("phone");
            $table->string("phone_option")->nullable();
            $table->text('notes')->nullable();
        });

        Schema::create('shopping_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('city_id');

            $table->uuid()->unique();
            $table->dateTime('order_date');
            $table->string('invoice_number')->nullable();
            $table->boolean("status")->default(1);
            $table->float('total')->default(0);
            $table->float('shipping')->default(0);
            $table->float('total_invoice')->default(0);
            $table->integer('units');

            $table->dateTime('cancellation_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->text('cancellation_notes')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users_customers')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('shopping_order_addresses')->onDelete('cascade');

        });

        Schema::create('shopping_order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->string('sku')->nullable();

            $table->string("name");
            $table->float('price');
            $table->float('regular_price')->nullable();
            $table->float('qty');

            $table->foreign('order_id')->references('id')->on('shopping_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });

        Schema::create('shopping_order_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('log_ref');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('add_date');
            $table->text('notes')->nullable();
            $table->foreign('order_id')->references('id')->on('shopping_orders')->onDelete('cascade');
        });


    }

    public function down(): void {
        Schema::dropIfExists('shopping_order_logs');
        Schema::dropIfExists('shopping_order_products');
        Schema::dropIfExists('shopping_orders');
        Schema::dropIfExists('shopping_order_addresses');
    }

};
