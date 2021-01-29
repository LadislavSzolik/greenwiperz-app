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
        'draft' => 'Draft',
        'pending' => 'Pending',
        'paid' => 'Paid',
        'canceled' => 'Canceled',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        
    ];

    public function appointment() {
        return $this->hasOne('App\Models\Appointment');
    }

    public function car() {
        return $this->morphOne('App\Models\Car','carable');
    }

    public function fleets() {
        return $this->morphMany('App\Models\Fleet','fleetable');
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

    public function getTotalNumberOfCarsAttribute()
    {
        return $this->fleets[0]->outside + $this->fleets[0]->inoutside + $this->fleets[1]->outside + $this->fleets[1]->inoutside + $this->fleets[2]->outside + $this->fleets[2]->inoutside + $this->fleets[3]->outside + $this->fleets[3]->inoutside;
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

    public function getFormatedDiscountedCostAttribute()
    {
        $money = new Money( $this->discounted_cost, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);        
        return $moneyFormatter->format($money);
    }

    public function getCompleteBillingAddressAttribute()
    {
        return $this->billingAddress->first_name.' '.$this->billingAddress->last_name.', '.$this->billingAddress->company_name.'<br>'.$this->billingAddress->street.'<br/>'.$this->billingAddress->postal_code.' '.$this->billingAddress->city.'<br/>'.$this->billingAddress->country;
    }


    public function getRefundableAmountAttribute() {
        $bookingDateTime = new Carbon($this->date. ' '. $this->time);
        $hoursBeforeCleaning = Carbon::now()->diffInMinutes($bookingDateTime);
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


    public function getIsCancelAllowedAttribute()
    {
        return in_array($this->status, ['pending','confirmed','paid']) && filled($this->appointment);
    }

    public function getIsDestroyAllowedAttribute()
    {
        return $this->status === 'draft' || ($this->status === 'pending' && blank($this->appointment));
    }

    public function getIsCompleteAllowedAttribute()
    {
        return in_array($this->status, ['confirmed', 'paid']);
    }

}
