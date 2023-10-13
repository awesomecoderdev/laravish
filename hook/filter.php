<?php

/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
add_filter("body_class", "mlh_body_class", 99999);
if (!function_exists("mlh_body_class")) {
    function mlh_body_class($classes)
    {
        $include = array(
            // browsers/devices (https://codex.wordpress.org/Global_Variables)
            'is-iphone'            => $GLOBALS['is_iphone'],
            'is-chrome'            => $GLOBALS['is_chrome'],
            'is-safari'            => $GLOBALS['is_safari'],
            'is-ns4'               => $GLOBALS['is_NS4'],
            'is-opera'             => $GLOBALS['is_opera'],
            'is-mac-ie'            => $GLOBALS['is_macIE'],
            'is-win-ie'            => $GLOBALS['is_winIE'],
            'is-gecko'             => $GLOBALS['is_gecko'],
            'is-lynx'              => $GLOBALS['is_lynx'],
            'is-ie'                => $GLOBALS['is_IE'],
            'is-edge'              => $GLOBALS['is_edge'],
            // WP Query (already included by default, but nice to have same format)
            'is-archive'           => is_archive(),
            'is-post_type_archive' => is_post_type_archive(),
            'is-attachment'        => is_attachment(),
            'is-author'            => is_author(),
            'is-category'          => is_category(),
            'is-tag'               => is_tag(),
            'is-tax'               => is_tax(),
            'is-date'              => is_date(),
            'is-day'               => is_day(),
            'is-feed'              => is_feed(),
            'is-comment-feed'      => is_comment_feed(),
            'is-front-page'        => is_front_page(),
            'is-home'              => is_home(),
            'is-privacy-policy'    => is_privacy_policy(),
            'is-month'             => is_month(),
            'is-page'              => is_page(),
            'is-paged'             => is_paged(),
            'is-preview'           => is_preview(),
            'is-robots'            => is_robots(),
            'is-search'            => is_search(),
            'is-single'            => is_single(),
            'is-singular'          => is_singular(),
            'is-time'              => is_time(),
            'is-trackback'         => is_trackback(),
            'is-year'              => is_year(),
            'is-404'               => is_404(),
            'is-embed'             => is_embed(),
            // Mobile
            'is-mobile'            => wp_is_mobile(),
            'is-tablet'            => wp_is_tablet(),
            'is-desktop'            => !wp_is_mobile(),
            // Common
            'has-blocks'           => function_exists('has_blocks') && has_blocks(),
            'has-adminbar'          => function_exists('is_admin_bar_showing') && is_admin_bar_showing(),
        );

        // Sidebars
        foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
            $include["is-sidebar-{$sidebar['id']}"] = is_active_sidebar($sidebar['id']);
        }

        // Add classes
        foreach ($include as $class => $do_include) {
            if ($do_include) $classes[$class] = $class;
        }

        // custom css
        $classes[] = implode("-page ", url_scheme());


        return $classes;
    }
}

/**
 * Register the nav menu for the admin area.
 *
 * @since    1.0.0
 */
add_filter('dynamic_sidebar_params', 'add_odd_even_classes_to_widget');
if (!function_exists("add_odd_even_classes_to_widget")) {
    function add_odd_even_classes_to_widget($params)
    {
        global $my_widget_num;
        if (!isset($my_widget_num)) {
            $my_widget_num = 1;
        } else {
            $my_widget_num++;
        }

        if ($my_widget_num % 2 == 0) {
            $params[0]['before_widget'] = str_replace('class="', 'class="even ', $params[0]['before_widget']);
        } else {
            $params[0]['before_widget'] = str_replace('class="', 'class="odd ', $params[0]['before_widget']);
        }
        return $params;
    }
}


/**
 * Register custom class for nav items.
 *
 * @since    1.0.0
 */
add_filter("nav_menu_css_class", "add_class_on_nav_menu_list_items", 10, 3);
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


/**
 * Register custom class for nav links.
 *
 * @since    1.0.0
 */
add_filter("nav_menu_link_attributes", "add_class_on_nav_menu_list_items_link", 10, 3);
function add_class_on_nav_menu_list_items_link($classes, $item, $args)
{
    if ('primary' === $args?->theme_location || is_null($args?->theme_location)) {
        $class =  "relative lg:flex lg:justify-center text-sm font-semibold uppercase items-center text-zinc-900 location-$args?->theme_location ";
        $classes["class"] = isset($args->has_children) ? "text-sm lending-5 $class" : "$class";
    } else {
        $classes["class"] = "location-$args?->theme_location";
    }
    return $classes;
}
