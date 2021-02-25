<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Barryvdh\DomPDF\ServiceProvider::class;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https');
        if (in_array(Request::segment(1), Config::get('app.all_langs'))) {
            App::setLocale(Request::segment(1));
            Config::set('app.locale_prefix', Request::segment(1));
        } else {
            return redirect(url(config("app.locale") . "/" ))->send();
        }
    }
}
