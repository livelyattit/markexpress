<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\City;
use App\User;
use App\Parcel;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Create Parcel';

        $user_details = User::with('addressLog')->find(Auth::user()->id);
        return view('pages.customer.parcel-create', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
            'user_details'=>$user_details,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'addresslog_id'=>'required|exists:addresslogs,id,user_id,'. Auth::user()->id,
            'weight'=>'sometimes|nullable|numeric|min:1|max:50',
            'length'=>'sometimes|nullable|numeric|min:1|max:150',
            'width'=>'sometimes|nullable|numeric|min:1|max:150',
            'height'=>'sometimes|nullable|numeric|min:1|max:150',
            'cod_amount'=>'required|numeric|min:100|max:99000',
        ] );
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $parcel = Parcel::create([
            'user_id'=>Auth::user()->id,
            'addresslog_id'=>$input['addresslog_id'],
            'assigned_parcel_number'=>null,
            'amount'=>$input['cod_amount'],
            'weight'=>$input['weight'],
            'length'=>$input['length'],
            'height'=>$input['height'],
            'assigned_tracking_number'=>null,
        ]);
        $parcel_number = 1000 + $parcel->id;
        $parcel->assigned_parcel_number = $parcel_number;
        $parcel->save();

        return back()->with('success', '<strong>ME Parcel # '.$parcel->assigned_parcel_number.'</strong>  created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parcel $parcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parcel $parcel)
    {
        //
    }

    public function getConsignee(Request $request){
        $input = $request->all();
        $addresslog = Addresslog::with('city')->find($input['consignee_id']);

        return response()->view('pages.customer.components.get-consignee', [
            'addresslog'=>$addresslog,
            'input'=> $input,
        ]);
    }
}
