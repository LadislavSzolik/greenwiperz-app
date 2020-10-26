<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('user_id');
            $table->string('refno');

            // vehicle location 
            $table->string('parking_street_number',200);
            $table->string('parking_route',200);
            $table->string('parking_city',100);    
            $table->string('parking_postal_code',20);            

            // vehicle  
            $table->string('vehicle_model',100);
            $table->string('number_plate',50);
            $table->enum('vehicle_size', ['small', 'medium', 'large','x-large']);
            $table->string('vehicle_color',10);
            $table->boolean('has_extra_dirt');
            $table->boolean('has_animal_hair');

            // service
            $table->enum('service_type', ['outside', 'inside-outside']);             
            $table->integer('service_duration');  
            $table->integer('service_price');  

            // notes
            $table->text('notes')->nullable();
            $table->text('internal_notes')->nullable();   
                         
            // copied here the billing address
            $table->string('billing_first_name',255);
            $table->string('billing_last_name',255);
            $table->string('billing_street',200);
            $table->string('billing_postal_code',20);
            $table->string('billing_city',100);
            $table->char('billing_country',100);

            $table->timestamp('completed_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
