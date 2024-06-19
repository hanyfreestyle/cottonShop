<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('users_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique();
            $table->string('whatsapp')->nullable();

            $table->integer('city_id')->nullable();
            $table->integer('status')->default(1);
            $table->boolean("is_active")->default(true);

            $table->string('photo')->nullable();
            $table->string('photo_thum_1')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_temp')->nullable();
            $table->dateTime("last_login")->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_customers_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid()->unique();
            $table->unsignedBigInteger('customer_id');

            $table->string("name");
            $table->unsignedBigInteger('city_id')->nullable();
            $table->text("address");
            $table->string("recipient_name");
            $table->string("phone");
            $table->string("phone_option")->nullable();
            $table->boolean("is_default")->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users_customers')->onDelete('cascade');
        });

        Schema::create('users_customers_wish_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('customer_id')->references('id')->on('users_customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('pro_products')->onDelete('cascade');
        });

    }

    public function down(): void {
        Schema::dropIfExists('users_customers_wish_list');
        Schema::dropIfExists('users_customers_addresses');
        Schema::dropIfExists('users_customers');
    }

};
