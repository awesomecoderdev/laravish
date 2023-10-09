<?php

if (defined('ARTISAN_BINARY')) {
    return;
}

/**
 * Currently template version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your template and update it as you release new versions.
 */
define('LARAVEL_START', microtime(true));
define('THEME_VERSION', '1.0.0');
define('THEME_URL', trailingslashit(esc_url(get_template_directory_uri())));
define('THEME_PATH', trailingslashit(get_template_directory()));

// If this file is called directly, abort.
if (defined('WPINC')) require __DIR__."/theme.php";

// composer install --ignore-platform-reqs
