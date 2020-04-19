<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerController extends UserController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Dashboard';



        $user_details =    User::find(Auth::user()->id);
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

    public function fileUploadBill(Request $request){

        $user_details = Customer::find(Auth::user()->id);

        $image = $request->file('file_bill');
   
        $imageName = $user_details->cnic.'-'.$image->getClientOriginalName();
        $image->move(base_path('users_bills'),$imageName);
   
        return response()->json(['success'=>$imageName]);
        
    }

    public function fileUploadCnic(Request $request, Response $response){

        return $response->json(['data'=>$request->file('file_bill')]) ;
    }

    

}
