<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('shopping_paymob_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('paymob_id')->unique();
            $table->integer('paymob_order_id');
            $table->boolean('success');
            $table->string('merchant_order_id');
            $table->integer('amount_cents');
            $table->string('order_uuid')->nullable();
            $table->integer('order_id')->nullable();
            $table->json('responses')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('shopping_paymob_responses');
    }

};
