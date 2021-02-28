<?php
/*
 *
 */

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

/**
 * Class LoginResponse
 * @package App\Http\Responses
 */
class LoginResponse implements LoginResponseContract
{
    //TODO: delete or use it!!!!
    public function toResponse($request)
    {
        $flattenRoles = Auth::user()->roles->flatten()->pluck('name')->unique();
        if ($flattenRoles->contains('greenwiper')) {
            return redirect()->route('appointments.index');
        } else {
            return redirect()->route('bookings.index');
        }
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}
