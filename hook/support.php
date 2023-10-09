<?php


/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
add_action('admin_menu', 'mlh_register_admin_menu');
if(!function_exists("mlh_register_admin_menu")){
    function mlh_register_admin_menu() {
        add_menu_page(
            'Manage FAS-IDs',
            'Found&Scan',
            'edit_posts',
            'tags',
            'mlh_register_admin_menu_callback',
            'dashicons-media-spreadsheet'
        );
        add_submenu_page( 'tags', 'Users', 'Found&Scan Users','manage_options', '../nutzer');
    }
}
// mlh_register_admin_menu callback
if(!function_exists("mlh_register_admin_menu_callback")){
    function mlh_register_admin_menu_callback() {
        wp_redirect(get_home_url( )."/tags");
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
 * Register custom class for nav items.
 *
 * @since    1.0.0
 */
function add_class_on_nav_menu_list_items($classes, $item, $args)
{
    $classes[] = strtolower($item->title);

    if (!in_array('current-menu-item', $classes)) {
        if (in_array('current_page_item', $classes)) {
            $classes[] = 'text-primary-500 dark:text-white';
        }
    } else {
        $classes[] = 'text-primary-500 dark:text-white';
    }

    return $classes;
}

add_filter("nav_menu_css_class", "add_class_on_nav_menu_list_items", 10, 3);

/**
 * Register custom class for nav links.
 *
 * @since    1.0.0
 */
function add_class_on_nav_menu_list_items_link($classes, $item, $args)
{
    if ('primary' === $args?->theme_location || is_null($args?->theme_location)) {
        $class =  "relative flex justify-center text-sm font-semibold uppercase items-center $args?->theme_location ";
        $classes["class"] = isset($args->has_children) ? "text-sm lending-5 $class" : "$class";
    }
    return $classes;
}
add_filter("nav_menu_link_attributes", "add_class_on_nav_menu_list_items_link", 10, 3);

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