<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\City;
use App\User;
use App\Parcel;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
class ParcelController extends Controller
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
            $data = Parcel::with( 'status')->where('user_id', Auth::user()->id);
            return DataTables::of($data)
//                ->addColumn('current_status', function($data){
//                    $dd  = $data->status()->latest('parcel_status.updated_at')->first();
//                    return $dd->status  ;
//
//                })

                ->addColumn('consignee_alias', function($data){
                    $data_decoded = json_decode($data->binded_addresslog, true);
                    return $data_decoded['addresslog_info']['consignee_name'] ;
                })
                ->addColumn('shipment_created',  function($data){
                    return $data->created_at->format('d-F-Y');
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
                    return "PKR " .  number_format($data->t_basic_charges, 1, '.', ',');
                })
                ->addColumn('view', function($data){
                    $button = '<a href="'.route('parcel.show', $data->id).'" name="view" data-parcel-id="'.$data->id.'" class="btn-view-parcel btn btn-outline-warning btn-sm">View Details</a>';
                    return $button;
                })
                ->rawColumns(['view'])
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
        $page_title = 'Create Parcel';

        $user_details = User::with(['addressLog'=>function($q){
            return $q->where('created_by', '=', 'is_customer');
        }])->find(Auth::user()->id);
        return view('pages.customer.parcel-create', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
            'user_details'=>$user_details,

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
            'addresslog_id'=>'required|exists:addresslogs,id,user_id,'. Auth::user()->id,
            'weight'=>'sometimes|nullable|numeric|min:1|max:50',
            'length'=>'sometimes|nullable|numeric|min:1|max:150',
            'width'=>'sometimes|nullable|numeric|min:1|max:150',
            'height'=>'sometimes|nullable|numeric|min:1|max:150',
            'cod_amount'=>'required|numeric|min:100|max:9900000',
        ] );
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput($input);
        }

//        $pp= new Parcel();
//        $pp->refresh();
//        $num = $pp->generateParcelNumber();

        $binded_address = Addresslog::find($input['addresslog_id'])->toArray();
        $binded_city = Addresslog::find($input['addresslog_id'])->city->toArray();

        $ff = [
            'addresslog_info'=>$binded_address,
            'city'=>$binded_city,
            ];

        $parcel = Parcel::create([
            'user_id'=>Auth::user()->id,
            'addresslog_id'=>$input['addresslog_id'],
            'assigned_parcel_number'=>null,
            'binded_addresslog'=>json_encode($ff),
            'current_last_status'=>'shipment created',
            'amount'=>$input['cod_amount'],
            't_basic_charges'=>$binded_city['initial_weight_price'],
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

        return back()->with('success', '<strong>Parcel#'.$parcel->assigned_parcel_number.'</strong>  created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        if(Auth::user()->id == $parcel->user_id){

            $data = Parcel::with(['status'=>function($query){
               return $query->orderBy('status_id', 'asc');
            },
                'addressLog'])->find($parcel->id);

            return view('pages.customer.parcel-show', [
                'parcel'=>$data,
            ]);
        }
        else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parcel $parcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parcel $parcel)
    {
        //
    }

    public function getConsignee(Request $request){
        $input = $request->all();
        $addresslog = Addresslog::with('city')->find($input['consignee_id']);

        return response()->view('pages.customer.components.get-consignee', [
            'addresslog'=>$addresslog,
            'input'=> $input,
        ]);
    }
}
