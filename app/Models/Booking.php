<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{   
    use HasFactory;

    protected $guarded = [];
    
    const STATUSES = [
        'pending' => 'Pending',
        'paid' => 'Paid',
        'canceled' => 'Canceled',
        'completed' => 'Completed',
        'draft' => 'Draft',
    ];

    public function appointment() {
        return $this->belongsTo('App\Models\Appointment');
    }

    public function car() {
        return $this->morphOne('App\Models\Car','carable');
    }

    public function billingAddress() {
        return $this->morphOne('App\Models\BillingAddress','billingable');
    }


    public function receipt() {
        return $this->hasOne('App\Models\Receipt');
    }

    public function refund() {
        return $this->hasOne('App\Models\Refund');
    }

    public function customer() 
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }

    public function assignedTo() 
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }

    
    public function getParkingLocationAddressAttribute()
    {
        return $this->loc_route.' '. $this->loc_street_number.'<br />'.$this->loc_postal_code.', '.$this->loc_city;
    }

    public function getFormatedDurationAttribute()
    {
        return CarbonInterval::minutes($this->duration);
    }

    public function getDisplayCreationDateAttribute() {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function getFormatedTotalCostAttribute()
    {
        $money = new Money($this->brutto_total_amount, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        return $moneyFormatter->format($money); 
    }

    public function getFormatedBaseCostAttribute()
    {
        $money = new Money( $this->base_cost, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);        
        return $moneyFormatter->format($money);
    }

    public function getFormatedExtraCostAttribute()
    {
        $money = new Money( $this->extra_cost, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);        
        return $moneyFormatter->format($money);
    }

    public function getCompleteBillingAddressAttribute()
    {
        return $this->billingAddress->first_name.' '.$this->billingAddress->last_name.', '.$this->billingAddress->company_name.'<br>'.$this->billingAddress->street.'<br/>'.$this->billingAddress->postal_code.' '.$this->billingAddress->city.'<br/>'.$this->billingAddress->country;
    }

    public function getCustomerMailAttribute()
    {
        return $this->customer->email;
    }

    /*
    public function getBookingTimestampAttribute()
    {
        return new Carbon($this->appointment->date.' '.$this->appointment->start_time);
    }

    public function bookingStatus()
    {
        if(filled($this->appointment->completed_at)) 
        {
            return 'completed';
        }

        if(filled($this->appointment->canceled_at)) 
        {
            return 'canceled';
        }

        if(filled($this->paid_at)) 
        {
            return 'paid';
        }

        return 'not_paid';
    } */

    public function getRefundableAmountAttribute()
    {
        
        $hoursBeforeCleaning = Carbon::now()->diffInMinutes($this->booking_datetime);
        $settledAmount = $this->brutto_total_amount;
            
        if( $hoursBeforeCleaning < 60) {
            $amountToRefund = 0;
        } else if($hoursBeforeCleaning < 120 && $hoursBeforeCleaning >= 60){
            $amountToRefund = $settledAmount * 0.2;
        } else if($hoursBeforeCleaning < 180  && $hoursBeforeCleaning >= 120){
            $amountToRefund = $settledAmount * 0.5;
        } else if($hoursBeforeCleaning >= 180){
            $amountToRefund = $settledAmount;
        } else {
            $amountToBeRefund = 0;
        }

        return intval($amountToRefund);
    }

    /*
    public function isCancelAllowed() 
    {
       
        return filled($this->paid_at) && blank($this->appointment->completed_at) && blank($this->appointment->canceled_at);
    }
    
    public function isCompletionAllowed()
    {
        return filled($this->paid_at) && blank($this->appointment->completed_at) && blank($this->appointment->canceled_at);
    }
    */
}
