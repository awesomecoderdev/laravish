<?php

namespace App\Http\Controllers\Wp;

use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        $posts = new \WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 3,
            // 'posts_per_page'    => -1, // Set to -1 to get all posts
            // 'order_by'          => "name",
            // 'order'             => "ASC"
            // 'tax_query' => [
            //     [
            //         'taxonomy' => 'category',
            //         'field' => 'id',
            //         'terms' => $category->term_id
            //     ]
            // ]
        ]);

        $pages = new \WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 5,
            // 'posts_per_page'    => -1, // Set to -1 to get all posts
            // 'order_by'          => "name",
            // 'order'             => "ASC"
            // 'tax_query' => [
            //     [
            //         'taxonomy' => 'category',
            //         'field' => 'id',
            //         'terms' => $category->term_id
            //     ]
            // ]
        ]);


        // $sliders = new \WP_Query([
        //     'post_type' => 'post',
        //     'posts_per_page' => 5,
        //     // 'posts_per_page'    => -1, // Set to -1 to get all posts
        //     // 'order_by'          => "name",
        //     // 'order'             => "ASC"
        //     'meta_key' => '_slider',
        //     // 'orderby' => 'meta_value_num',
        //     // 'order' => 'ASC',
        //     'meta_query' => [
        //         [
        //             'key' => '_slider',
        //             'value' => "on",
        //         ],
        //     ],
        // ]);

        $sliders = new \WP_Term_Query([
            'taxonomy'      => 'slider', // Taxonomy for product categories
            'title_li'      => '', // Remove the default title
            'orderby'       => 'count', // Order by the number of products
            'order'         => 'DESC',  // Descending order (most products first)
            // 'child_of'      => 0,
            // 'parent'        => 0,
            'fields'        => 'all',
            'hide_empty'    => false,
            'number'        => 4,
        ]);
        // $terms = get_terms($args);
        $sliders = $sliders->terms;
        // $terms = $categories;
        global $post;
        // dd($sliders);
        $data = [
            'version' => app()->version(),
            'assets' => get_template_directory_uri(),
            'nav' => wp_get_nav_menu_items('Menü header#01: Die vier ersten'),
            'nav2' => wp_get_nav_menu_items('Menü footer#01: Die zwei letzten'),
            'posts' => $posts,
            'post' => $post,
            'pages' => $pages,
            'sliders' => $sliders
        ];

        // dd($post);

        return $this->view('wp.home', $data);
    }
}
