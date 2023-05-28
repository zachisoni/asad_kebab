<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function __construct(){
        
    }

    public function index(){
        $data['title'] = 'Asad kebab | Dashboard';
        return view('pages/dashboard/index', $data);
    }
}
