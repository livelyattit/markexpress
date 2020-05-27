<?php

namespace App\Http\Controllers\adminend;

use App\Accountdetail;
use App\Http\Controllers\Controller;
use App\Parcel;
use App\Rules\CnicNumber;
use App\Rules\PhoneNumber;
use App\Status;
use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;

class ParcelController extends Controller
{
    public  function allParcels(){
            //$data = Addresslog::where('user_id', Auth::user()->id)->get();
            $data = Parcel::with( 'user','status');
            return DataTables::of($data)

                ->addColumn('shipment_created',  function($data){
                    return $data->created_at ? with(new Carbon($data->created_at))->format('Y-m-d') : '';
                })
                ->addColumn('parcel_no', function($data){
                    return  $data->assigned_parcel_number;
                })
                ->addColumn('current_status', function($data){
                    $dd  = $data->status()->latest('parcel_status.updated_at')->first();
                    return empty($dd) ? 'No data' : $dd->status;

                })
                ->addColumn('parcel_status_change', function($data){
                    $statuses = Status::all();
                    $select = '<select id="parcel-status-change" class="form-control">';
                    $select .='<option style="display: none" value="">Change Status</option>';
                    foreach ($statuses as $status){
                        $select .='<option value="'.$status->id.'" data-url="'.route('admin-parcel', ['edit', $data->id, 'parcel_status' ]).'" data-text="'.strtoupper($status->status).'" >' .$status->status. '</option>';
                    }
                    $select .= '</select>';
                    return $select  ;

                })
                /*->addColumn('consignee_alias', function($data){
                    $data_decoded = json_decode($data->binded_addresslog, true);
                    return $data_decoded['addresslog_info']['consignee_alias'] ;
                })
                ->addColumn('consignee_city',  function($data){
                    $data_decoded = json_decode($data->binded_addresslog, true);
                    //return $data_decoded['addresslog_info']['consignee_address'] ;
                    return $data_decoded['city']['city_name'] ;
                })
                ->addColumn('cod_amount',  function($data){

                    return "PKR " .  number_format($data->amount, 1, '.', ',');
                })
                ->addColumn('delivery_charges',  function($data){
                    $charges = 250;
                    return "PKR " .  number_format($charges, 1, '.', ',');
                })*/
                ->addColumn('view', function($data){
                    $button = '<a href="'.route('admin-parcel', ['view',$data->id ]).'" class="p-1 btn-view-user btn btn-outline-warning btn-sm btn-icon full-width"><span class="material-icons">remove_red_eye</span></a>';
                    return $button;
                })
                ->rawColumns(['view', 'parcel_status_change'])
                ->make(true);


    }

    public  function createEditParcel($inputs, $id = null, $form_name = null){

        //user edit
        $parcel = Parcel::find($id);

        switch ($form_name){
            case 'parcel_status':
                $parcel->status()->attach($inputs['status']);
                $parcel->refresh();
                return response()->json(['data'=>$parcel->toArray()]);
                break;

            case 'personal_details':
                //
                break;

            case 'business_details':

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

    public function viewParcel($id){
        $parcel_details = Parcel::with('user', 'status')->find($id);
        return view('admin_pages.parcels.parcel-view', [
            'parcel_details'=>$parcel_details
        ]);
    }

    public  function deleteParcel($id){

        User::destroy($id);
        return response()->json(['data'=>'success']);

    }
}
