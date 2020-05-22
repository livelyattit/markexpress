<?php

namespace App\Http\Controllers\adminend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public  function allUsers(){
        $data = User::with(['originality','role'=>function($query){
            return $query->where('name', 'customer');
        }])->get();
        return DataTables::of($data)
            ->addColumn('created_on', function($data){
                return $data->created_at->format('d-F-Y') ;
            })
            ->addColumn('action', function($data){
                $button = '<a href="'.route('admin-user', ['view',$data->id ]).'"  class="p-1 mr-2 mb-2 btn-view-user btn btn-outline-warning btn-sm btn-icon"><span class="material-icons">remove_red_eye</span></a>';
                $button .= '<a href="'.route('admin-user', ['edit',$data->id ]).'"  class="p-1 mr-2 mb-2 btn-view-user btn btn-outline-info btn-sm btn-icon"><span class="material-icons">edit</span></a>';
                $button .= '<a href="'.route('admin-user', ['delete', $data->id] ).'" class="p-1 mb-2 btn-delete-addresslog btn btn-outline-danger btn-sm btn-icon"><span class="material-icons">report_problem</span></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public  function createUser($data){

    }

    public  function editUser($id, $data){

    }

    public  function deleteUser($id){

    }


}
