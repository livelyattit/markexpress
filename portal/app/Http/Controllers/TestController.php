<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\Parcel;
use App\Test;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{

    public function __construct()
	{
		//$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->has('from') && $request->has('to')){

            $from = Carbon::createFromFormat('d-m-Y H:i:s', $request->get('from') . "00:00:00")->format('Y-m-d H:i:s');
            $to = Carbon::createFromFormat('d-m-Y H:i:s', $request->get('to'). "00:00:00")->format('Y-m-d H:i:s');

        echo $from;
        echo $to;
        }


        return;


        $response = Http::get('https://cod.callcourier.com.pk/api/CallCourier/GetTackingHistory?cn=03032-01-010607575');

        echo "<pre>";
        print_r($response->json());
        echo "</pre>";
        return '';

        $data = User::with(['originality','role'=>function($query){
            //  return $query->where('name', 'customer');
        }])->where('role_id', '=',3)->get();
        echo "<pre>";

        print_r($data->toArray());
        echo "</pre>";

        return base_path('../temp/');
       // $parcel = new Parcel();
       // echo $parcel->generateParcelNumber();

//        return  "general found true";

        //return env('APP_URL').'/storage';
        //return public_path('storage');
        return storage_path('app/public');
        return storage_path('app/public');
        return  base_path();
        if(File::isDirectory(base_path('users_bills'))){
            return base_path('users_bills\\' . 'filename');
        }

    }

    public function getUserRole(){
        if(Auth::check()){
            dd(Auth::user()->toArray());
        }
        return 0;
    }

    public function getFile($filename)
	{
		return response()->download(base_path('users_bills\\' . $filename), null, [], null);
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
