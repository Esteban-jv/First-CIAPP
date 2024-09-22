<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        /*return view('header', ['title' => 'Home']) // this way is more common
            .view('Home/index');*/
        return view('Home/index');
    }
}
