<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\City;
use App\Parcel;
use App\Rules\ConsigneeAliasRule;
use App\Rules\PhoneNumber;
use App\DataTables\AddressLog as DAddressLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Symfony\Component\Console\Input\Input;

class AddresslogController extends Controller
{
    /**
     * Display a listing of the resource.
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            //$data = Addresslog::where('user_id', Auth::user()->id)->get();
            $data = Addresslog::with('city', 'user')->where('user_id', Auth::user()->id)
                ->where('created_by', '=', 'is_customer');
            return DataTables::of($data)
//                ->addColumn('city_delivery', function($data){
//                    return $data->city->city_name . ' (' . $data->city->delivery_time . ')' ;
//                })
                ->addColumn('edit', function($data){
                    $button = '<button type="button" name="edit" data-addresslog-id="'.$data->id.'" class="btn-edit-addresslog btn btn-outline-warning btn-sm">Edit</button>';
                    return $button;
                })
                ->addColumn('delete', function($data){
                    $button = '<button type="button" name="delete" data-addresslog-id="'.$data->id.'" data-addresslog-alias="'.$data->consignee_alias.'" class="btn-delete-addresslog btn btn-outline-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['edit', 'delete'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $body_class = 'page-dashboard page-dashboard-customer';
        $page_title = 'Address Log';

        $user_details = User::with('parcel.status', 'role', 'personalData')->find(Auth::user()->id)->first();
            $cities = City::orderBy('city_name')->get();
        return view('pages.customer.addresslog-create', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
            'user_details'=>$user_details,
            'cities'=>$cities,

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
            //'consignee_alias'=>'required|unique:addresslogs,consignee_alias,NULL,id,user_id,'. Auth::user()->id,
            'consignee_name'=>'required|max:190',
            'consignee_number'=>['required', 'unique:addresslogs,consignee_contact,NULL,id,user_id,' . Auth::user()->id, new PhoneNumber()],
            'consignee_city'=>'required|not_in:0',
            'consignee_address'=>'required|max:100',
            'consignee_nearby_address'=>'max:100',
            'cod_amount'=>'required|numeric|min:100|max:9900000',
            'weight'=>'sometimes|nullable|numeric|min:1|max:50',
        ], [
           // 'consignee_alias.unique'=>'Alias already taken in your address log.',
        ] );
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput($input);
        }

        $address_log = Addresslog::create([
            'user_id'=>Auth::user()->id,
            'city_id'=>$input['consignee_city'],
            'consignee_alias'=>'no_concerned_for_now',
            'consignee_name'=>$input['consignee_name'],
            'consignee_contact'=>$input['consignee_number'],
            'consignee_address'=>$input['consignee_address'],
            'consignee_nearby_address'=>$input['consignee_nearby_address'],
            'created_by'=>'is_customer',
        ]);


        $parcel = Parcel::create([
            'user_id'=>Auth::user()->id,
            'assigned_parcel_number'=>null,
            'city_id'=>$address_log->city_id,
            'consignee_name'=>$address_log->consignee_name,
            'consignee_contact'=>$address_log->consignee_contact,
            'consignee_address'=>$address_log->consignee_address,
            'consignee_nearby_address'=>$address_log->consignee_nearby_address,
            'current_last_status'=>'shipment created',
            'amount'=>$input['cod_amount'],
            't_basic_charges'=>$address_log->city->initial_weight_price,
            't_booking_charges'=>null,
            't_cash_handling_charges'=>null, //null for now .. will change to charge 1% for exceeding cod_amount >= 5000
            't_packing_charges'=>null,
            'weight'=>$input['weight'],
            'length'=>$input['length'],
            'height'=>$input['height'],
            'assigned_tracking_number'=>null,
        ]);
        $parcel->status()->attach(1);

        $parcel_number = 1000 + $parcel->id;
        $parcel->assigned_parcel_number = $parcel_number;
        $parcel->save();


        return back()->with('success', 'Consignee <strong>'.$address_log->consignee_name.'</strong> has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //dd($id);
        if($request->ajax()){
            $addresslog = Addresslog::with('city')->where('id', $id)->firstOrFail();
            $cities = City::orderBy('city_name')->get();

                return view('includes.popup-edit-address-log-content',[
                    'addresslog'=>$addresslog,
                    'cities'=>$cities,
                ]);


        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function edit(Addresslog $addresslog)
    {
        return $addresslog->consignee_alias;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addresslog $addresslog)
    {
      //  $request->request->add(['consignee_alias_old'=>$request->input('consignee_alias')]);
        $input = $request->all();
        $addresslog_id = $input['addresslog_id'];

        $validator = Validator::make($input,[
            //'consignee_alias'=>['required', new ConsigneeAliasRule($addresslog_id)],
            'consignee_name'=>'required|max:190',
            'consignee_number'=>['required', 'unique:addresslogs,consignee_contact,NULL,id,user_id,' . Auth::user()->id, new PhoneNumber()],
            'consignee_city'=>'required|not_in:0',
            'consignee_address'=>'required|max:100',
            'consignee_nearby_address'=>'max:100',
        ], [
            'consignee_alias.unique'=>'Alias already taken in your address log.',
        ] );
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
                'message'=>'Validation error',
                'errors'=>$validator->errors(),
                'inputs'=>$input,
            ], 400) ;
        }


        $address_log = Addresslog::find($addresslog_id)->update([
            'user_id'=>Auth::user()->id,
            'city_id'=>$input['consignee_city'],
            //'consignee_alias'=>$input['consignee_alias'],
            'consignee_name'=>$input['consignee_name'],
            'consignee_contact'=>$input['consignee_number'],
            'consignee_address'=>$input['consignee_address'],
            'consignee_nearby_address'=>$input['consignee_nearby_address'],
        ]);

        return response()->json([
            'status'=>'success'
        ], 200) ;
       // return back()->with('success', 'Address has been made successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addresslog = Addresslog::findOrFail($id);

        if($addresslog->delete()){
            return response()->json(['data'=>'success'], 200);
        }

        return response()->json(['data'=>'error'], 400);
    }
}
