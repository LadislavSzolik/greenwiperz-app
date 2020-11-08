<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); 
            $table->enum('service_type', ['outside', 'inside-outside']);
            $table->integer('service_duration');
            $table->string('parking_street_number',200);
            $table->string('parking_route',200);
            $table->string('parking_city',100);
            $table->string('parking_postal_code',20);
            $table->string('vehicle_model',100);
            $table->string('number_plate',50);
            $table->enum('vehicle_size', ['small', 'medium', 'large','x-large']);
            $table->string('vehicle_color',10);
            $table->boolean('has_extra_dirt');
            $table->boolean('has_animal_hair');
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_services');
    }
}
