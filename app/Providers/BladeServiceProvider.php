<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::if('hasrole', function ($environment) {
            if(!empty(session('user'))){
                if(session('user')->has_role($environment)){
                    return true;
                }
            }
            return false;
        });
    }
}
