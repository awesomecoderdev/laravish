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

        $data = [
            'version' => app()->version(),
            'assets' => get_template_directory_uri(),
            'nav' => wp_get_nav_menu_items('Menü header#01: Die vier ersten'),
            'nav2' => wp_get_nav_menu_items('Menü footer#01: Die zwei letzten'),
            'posts' => $posts,
        ];

        return $this->view('wp.home', $data);
    }
}
