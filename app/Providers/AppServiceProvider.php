<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::component('componentes._home','home');
        Blade::component('componentes._card','card');
        Blade::component('componentes._catalogo','catalogo');
        Blade::component('componentes._form_full_modal','formFullModal');
        Blade::component('componentes._asignaciones','asignaciones');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
