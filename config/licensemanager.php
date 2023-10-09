<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Default Feedback Delay
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'user' => env("LICENSE_MANAGER_USER", ""),
    'secret' => env("LICENSE_MANAGER_SECRET", ""),
    'url' => env("LICENSE_MANAGER_URL", ""),
    'shop_url' => env("SHOP_URL", '/'),
];
