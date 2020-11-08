<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booking_id'); 
            $table->string('invoice_nr');
            $table->string('currency')->default('CHF');
            $table->integer('price');
            $table->integer('netto_price');
            $table->double('mwst_percent')->default(0.077);
            $table->string('mwst_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('invoices');
    }
}
