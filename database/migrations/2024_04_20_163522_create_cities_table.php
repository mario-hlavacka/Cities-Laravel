<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('mayor_name');
            $table->string('city_hall_address');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('web_address');
            $table->string('coat_of_arms_path');
            $table->float('lat')->nullable();
            $table->float('lon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
