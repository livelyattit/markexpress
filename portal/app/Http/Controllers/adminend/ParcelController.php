<?php

namespace App\Http\Controllers\adminend;

use App\Accountdetail;
use App\Addresslog;
use App\Http\Controllers\Controller;
use App\Parcel;
use App\Rules\CnicNumber;
use App\Rules\PhoneNumber;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;

class ParcelController extends Controller
{
    public  function allParcels($request){
            //$data = Addresslog::where('user_id', Auth::user()->id)->get();
            $data = Parcel::with( 'user','status');

            // foreach($data->status as $st){
            //     echo $st->status;
            // }
            // $statuses = Status::all();
            // foreach ($statuses as $status){
            //     echo $status->status;
            // }
            //dd($statuses);

            return DataTables::of($data)

            // ->editColumn('created_at', function ($user) {
            //     return $user->created_at ? with(new Carbon($user->created_at))->format('d-m-Y') : '';
            // })
            // ->filterColumn('created_at', function ($query, $keyword) {


            //     // if(preg_match("/november/i", $keyword))
            //     // {
            //     //     $keyword = 11;
            //     // }

            //     // if(preg_match("/december/i", $keyword))
            //     // {
            //     //     $keyword = 12;
            //     // }

            //     // Log::info($keyword);
            //     $query
            //         //->select("MONTHNAME(STR_TO_DATE(".$keyword.", '%m')")
            //         ->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
            // })
                ->addColumn('parcel_status_change', function($data){
                    $statuses = Status::all();
                    $select = '<label class="d-flex">Change Status</label><select class="parcel-status-change form-control">';
                    //$select .='<option style="display: none" value="">Change Status</option>';
                    $dd  = $data->status()->latest('parcel_status.created_at')->first();
                    $selected = '';
                    $disabled = '';
                    foreach ($statuses as $status){
                        if($status->status == $dd->status){
                            $selected = 'selected';
                        }
                        $select .='<option '.$selected.' value="'.$status->id.'" data-url="'.route('admin-parcel', ['edit', $data->id, 'parcel_status' ]).'" data-text="'.$status->status.'" >' .$status->status. '</option>';
                        $selected = '';
                    }
                    $select .= '</select>';


                    return $select  ;

                })

                ->addColumn('view', function($data){
                    $button = '<a href="'.route('admin-parcel', ['view',$data->id ]).'" class="p-1 btn-view-user btn btn-outline-warning btn-sm btn-icon full-width"><span class="material-icons">remove_red_eye</span></a>';
                    return $button;
                })

                ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('d-m-Y') : '';
                })

                ->filter(function ($query) use ($request) {
                    if ($request->get('from') && $request->get('to')) {

                        $from = Carbon::createFromFormat('d-m-Y H:i:s', $request->get('from') . "00:00:00")->format('Y-m-d H:i:s');
                        $to = Carbon::createFromFormat('d-m-Y H:i:s', $request->get('to'). "23:59:59")->format('Y-m-d H:i:s');

                        //$from = $request->get('from');
                        //$to = $request->get('to');

                        //$query->where('consignee_name', '=', 'kashif raees');

                         $query->whereBetween('created_at', [$from, $to]);
                    }


                }, true)
                ->rawColumns(['view', 'parcel_status_change'])
                ->make(true);


    }

    public  function createEditParcel($inputs, $id = null, $form_name = null){

        //parcel edit
        if($id != null){
            $parcel = Parcel::find($id);
        }

        switch ($form_name){
            case 'parcel_status': //edit
                $parcel->status()->attach($inputs['status']);
                $parcel->current_last_status = $inputs['text'];
                $parcel->save();
                $parcel->refresh();
                return response()->json(['data'=>$parcel->toArray()]);
                break;

            case 'parcel_details':

                //addresslog update
                $validator = Validator::make($inputs,[
                    'user_account'=>'required|exists:App\User,id',
                    //'consignee_alias'=>'required|unique:addresslogs,consignee_alias,NULL,id,user_id,'. Auth::user()->id,
                    'consignee_name'=>'required|max:190',
                    'consignee_number'=>['required', new PhoneNumber()],
                    'consignee_city'=>'required|not_in:0',
                    'consignee_address'=>'required|max:100',
                    'consignee_nearby_address'=>'max:100',

                    //'addresslog_id'=>'required|exists:addresslogs,id,user_id,'. Auth::user()->id,
                    'weight'=>'sometimes|nullable|numeric|min:1|max:50',
                    'length'=>'sometimes|nullable|numeric|min:1|max:150',
                    'width'=>'sometimes|nullable|numeric|min:1|max:150',
                    'height'=>'sometimes|nullable|numeric|min:1|max:150',
                    'cod_amount'=>'required|numeric|min:100|max:9900000',
                    't_basic_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
                    't_booking_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
                    't_cash_handling_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
                    't_packing_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
                ], [
                    'consignee_alias.unique'=>'Alias already taken in your address log.',
                ] );
                if($validator->fails()){
                    return back()
                        ->withErrors($validator)
                        ->withInput($inputs);
                }

                dd($inputs);

                $address_log = Addresslog::where('id', $inputs['user_account'])
                ->update([
                    'user_id'=>$inputs['user_account'],
                    'city_id'=>$inputs['consignee_city'],
                    'consignee_alias'=>$inputs['consignee_alias'],
                    'consignee_name'=>$inputs['consignee_name'],
                    'consignee_contact'=>$inputs['consignee_number'],
                    'consignee_address'=>$inputs['consignee_address'],
                    'consignee_nearby_address'=>$inputs['consignee_nearby_address'],
                    'created_by'=>'is_admin'
                ]);

                $binded_address = Addresslog::find($address_log->id)->toArray();
                $binded_city = Addresslog::find($address_log->id)->city->toArray();

                $ff = [
                    'addresslog_info'=>$binded_address,
                    'city'=>$binded_city,
                ];

                $parcel = Parcel::create([
                    'user_id'=>$inputs['user_account'],
                    'addresslog_id'=>$address_log->id,
                    'assigned_parcel_number'=>null,
                    'binded_addresslog'=>json_encode($ff),
                    'current_last_status'=>'shipment created',
                    'amount'=>$inputs['cod_amount'],
                    //'t_basic_charges'=>$binded_city['initial_weight_price'],
                    't_basic_charges'=>$inputs['t_basic_charges'],
                    't_booking_charges'=>$inputs['t_booking_charges'],
                    't_cash_handling_charges'=>$inputs['t_cash_handling_charges'],
                    't_packing_charges'=>$inputs['t_packing_charges'],
                    'weight'=>$inputs['weight'],
                    'length'=>$inputs['length'],
                    'height'=>$inputs['height'],
                    'assigned_tracking_number'=>null,
                ]);
                $parcel->status()->attach(1);
                $parcel->save();

                $parcel->refresh();

                return redirect()->route('admin-parcel', ['view',$parcel->id ])->with('success', '<strong>Parcel# '.$parcel->assigned_parcel_number.'</strong>  edited successfully');

                break;

        }

        //parcel creation
        $validator = Validator::make($inputs,[
            'user_account'=>'required|exists:App\User,id',
            //'consignee_alias'=>'required|unique:addresslogs,consignee_alias,NULL,id,user_id,'. Auth::user()->id,
            'consignee_name'=>'required|max:190',
            'consignee_contact'=>['required', new PhoneNumber()],
            'consignee_city'=>'required|not_in:0',
            'consignee_address'=>'required|max:100',
            'consignee_nearby_address'=>'max:100',

            //'addresslog_id'=>'required|exists:addresslogs,id,user_id,'. Auth::user()->id,
            'weight'=>'sometimes|nullable|numeric|min:1|max:50',
            'length'=>'sometimes|nullable|numeric|min:1|max:150',
            'width'=>'sometimes|nullable|numeric|min:1|max:150',
            'height'=>'sometimes|nullable|numeric|min:1|max:150',
            'cod_amount'=>'required|numeric|min:100|max:9900000',
            't_basic_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
            't_booking_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
            't_cash_handling_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
            't_packing_charges'=>'sometimes|nullable|numeric|min:1|max:9900000',
        ], [
            //'consignee_alias.unique'=>'Alias already taken in your address log.',
        ] );
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput($inputs);
        }

        $parcel = Parcel::create([
            'user_id'=>$inputs['user_account'],
            'assigned_parcel_number'=>null,
            'city_id' => $inputs['consignee_city'],
            'consignee_name' => $inputs['consignee_name'],
            'consignee_contact' => $inputs['consignee_contact'],
            'consignee_address' => $inputs['consignee_address'],
            'consignee_nearby_address' => $inputs['consignee_nearby_address'],
            'current_last_status' => 'shipment created',
            'amount'=>$inputs['cod_amount'],
            't_basic_charges'=>$inputs['t_basic_charges'],
            't_booking_charges'=>$inputs['t_booking_charges'],
            't_cash_handling_charges'=>$inputs['t_cash_handling_charges'],
            't_packing_charges'=>$inputs['t_packing_charges'],
            'weight'=>$inputs['weight'],
            'length'=>$inputs['length'],
            'height'=>$inputs['height'],
            'assigned_tracking_number'=>null,
        ]);
        $parcel->status()->attach(1);

        $parcel_number = 1000 + $parcel->id;
        $parcel->assigned_parcel_number = $parcel_number;
        $parcel->save();

        $parcel->refresh();

        return redirect()->route('admin-parcel', ['view',$parcel->id ])->with('success', '<strong>Parcel# '.$parcel->assigned_parcel_number.'</strong>  created successfully');

    }

    public function viewParcel($id){
        $parcel_details = Parcel::with('user', 'status')->find($id);
        $tracking_number = $parcel_details->assigned_tracking_number;
        $response_to_show = '';
        if(!empty($tracking_number)){
            try{
                $url ='https://cod.callcourier.com.pk/api/CallCourier/GetTackingHistory?cn=' . $tracking_number;
                $response_tracking = Http::get($url);
                if($response_tracking->status() == '200'){
                    //$response_to_show = json_decode($response_tracking->json(), true);
                    $response_to_show = $response_tracking->json();
                }
                else{
                    $response_to_show = 'Error in tracking call courier with cn no. <strong class="text-dark">' . $tracking_number . '</strong>';
                }

            }
            catch (ConnectionException $e){

                $response_to_show = 'Could not connect to Call Courier. Message: <span class="text-dark">' . $e->getMessage() . '</span>';
            }

        }
//        echo "<pre>";
//        print_r($response_tracking->json());
//        echo "</pre>";
        return view('admin_pages.parcels.parcel-view', [
            'parcel_details'=>$parcel_details,
            'response_courier'=>$response_to_show,
        ]);
    }

    public  function deleteParcel($id){

        User::destroy($id);
        return response()->json(['data'=>'success']);

    }
}
