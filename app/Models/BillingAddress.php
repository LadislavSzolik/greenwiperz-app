<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BillingAddress
 *
 * @property int $id
 * @property string $is_company
 * @property string $first_name
 * @property string $last_name
 * @property string|null $company_name
 * @property string $street
 * @property string $postal_code
 * @property string $city
 * @property string $country
 * @property string $billingable_type
 * @property int $billingable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $billingable
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereBillingableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereBillingableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereIsCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingAddress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BillingAddress extends Model
{

    protected $fillable = [      
        'first_name',
        'last_name',
        'company_name',
        'street',
        'postal_code',
        'city',
        'country',
        'is_company',
    ];
    use HasFactory;


    public function billingable()
    {
        return $this->morphTo();
    }
}
