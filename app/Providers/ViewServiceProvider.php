<?php
 
namespace App\Providers;

use App\Http\Views\Composers\MenuComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layout.header',MenuComposer::class);
        
    }
}