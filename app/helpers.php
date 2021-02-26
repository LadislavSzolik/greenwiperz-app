<?php

use Illuminate\Support\Facades\App;

if (! function_exists('current_lang')) {

    function current_lang()
    {
        //dd(config('app.locale'));
        return App::getLocale() . '-ch'; //'en-ch';
    }
}
