<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends UserController
{
    public function index(){

        return view('admin_pages.home');
    }
}
