<?php


/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
add_action('admin_menu', 'mlh_register_admin_menu');
if (!function_exists("mlh_register_admin_menu")) {
    function mlh_register_admin_menu()
    {
        add_menu_page(
            'Manage FAS-IDs',
            'Found&Scan',
            'edit_posts',
            'tags',
            'mlh_register_admin_menu_callback',
            'dashicons-media-spreadsheet'
        );
        add_submenu_page('tags', 'Users', 'Found&Scan Users', 'manage_options', '../nutzer');
    }
}
// mlh_register_admin_menu callback
if (!function_exists("mlh_register_admin_menu_callback")) {
    function mlh_register_admin_menu_callback()
    {
        wp_redirect(get_home_url() . "/tags");
        die();
    }
}

/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
register_nav_menus(array(
    'primary' => __('Primary Menu'),
));

/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
register_nav_menus(array(
    'right' => __('Right Menu'),
));



/**
 * ======================================================================================
 * 		Theme Support Functions
 * ======================================================================================
 */

/**
 * Register dynamic title.
 *
 * @since    1.0.0
 */
add_theme_support('title-tag');

/**
 * Register the thumbnail theme support for the admin area.
 *
 * @since    1.0.0
 */
add_theme_support("post-thumbnail");

/**
 * Register the background theme support for the admin area.
 *
 * @since    1.0.0
 */
// add_theme_support("custom-background");


/**
 * Register the header theme support for the admin area.
 *
 * @since    1.0.0
 */
// add_theme_support("custom-header");

/**
 * Register the sidebar theme support for the admin area.
 *
 * @since    1.0.0
 */
add_action('widgets_init', 'mlh_sidebar');
if (!function_exists("mlh_sidebar")) {
    function mlh_sidebar()
    {
        register_sidebar(array(
            'name'          => __('MLH Sidebar'),
            'id'            => 'mlh_sidebar',
            'description'   => 'Widgets in this area will be shown on all posts and pages.',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ));
    }
}
