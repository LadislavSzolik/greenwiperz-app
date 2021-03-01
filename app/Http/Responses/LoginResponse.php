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
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $flattenRoles = Auth::user()->roles->flatten()->pluck('name')->unique();
        if ($flattenRoles->contains('greenwiper')) {
            return redirect(route('appointments.index'));
        }
        return redirect(route('bookings.index'));
    }

}
