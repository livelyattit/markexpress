<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
    }

   public function getContentFile($authid, $location, $filename)
    {
        $dir_locations = [
            'JP7gRq00'=>'app/public/users_bills',
            'lL3MgYsS'=>'app/public/users_cnic'
        ];
        if(Auth::user()->role->name == 'customer'){
            if(Auth::user()->id == $authid){
                return response()->download(storage_path(/* 'app/public/' . */ $dir_locations[$location] . '/' .$filename), null, [], null);
            }
        }

        if(Auth::user()->role->name == 'admin'){
                return response()->download(storage_path(/*'app/public/' . */ $dir_locations[$location] . '/' .$filename), null, [], null);
        }

        return response('Error');

    }
}
