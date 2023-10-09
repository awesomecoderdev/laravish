<?php

namespace App\Http\Controllers\Wp\Page;

use App\Http\Controllers\Controller;

class Temp extends Controller
{
    public function index()
    {
        $data = [
            'version' => app()->version(),
        ];
        return $this->view('wp.temp', $data);
    }
}
