<?php

namespace App\Providers;

use Laraish\Support\Wp\Providers\ThemeOptionsProvider as ServiceProvider;

class ThemeOptionsProvider extends ServiceProvider
{
    public function boot()
    {
        //
        try {
            parent::boot();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
