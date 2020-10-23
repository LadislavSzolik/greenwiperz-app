<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->string('refno');
            $table->double('amount',10, 2);
            $table->string('currency');
            $table->unsignedBigInteger("uppTransactionId");
            $table->string('pmethod');
            $table->string('reqtype');
            $table->string('uppMsgType');
            $table->string('status');
            $table->string('responseCode')->nullable();
            $table->string('responseMessage')->nullable();
            $table->string('errorCode')->nullable();
            $table->string('errorMessage')->nullable();
            $table->string('errorDetail')->nullable();
            $table->string('aliasCC')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
