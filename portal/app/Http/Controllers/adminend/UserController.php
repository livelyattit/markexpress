<?php

namespace App\Http\Controllers\adminend;

use App\Accountdetail;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Rules\CnicNumber;
use App\Rules\PhoneNumber;
use App\User;
use App\UserPersonalData;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public  function allUsers(){
        $data = User::with(['originality','role'=>function($query){
          //  return $query->where('name', 'customer');
        }])->where('role_id', '=',3)->get();
        return DataTables::of($data)
            ->addColumn('created_on', function($data){
                return $data->created_at->format('d-F-Y') ;
            })
            ->addColumn('originality', function($data){

                return $data->originality->status;

            })
            ->addColumn('action', function($data){
                $button = '<a href="'.route('admin-user', ['view',$data->id ]).'"  class="p-1 btn-view-user btn btn-outline-warning btn-sm btn-icon full-width"><span class="material-icons">remove_red_eye</span></a>';
//                $button .= '<a href="'.route('admin-user', ['edit',$data->id ]).'"  class="p-1 mr-2 mb-2 btn-view-user btn btn-outline-info btn-sm btn-icon"><span class="material-icons">edit</span></a>';
//                $button .= '<a href="'.route('admin-user', ['delete', $data->id] ).'" class="p-1 mb-2 btn-delete-addresslog btn btn-outline-danger btn-sm btn-icon"><span class="material-icons">report_problem</span></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public  function createEditUser($inputs, $id = null, $form_name = null){

        //user edit
        $user = User::find($id);

        switch ($form_name){
            case 'basic_details':
                $validator =  Validator::make($inputs, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                    'mobile' => ['required', new PhoneNumber],
                    'cnic' => ['required', new CnicNumber, Rule::unique('users')->ignore($user->id)],
                    'password' => ['nullable', 'string', 'min:8'],
                ],
                    [
                        'cnic.unique'=>'Cnic is already associated to some other account.'
                    ]);

                if($validator->fails()){
                    return back()
                        ->withErrors($validator, 'basic_details')
                        ->withInput($inputs);
                }
                $user_updated = User::where('id', $id)
                    ->update([
                            'name' => isset($inputs['name']) ? $inputs['name'] :  NULL,
                            'email' => isset($inputs['email']) ? $inputs['email'] :  NULL,
                            'mobile' => isset($inputs['mobile']) ? $inputs['mobile'] :  NULL,
                            'cnic' => isset($inputs['cnic']) ? $inputs['cnic'] :  NULL,
                            'address'=> isset($inputs['address']) ? $inputs['address'] :  NULL,
                            'role_id'=>3, // 3 is for customer for now
                            'originality_verified'=> isset($inputs['originality_verified']) ? $inputs['originality_verified'] :  0,
                            'password' => !empty($inputs['password']) ?  Hash::make($inputs['password']) : $user->password ,
                        ]
                    );
                $user->refresh();
                return redirect()->route('admin-user', ['view',$user->id ])->with('success', '<strong>User '.$user->name.'</strong>  updated successfully');
            break;

            case 'personal_details':
                //
                break;

            case 'business_details':
                $validator = Validator::make($inputs,[
                    'business_name'=>'required|string|max:190',
                    'shipment_quantity'=>'required|numeric|min:1|max:100000',
                    'bank_name'=>'required|string|max:99000',
                    'bank_account_title'=>'required|string|max:190',
                    'bank_account_number'=>'required|string|max:30',
                ] );
                if($validator->fails()){
                    return back()
                        ->withErrors($validator, 'business_details')
                        ->withInput($inputs);
                }
                $user_updated = Accountdetail::where('user_id', $id)
                    ->updateOrCreate([
                        'user_id'=>$id
                        ]
                        ,[
                            'business_name'=>$inputs['business_name'],
                            'shipment_quantity'=>$inputs['shipment_quantity'],
                            'bank_name'=>$inputs['bank_name'],
                            'bank_account_title'=>$inputs['bank_account_title'],
                            'bank_account_number'=>$inputs['bank_account_number'],
                        ]
                    );
                $user->refresh();
                return redirect()->route('admin-user', ['view',$user->id ])->with('success', '<strong>User '.$user->name.'</strong>  updated successfully');
                break;
        }

        //user creation
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
        $pp= new User();
        $pp->refresh();
        $num = $pp->generateAccountCode();

        $user_created =  User::create([
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'account_code'=> $num,
            'mobile' => $inputs['mobile'],
            'cnic' => $inputs['cnic'],
            'address'=>$inputs['address'],
            'role_id'=>3, // 3 is for customer for now
            'originality_verified'=> 0, // 0 means not verified by the admin
            'password' => Hash::make($inputs['password']),
        ]);

        return redirect()->route('admin-user', ['view',$user_created->id ])->with('success', '<strong>User '.$user_created->name.'</strong>  created successfully');

    }

    public function viewUser($id){
        $user_details = User::with('role', 'originality', 'accountDetail', 'personalData', 'parcel')->find($id);
        return view('admin_pages.users.user-view', [
            'user_details'=>$user_details
        ]);
    }

    public  function editUser($id, $form_name, $data){



    }

    public  function deleteUser($id){

        User::destroy($id);
        return response()->json(['data'=>'success']);

    }


}
