<?php

namespace App\Http\Controllers\Wp;

use App\Http\Controllers\Controller;

class Post extends Controller
{
    /**
     * Single constructor.
     */
    public function __construct()
    {
        if (!empty($GLOBALS['post'])) {
            setup_postdata($GLOBALS['post']);
            global $post;
            if ($post->post_type == "product") {
                $post->post_content .= "[add_to_cart id=$post->ID]";
            }
        }
    }

    public function index()
    {
        return $this->resolveView('wp.post');
    }
}
