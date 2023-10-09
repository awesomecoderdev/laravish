<?php

namespace App\Http\Controllers\Wp;

use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        $data = [
            'version' => app()->version(),
            'assets' => get_template_directory_uri(),
            'nav' => wp_get_nav_menu_items('Menü header#01: Die vier ersten'),
            'nav2' => wp_get_nav_menu_items('Menü footer#01: Die zwei letzten')
        ];

        return $this->view('wp.home', $data);
    }
}
