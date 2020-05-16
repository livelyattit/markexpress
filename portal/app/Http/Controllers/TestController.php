<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\Parcel;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
    public function index()
    {
        $parcel = new Parcel();
        echo $parcel->generateParcelNumber();

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
            return Auth::user()->role->name;
        }
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
