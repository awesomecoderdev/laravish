<?php

namespace App\Http\Controllers\Wp;

use App\Http\Controllers\Controller;
use App\Models\Wp\Post\Post;
class Page extends Controller
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        if (!empty($GLOBALS['post'])) {
            setup_postdata($GLOBALS['post']);
        }
    }

    public function index()
    {
        $queried=Post::queriedPosts();
        $post = $queried->get(0);
        $data = ["title"=>$post->wpPost->post_title, "content"=>$post->wpPost->post_content, 'assets' => get_template_directory_uri(),
            'nav' => wp_get_nav_menu_items('Menü header#01: Die vier ersten'),
            'nav2' => wp_get_nav_menu_items('Menü footer#01: Die zwei letzten')
        ];

        return $this->resolveView('wp.page', $data);
    }
}
