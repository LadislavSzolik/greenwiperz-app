<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_addresses', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('booking_id'); 
            $table->string('company_name',255);
            $table->string('street',200);
            $table->string('postal_code',20);
            $table->string('city',100);
            $table->string('country',100);     
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_addresses');
    }
}
