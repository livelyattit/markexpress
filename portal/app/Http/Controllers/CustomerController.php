<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomerController extends UserController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Dashboard';



        $user_details =    User::find(4);
       // dd($user_details->role->role);
        return view('pages.customer.dashboard', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
            'user_details'=>$user_details
        ]);

    }

    public function createParcel(){

        return '<h1>Create Parcel Page</h1>';
    }

    public function editProfile(){

        return '<h1>Edit Profile Page</h1>';
    }

}
