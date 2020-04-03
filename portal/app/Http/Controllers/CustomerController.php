<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends UserController
{

    public function index(){

        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Dashboard';
        return view('pages.customer.dashboard', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
        ]);

    }

    public function createParcel(){

        return '<h1>Create Parcel Page</h1>';
    }

    public function editProfile(){

        return '<h1>Edit Profile Page</h1>';
    }

}
