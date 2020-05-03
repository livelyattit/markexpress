<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public static function getUserDetails($user_id){

      $result =  User::with('parcel.status', 'role', 'personalData')->find($user_id)->first();

      return $result;
    }
}
