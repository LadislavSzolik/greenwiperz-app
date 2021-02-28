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

/**
 * App\Models\Booking
 *
 * @property int $id
 * @property string $booking_nr
 * @property string $type
 * @property string $status
 * @property int $customer_id
 * @property int $assigned_to
 * @property string|null $invoice_nr
 * @property int|null $transaction_id
 * @property string $loc_street_number
 * @property string $loc_route
 * @property string $loc_city
 * @property string $loc_postal_code
 * @property string|null $service_type
 * @property int $duration
 * @property string $currency
 * @property int $extra_dirt
 * @property int $animal_hair
 * @property int $base_cost
 * @property int $extra_cost
 * @property float $vat
 * @property int|null $fleet_discount
 * @property int|null $discounted_cost
 * @property int $brutto_total_amount
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $notes
 * @property string|null $internal_notes
 * @property string|null $tc_accepted_at
 * @property string $gw_vat_number
 * @property string $gw_company_name
 * @property string $gw_street
 * @property string $gw_postal_code
 * @property string $gw_city
 * @property string $gw_country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \App\Models\User $assignedTo
 * @property-read \App\Models\BillingAddress|null $billingAddress
 * @property-read \App\Models\Car|null $car
 * @property-read \App\Models\User $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fleet[] $fleets
 * @property-read int|null $fleets_count
 * @property-read mixed $complete_billing_address
 * @property-read mixed $display_creation_date
 * @property-read mixed $formated_base_cost
 * @property-read mixed $formated_discounted_cost
 * @property-read mixed $formated_duration
 * @property-read mixed $formated_extra_cost
 * @property-read mixed $formated_total_cost
 * @property-read mixed $is_cancel_allowed
 * @property-read mixed $is_complete_allowed
 * @property-read mixed $is_destroy_allowed
 * @property-read mixed $parking_location_address
 * @property-read mixed $refundable_amount
 * @property-read mixed $total_number_of_cars
 * @property-read \App\Models\Receipt|null $receipt
 * @property-read \App\Models\Refund|null $refund
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereAnimalHair($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBaseCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBruttoTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDiscountedCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereExtraCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereExtraDirt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFleetDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGwCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGwCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGwCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGwPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGwStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereGwVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereInternalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereInvoiceNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereLocCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereLocPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereLocRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereLocStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereServiceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTcAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereVat($value)
 * @mixin \Eloquent
 */
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

    public function appointments() {
        return $this->hasMany('App\Models\Appointment');
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
        $firstAppointment = $this->appointments()->first();
        $bookingDateTime = new Carbon($firstAppointment->dateForEditing. ' '. $firstAppointment->start_time);
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
        return in_array($this->status, ['pending','confirmed','paid']) && filled($this->appointments);
    }

    public function getIsDestroyAllowedAttribute()
    {
        return $this->status === 'draft' || ($this->status === 'pending' && blank($this->appointments));
    }

    public function getIsCompleteAllowedAttribute()
    {
        return in_array($this->status, ['confirmed', 'paid']);
    }

}
