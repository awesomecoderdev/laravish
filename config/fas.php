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

    'feedback_delay_mins' => env("FAS_FEEDBACK_DELAY_MINS", 3),
    'admin_email' => env("FAS_ADMIN_EMAIL", "info@foundandscan.com")

];
