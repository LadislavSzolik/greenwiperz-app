<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function bookings() 
    {
        return $this->hasMany('App\Models\Booking', 'customer_id');
    }   

    public function ratings() 
    {
        return $this->hasMany('App\Models\Rating');
    }  
    
    public function assignedBookings() 
    {
        return $this->hasMany('App\Models\Booking','assigned_to');
    } 

    public function appointments() 
    {
        return $this->hasMany('App\Models\Appointment', 'assigned_to');
    }

    public function billingAddresses() 
    {
        return $this->morphMany('App\Models\BillingAddress','billingable');
    }

    public function cars() 
    {
        return $this->morphMany('App\Models\Car','carable');
    }


    // temporary I just check if the guy is a greenwiper
    public function isGreenwiper()
    {
        $flattenRoles = $this->roles->flatten()->pluck('name')->unique();
        return $flattenRoles->contains('greenwiper');
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }


    public function assignRole($role)
    {
        if (is_string($role))
        {
            $role = Role::whereName($role)->firstOrFail();
        }
        $this->roles()->syncWithoutDetaching($role);
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }
    
}
