<?php

declare(strict_types=1);

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

if (!function_exists('current_lang')) {
    function current_lang()
    {
        //dd(config('app.locale'));
        return App::getLocale() . '-ch'; //'en-ch';
    }
}
/**
 * Generate the URL to a named route.
 *
 * @param $name
 * @param array $parameters
 * @param bool $absolute
 * @param null $lang
 * @return string
 */
function route($name, $parameters = [], $absolute = true, $lang = null): string
{
    if (Str::contains($name, ['ajax', 'autocomplete', 'debugbar'])) {
        return app('url')->route($name, $parameters, $absolute);
    }

    if ( $lang && in_array($lang, config('app.all_langs')) ){
        return app('url')->route($lang . '.' . $name, $parameters, $absolute);
    }

    $locale_prefix = current_lang();
    return app('url')->route($locale_prefix . '.' . $name, $parameters, $absolute);
}
