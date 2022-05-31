<?php

namespace App\Providers;

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
        view()->composer('*', function ($view) {
            if (request()->getHttpHost() === 'flyunique.pk'){
                $view->with('site_link', 'https://flyunique.pk');
            }
            elseif (request()->getHttpHost() === 'huzatech.com') {
                $view->with('site_link', 'https://huzatech.com');
            }
            else{
                $view->with('site_link', 'http://localhost/flyunique_b2c');
            }
            // $view->with('site_link', 'https://flyunique.pk/flyunique_admin');
        });
    }
}
