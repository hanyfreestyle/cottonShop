<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {

        Schema::create('crm_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('mobile_2')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('whatsapp')->nullable();
            $table->text("notes")->nullable();

            $table->boolean("is_active")->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('crm_customers_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid()->unique();
            $table->unsignedBigInteger('customer_id');

            $table->string("name");


            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->text("address");

            $table->string("floor");
            $table->string("unit_num");

            $table->boolean("is_default")->default(false);

            $table->foreign('customer_id')->references('id')->on('crm_customers')->onDelete('cascade');

        });

    }

    public function down(): void {
        Schema::dropIfExists('crm_customers_address');
        Schema::dropIfExists('crm_customers');
    }

};
