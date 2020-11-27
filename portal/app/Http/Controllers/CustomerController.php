<?php

namespace App\Http\Controllers;

use App\Accountdetail;
use App\City;
use App\Customer;
use App\Parcel;
use App\User;
use App\UserPersonalData;
use Carbon\Carbon;
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

    public function index()
    {

        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Dashboard';
        $cities = City::orderBy('city_name')->get();
        $banks = [
            'Al Baraka Bank (Pakistan) Limited.' => 'Al Baraka Bank (Pakistan) Limited.',
            'Allied Bank Limited.' => 'Allied Bank Limited.',
            'Askari Bank Limited.' => 'Askari Bank Limited.',
            'Bank Alfalah Limited.' => 'Bank Alfalah Limited.',
            'Bank Al-Habib Limited.' => 'Bank Al-Habib Limited.',
            'Bank Islami Pakistan Limited.' => 'Bank Islami Pakistan Limited.',
            'Al Baraka Bank (Pakistan) Limited.' => 'Al Baraka Bank (Pakistan) Limited.',
            'Burj Bank Limited.' => 'Burj Bank Limited.',
            'Citi Bank N.A.' => 'Citi Bank N.A.',
            'Deutsche Bank A.G.' => 'Deutsche Bank A.G.',
            'Faysal Bank Limited.' => 'Faysal Bank Limited.',
            'Habib Bank Limited.' => 'Habib Bank Limited.',
            'Habib Metropolitan Bank Limited.' => 'Habib Metropolitan Bank Limited.',
            'JS Bank Limited.' => 'JS Bank Limited.',
            'MCB Bank Limited.' => 'MCB Bank Limited.',
            'MCB Islamic Bank Limited.' => 'MCB Islamic Bank Limited.',
            'Meezan Bank Limited.' => 'Meezan Bank Limited.',
            'National Bank of Pakistan.' => 'National Bank of Pakistan.',
            'NIB Bank Limited.' => 'NIB Bank Limited.',
            'S.M.E. Bank Limited.' => 'S.M.E. Bank Limited.',
            'Samba Bank Limited.' => 'Samba Bank Limited.',
            'Silk Bank Limited.' => 'Silk Bank Limited.',
            'Sindh Bank Limited.' => 'Sindh Bank Limited.',
            'Soneri Bank Limited.' => 'Soneri Bank Limited.',
            'Standard Chartered Bank (Pakistan) Limited.' => 'Standard Chartered Bank (Pakistan) Limited.',
            'Summit Bank Limited.' => 'Summit Bank Limited.',
            'The Bank of Khyber.' => 'The Bank of Khyber.',
            'The Bank of Punjab.' => 'The Bank of Punjab.',
            'UBL - United Bank Limited.' => 'UBL - United Bank Limited.',
        ];
        $dashboard['count_today_bookings'] = Parcel::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->count();

        $dashboard['count_weekly_bookings'] = Parcel::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])->count();

        $dashboard['count_monthly_bookings'] = Parcel::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();


        $dashboard['weekly_bookings'] = Parcel::where('user_id', Auth::user()->id)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])
            ->orderBy('created_at', 'desc')
            ->get();


        $overall_parcels_data = [];

        $dashboard['parcels_created'] = Parcel::where('user_id', Auth::user()->id)->count();



        return view('pages.customer.dashboard', [
            'body_class' => $body_class,
            'page_title' => $page_title,
            'cities' => $cities,
            'banks' => $banks,
            'dashboard' =>$dashboard,
        ]);
    }

    public function proceedBusinessInformation(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'business_name' => 'required|string|max:190',
            'shipment_quantity' => 'required|numeric|min:1|max:100000',
            'bank_name' => 'required|string|max:99000',
            'bank_account_title' => 'required|string|max:190',
            'bank_account_number' => 'required|string|max:30',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $account_detail = Accountdetail::updateOrCreate([
            'user_id' => Auth::user()->id,
        ], [
            'business_name' => $input['business_name'],
            'shipment_quantity' => $input['shipment_quantity'],
            'bank_name' => $input['bank_name'],
            'bank_account_title' => $input['bank_account_title'],
            'bank_account_number' => $input['bank_account_number'],
        ]);

        $user = User::findOrFail(Auth::user()->id)->update([
            'originality_verified' => 2
        ]);

        return back()->with('success', 'All Information Saved Successfully!..');
    }

    public function editProfile()
    {

        return '<h1>Edit Profile Page</h1>';
    }

    public function fileUploadBill(Request $request)
    {

        $inputs = $request->all();
        $user_id = isset($inputs['user_id']) ? $inputs['user_id'] : Auth::user()->id;

        $user_details = Customer::find($user_id);

        $validator = Validator::make($inputs, [
            'file' => 'max:2000|mimes:jpeg,png,doc,docs,pdf',
        ]);
        if (!$validator->fails()) {
            // return response()->json(['data'=>'Error', 'message'=>$validator->errors()], 400);
            $image = $request->file('file');

            $imageName = $user_details->cnic . '-' . time() . '-' . $image->getClientOriginalName();
            UserPersonalData::updateOrCreate([
                'user_id' => $user_id,
            ], [
                'bill_file_name' => $imageName,
                'bill_request_confirmation' => 1
            ]);
            $image->move(storage_path('app/public/users_bills'), $imageName);

            return response()->json(['success' => $imageName]);
        }
    }

    public function fileUploadCnic(Request $request)
    {

        $inputs = $request->all();
        $user_id = isset($inputs['user_id']) ? $inputs['user_id'] : Auth::user()->id;

        $user_details = Customer::find($user_id);

        $validator = Validator::make($inputs, [
            'file' => 'max:2000|mimes:jpeg,png,doc,docs,pdf',
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => 'Error', 'message' => $validator->errors()], 400);
        }
        $image = $request->file('file');

        $imageName = $user_details->cnic . '-' . time() . '-' . $image->getClientOriginalName();
        $image->move(storage_path('app/public/users_cnic'), $imageName);
        UserPersonalData::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'cnic_file_name' => $imageName,
            'cnic_request_confirmation' => 1
        ]);
        return response()->json(['data' => $imageName]);
    }

    public function proceedVerification(Request $request)
    {


        $user_personal_data = UserPersonalData::where('user_id', Auth::user()->id)->first();
        $message = '';

        if ($user_personal_data != null) {

            if (
                $user_personal_data->bill_request_confirmation == 0
                || $user_personal_data->cnic_request_confirmation == 0
            ) {

                return redirect()->back()->with('error', 'Please upload your documents');
            } else {

                // return redirect()->back()->with('success', 'Documents are uploaded');

                $user = User::findOrFail(Auth::user()->id)->update([
                    'originality_verified' => 1
                ]);
                return redirect()->route('customer-dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Please upload your documents');
        }



        // return response()->json(['data'=>[
        //     'status'=>'success',
        //     'message'=>'Request forwarding for verification.. Please wait!',
        //     'redirect_url'=>route('customer-dashboard'),
        // ]], 200);
    }
}
