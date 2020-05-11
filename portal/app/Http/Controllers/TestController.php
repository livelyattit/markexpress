<?php

namespace App\Http\Controllers;

use App\Addresslog;
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
        $value = 'new alias bb';
        $id = 4;
        $addresslogs = Addresslog::where('user_id', Auth::user()->id)->get();
        $addresslog_where = Addresslog::find($id)->first();
        if($addresslog_where){
            if($addresslog_where->consignee_alias  == $value){
                return "where found true";
            }
        } else{
            foreach ($addresslogs as $addresslog)
            {

                echo $addresslog->id . "<br>";
                if($addresslog->consignee_alias == $value){
                    return "general found false";
                }
            }
        }


        return  "general found true";

        //return env('APP_URL').'/storage';
        //return public_path('storage');
        return storage_path('app/public');
        return storage_path('app/public');
        return  base_path();
        if(File::isDirectory(base_path('users_bills'))){
            return base_path('users_bills\\' . 'filename');
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
