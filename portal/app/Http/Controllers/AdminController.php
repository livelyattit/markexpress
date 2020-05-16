<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends UserController
{
    public function index(){
        return view('admin_pages.dashboard');
    }
    public function users(){

        return view('admin_pages.users');
    }

    public function createUser(){

        return view('admin_pages.user-create');
    }
}
