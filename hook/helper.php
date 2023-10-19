<?php

/**
 * The wp_is_tablet function.
 *
 *
 * @since             1.0.0
 *
 */
if (!function_exists('wp_is_tablet')) {
    function wp_is_tablet()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Check for common tablet User-Agent strings
        $tabletUserAgents = array(
            'iPad',
            'Android',
            'Kindle',
            'SamsungTablet',
            'Nexus 7',
            // Add more tablet user agents as needed
        );

        foreach ($tabletUserAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return true;
            }
        }

        return false;
    }
}

/**
 * The clog function.
 *
 *
 * @since             1.0.0
 *
 */
if (!function_exists('clog')) {
    function clog($log = false)
    {
        echo "<script>console.log('======================================================================');</script>";
        if (is_array($log) || is_object($log)) {
            $log = json_encode($log, JSON_PRETTY_PRINT);
            echo "<script>console.log([$log]);</script>";
        } else {
            echo "<script>console.log('$log');</script>";
        }
        echo "<script>console.log('======================================================================');</script>";
    }
}



/**
 * The url_scheme function.
 *
 * @link              https://foundandscan.com.de/
 * @since             1.0.0
 *
 */
if (!function_exists('url_scheme')) {
    function url_scheme()
    {
        try {
            $url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : (isset($_SERVER["PHP_SELF"]) ? $_SERVER["PHP_SELF"] : "/");
            $slug = explode("/", $url);
            $slug = array_unique($slug);
            $slug =  array_filter($slug, function ($value) {
                return !empty($value);
            });
            $slug[] = "";
            return $slug;
        } catch (\Throwable $th) {
            //throw $th;
            return [];
        }
    }
}

/**
 * The theme_class function.
 *
 * @since             1.0.0
 *
 */
if (!function_exists('theme_class')) {
    function theme_class($extra = "")
    {
        $default = "relative mx-auto max-w-6xl prose dark:prose-invert lg:px-4 sm:px-5 xs:px-5 px-4 xl:overflow-x-hidden";

        return "$default $extra";
    }
}


/**
 * The theme_asset function.
 *
 * @since             1.0.0
 *
 */
if (!function_exists('theme_asset')) {
    function theme_asset(string $path = "")
    {
        $path = substr($path, 0, 1) === "/" ? "$path" : "/$path";
        $path = substr(str_replace("//", "/", $path), 1);
        // Original function implementation
        if (file_exists(THEME_PATH . "public/$path")) {
            return THEME_URL . "public/$path";
        } else if (file_exists(THEME_PATH . "$path")) {
            return THEME_URL . "$path";
        } else {
            return $path;
        }
    }
}



/**
 * The get_the_slider_thumbnail_url function.
 *
 * @since             1.0.0
 *
 */
if (!function_exists('get_the_slider_thumbnail_url')) {
    function get_the_slider_thumbnail_url($term_id)
    {
        $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
        if ($thumbnail_id) {
            $image = wp_get_attachment_url($thumbnail_id);
        } else {
            // $image = public_url("img/placeholder.png");
            $image = "";
        }

        return $image;
    }
}
