<?php

namespace App\Http\Controllers\adminend;

use App\Http\Controllers\Controller;
use App\Rules\CnicNumber;
use App\Rules\PhoneNumber;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public  function createUser($inputs){

        $validator =  Validator::make($inputs, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', new PhoneNumber],
            'cnic' => ['required', new CnicNumber, 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'cnic.unique'=>'Cnic is already associated to some other account.'
            ]);

        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput($inputs);
        }

        $user =  User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'mobile' => $inputs['mobile'],
            'cnic' => $inputs['cnic'],
            'address'=>$inputs['address'],
            'role_id'=>3, // 3 is for customer for now
            'originality_verified'=> 0, // 0 means not verified by the admin
            'password' => Hash::make($inputs['password']),
        ]);

        return redirect()->route('admin-user', 'all')->with('success', '<strong>User '.$user->name.'</strong>  created successfully');

    }

    public function viewUser($id){
        $user_details = User::with('role', 'originality', 'accountDetail', 'personalData', 'parcel')->find($id);
        return view('admin_pages.users.user-view', [
            'user_details'=>$user_details
        ]);
    }

    public  function editUser($id, $form_name, $data){

        switch ($form_name){
            case 'basic_details':

            break;

            case 'personal_details':

            break;

            case 'business_details':

                break;
        }

    }

    public  function deleteUser($id){

    }


}
