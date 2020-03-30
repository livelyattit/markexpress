<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the homepage.
     *
     * @return Renderable
     */
    public function index()
    {
        $body_class = 'page-home';
        $page_title = 'Home';
        return view('pages.home', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
        ]);
    }

    /**
     * Show the about page.
     *
     * @return Renderable
     */

    public function about()
    {
        $body_class = 'page-about';
        $page_title = 'About';
        return view('pages.about', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
        ]);
    }
}
