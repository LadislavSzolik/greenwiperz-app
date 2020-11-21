<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
    use HasFactory;


    public function billingable()
    {
        return $this->morphTo();
    }
}
