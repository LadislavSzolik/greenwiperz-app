<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booking_id'); 
            $table->string('refund_nr');
            $table->integer('price');
            $table->string('currency')->default('CHF');
            $table->integer('netto_price');
            $table->integer('mwst_percent');
            $table->string('mwst_id');
            $table->bigInteger('transaction_id');  
            $table->integer('refunded_amount');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refunds');
    }
}
