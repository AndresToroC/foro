<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        //
        \Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        \Form::component('bsPassword', 'components.form.password', ['name']);
    }
}
