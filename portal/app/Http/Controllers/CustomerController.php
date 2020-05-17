<?php

namespace App\Http\Controllers;

use App\Accountdetail;
use App\City;
use App\Customer;
use App\User;
use App\UserPersonalData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends UserController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Dashboard';
        $cities = City::orderBy('city_name')->get();

        $user_details = Customer::with('parcel', 'addressLog', 'role', 'personalData')->find(Auth::user()->id);
        return view('pages.customer.dashboard', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
            'user_details'=>$user_details,
            'cities'=>$cities,
            //'user_personal_data'=>$user_personal_data
        ]);

    }

    public function proceedBusinessInformation(Request $request){

        $input = $request->all();
        $validator = Validator::make($input,[
            'business_name'=>'required|string|max:190',
            'shipment_quantity'=>'required|numeric|min:1|max:100000',
            'bank_name'=>'required|string|max:99000',
            'bank_account_title'=>'required|string|max:190',
            'bank_account_number'=>'required|string|max:30',
        ] );
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $account_detail = Accountdetail::create([
            'user_id'=>Auth::user()->id,
            'business_name'=>$input['business_name'],
            'shipment_quantity'=>$input['shipment_quantity'],
            'bank_name'=>$input['bank_name'],
            'bank_account_title'=>$input['bank_account_title'],
            'bank_account_number'=>$input['bank_account_number'],

        ]);

        $user = User::findOrFail(Auth::user()->id)->update([
            'originality_verified'=>2
        ]);

        return back()->with('success', 'All Information Saved Successfully!..');
    }

    public function editProfile(){

        return '<h1>Edit Profile Page</h1>';
    }

    public function fileUploadBill(Request $request){

        $user_details = Customer::find(Auth::user()->id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'file'=> 'max:2000|mimes:jpeg,png,doc,docs,pdf',
        ]);
        if(!$validator->fails()){
           // return response()->json(['data'=>'Error', 'message'=>$validator->errors()], 400);
            $image = $request->file('file');

            $imageName = $user_details->cnic.'-'.$image->getClientOriginalName();
            UserPersonalData::updateOrCreate([
                'user_id'=>Auth::user()->id,
            ], [
                'bill_file_name'=>$imageName,
                'bill_request_confirmation'=>0
            ]);
            $image->move(storage_path('app/public/users_bills'),$imageName);

            return response()->json(['success'=>$imageName]);
        }


    }

    public function fileUploadCnic(Request $request){

        $user_details = Customer::find(Auth::user()->id);
        $input = $request->all();
        $validator = Validator::make($input, [
           'file'=> 'max:2000|mimes:jpeg,png,doc,docs,pdf',
        ]);
        if($validator->fails()){
            return response()->json(['data'=>'Error', 'message'=>$validator->errors()], 400);
        }
        $image = $request->file('file');

        $imageName = $user_details->cnic.'-'.$image->getClientOriginalName();
        $image->move(storage_path('app/public/users_cnic'),$imageName);
        UserPersonalData::updateOrCreate([
            'user_id'=>Auth::user()->id,
        ], [
            'cnic_file_name'=>$imageName,
            'cnic_request_confirmation'=>0
        ]);
        return response()->json(['data'=>$imageName]) ;
    }

    public function proceedVerification(Request $request){

        $user = User::findOrFail(Auth::user()->id)->update([
            'originality_verified'=>1
        ]);

        return response()->json(['data'=>[
            'status'=>'success',
            'message'=>'Request forwarding for verification.. Please wait!',
            'redirect_url'=>route('customer-dashboard'),
        ]], 200);
    }

}
