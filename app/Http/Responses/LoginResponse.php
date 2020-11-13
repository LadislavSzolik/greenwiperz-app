<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $flattenRoles = Auth::user()->roles->flatten()->pluck('name')->unique();      
       
        if ($flattenRoles->contains('greenwiper')) {         
            return redirect('/appointments');
        } else {
            return redirect('/bookings');
        }
        
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}