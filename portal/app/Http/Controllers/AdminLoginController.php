<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

class AdminLoginController extends LoginController
{
    public function username()
    {
        return 'email';
    }
    public function showLoginForm()
    {
        return view('admin_pages.login');
    }
}
