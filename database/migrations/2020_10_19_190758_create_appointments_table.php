<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();                
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamp('canceled_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->boolean('is_vacation')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('assigned_to')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
