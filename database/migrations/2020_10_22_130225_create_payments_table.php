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
            $table->bigInteger('transaction_id');
            $table->string('type');
            $table->string('status');
            $table->string('currency');
            $table->string('refno');
            $table->string("payment_method");
            $table->integer("detail_auth_amount")->nullable();
            $table->string("detail_auth_authcode")->nullable();
            $table->integer("detail_settle_amount")->nullable();
            $table->integer('detail_credit_amount')->nullable();
            $table->boolean('detail_cancel_reversal')->nullable();
            $table->string("detail_fail_reason")->nullable();
            $table->string("detail_fail_msg")->nullable();
                                     
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->softDeletes();
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
