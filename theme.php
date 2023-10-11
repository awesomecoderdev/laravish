<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Http\Events\RequestHandled;

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (defined('WPINC') && file_exists(THEME_PATH . "/storage/framework/maintenance.php")) {
    require THEME_PATH . '/storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/
if (defined('WPINC') && file_exists(THEME_PATH . "vendor/autoload.php")) {
    require  THEME_PATH . "vendor/autoload.php";
}

/*
|--------------------------------------------------------------------------
| Register Theme Helper
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/
if (defined('WPINC') && file_exists(THEME_PATH . "hook/helper.php")) {
    require  THEME_PATH . "hook/helper.php";
}

/*
|--------------------------------------------------------------------------
| Register Theme Filter
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/
if (defined('WPINC') && file_exists(THEME_PATH . "hook/filter.php")) {
    require  THEME_PATH . "hook/filter.php";
}

/*
|--------------------------------------------------------------------------
| Register Theme Action
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/
if (defined('WPINC') && file_exists(THEME_PATH . "hook/action.php")) {
    require  THEME_PATH . "hook/action.php";
}

/*
|--------------------------------------------------------------------------
| Register Woocommerce Filter
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/
if (defined('WPINC') && file_exists(THEME_PATH . "hook/woocommerce.php")) {
    require  THEME_PATH . "hook/woocommerce.php";
}

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

if (defined('WPINC') && file_exists(THEME_PATH . "bootstrap/app.php")) {
    $app = require_once THEME_PATH . 'bootstrap/app.php';

    $kernel = $app->make(Kernel::class);

    $kernel->handle(Request::capture());

    $app['events']->listen(RequestHandled::class, function (RequestHandled $event) use ($kernel) {
        $event->response->send();

        $kernel->terminate($event->request, $event->response);
    });
}


/*
|--------------------------------------------------------------------------
| Load theme support
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/
add_action('after_setup_theme', 'mlh_after_setup_theme');
if (!function_exists("mlh_after_setup_theme")) {
    function mlh_after_setup_theme()
    {
        if (file_exists(THEME_PATH . "hook/support.php")) {
            require_once THEME_PATH . "hook/support.php";
        }
    }
}
