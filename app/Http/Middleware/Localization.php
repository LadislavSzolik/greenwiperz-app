<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $session = $request->getSession();

        if(!$session->has('locale')){
            session()->put('locale', $request->getPreferredLanguage(['en','de']));
        }

        if ($request->has('locale')) {
            $lang = $request->get('locale');
            if (in_array($lang, ['en','de'])) {
                $session->put('locale', $lang);
            }

        }

        App::setlocale($request->session()->get('locale'));

        return $next($request);
    }
}

