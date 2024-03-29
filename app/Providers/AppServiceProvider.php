<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Change the error reporting level to match WordPress's

        if ( ! defined("WP_DEBUG")) {
            error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
        }
        $this->shareViewData();
    }

    public function shareViewData()
    {
        if(function_exists("add_filter")){
            add_filter('template_include', function ($template) {

                // Share global view data
                // view()->share('data_name', 'data');

                // Sharing data with specific view
                // view()->composer(['components.sidebar'], 'App\Http\ViewComposers\SidebarComposer');

                return $template;
            });
        }

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
