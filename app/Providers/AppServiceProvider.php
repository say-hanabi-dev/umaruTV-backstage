<?php

namespace App\Providers;

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
        Blade::component('backstage.layouts.components.back','back');
        Blade::component('backstage.layouts.components.error','showError');
        Blade::component('backstage.layouts.components.input','input');
        Blade::component('backstage.layouts.components.select','select');
        Blade::component('backstage.layouts.components.option','option');

    }
}
