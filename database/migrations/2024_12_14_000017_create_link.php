<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('config_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('href');
            $table->integer('href_id');
            $table->string('type');
            $table->string('cat');
            $table->string('url')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('config_links');
    }

};
