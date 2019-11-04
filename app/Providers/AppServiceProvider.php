<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');

        Blade::component('layouts.components.back','back');
        Blade::component('layouts.components.error','showError');
        Blade::component('layouts.components.input','input');
        Blade::component('layouts.components.select','select');
        Blade::component('layouts.components.option','option');

    }
}
