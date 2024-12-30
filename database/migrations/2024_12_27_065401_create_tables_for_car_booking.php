<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create('comfort_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('license_plate');
            $table->unsignedBigInteger('comfort_category_id');
            $table->unsignedBigInteger('driver_id');
            $table->timestamps();

            $table->foreign('comfort_category_id')->references('id')->on('comfort_categories');
            $table->foreign('driver_id')->references('id')->on('drivers');
        });



        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('position_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });

        Schema::create('car_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('employee_id')->references('id')->on('user_profile');
        });

        Schema::create('position_comfort_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('comfort_category_id');
            $table->timestamps();

            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('comfort_category_id')->references('id')->on('comfort_categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('position_comfort_category');
        Schema::dropIfExists('car_bookings');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('comfort_categories');
        Schema::dropIfExists('cars');
    }
};
