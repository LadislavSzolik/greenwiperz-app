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

        Schema::create('appointments', function (Blueprint $table) 
        {
            $table->id();                
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamp('completed_at')->nullable();
            $table->unsignedBigInteger('completed_by')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->unsignedBigInteger('canceled_by')->nullable();  
            $table->boolean('is_vacation')->default(0);          
            $table->text('comment')->nullable();
            $table->timestamps();            
            $table->foreign('assigned_to')->references('id')->on('users')->onUpdate('cascade');
        });



        Schema::create('bookings', function (Blueprint $table) 
        {
            $table->id();
            $table->string('booking_nr');
            $table->string('invoice_nr');
            $table->bigInteger('transaction_id')->nullable();

            $table->string('status');

            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('appointment_id')->nullable();

            
            $table->timestamp('booking_datetime');  
            
            $table->string('loc_street_number',200);
            $table->string('loc_route',200);
            $table->string('loc_city',100);
            $table->string('loc_postal_code',20);

            $table->enum('service_type', ['outside', 'inside-outside']);
            $table->integer('duration');
            $table->integer('quantity')->default(1);
            $table->string('currency')->default('CHF');

            $table->integer('base_cost');
            $table->integer('extra_cost');
            $table->double('vat')->default(0.077);
            $table->integer('brutto_total_amount');
            
            $table->boolean('has_extra_dirt');
            $table->boolean('has_animal_hair');        

            $table->string('phone')->nullable();                            
            
            $table->text('notes')->nullable();
            $table->text('internal_notes')->nullable();

            $table->timestamp('tc_accepted_at')->nullable();                                          

            $table->string('gw_vat_number',255);
            $table->string('gw_company_name',255);
            $table->string('gw_street',200);
            $table->string('gw_postal_code',20);
            $table->string('gw_city',100);
            $table->string('gw_country',100)->default('Schweiz');  
            $table->timestamps();
            
            $table->foreign('appointment_id')->references('id')->on('appointments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
        });

       
        Schema::create('ratings', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('level');
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('cars', function (Blueprint $table) 
        {
            $table->id(); 
            $table->string('car_model',100);
            $table->string('car_color',50);            
            $table->string('number_plate',50);
            $table->enum('car_size', ['small', 'medium', 'large','x-large']);   
            $table->morphs('carable');
            $table->timestamps();            
        });


        Schema::create('billing_addresses', function (Blueprint $table) 
        {
            $table->id(); 
            $table->string('first_name',255);
            $table->string('last_name',255);     
            $table->string('company_name',255)->nullable();       
            $table->string('street',200);
            $table->string('postal_code',20);
            $table->string('city',100);
            $table->string('country',100);     
            $table->morphs('billingable');
            $table->timestamps();            
        });

        Schema::create('receipts', function (Blueprint $table) 
        {
            $table->id();            
            $table->unsignedBigInteger('booking_id'); 
            $table->string('receipt_nr');                                                   
            $table->integer('paid_amount');
            $table->string('paid_with');   
            $table->bigInteger('transaction_id');          
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');  
        });

        Schema::create('refunds', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('booking_id'); 
            $table->string('refund_nr');                
            $table->integer('refunded_amount');    
            $table->bigInteger('transaction_id');      
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

        Schema::dropIfExists('appointments');
  
        Schema::dropIfExists('bookings');

        Schema::dropIfExists('ratings');

        Schema::dropIfExists('addresses');

        Schema::dropIfExists('receipts');

        Schema::dropIfExists('refunds');
    }
}
