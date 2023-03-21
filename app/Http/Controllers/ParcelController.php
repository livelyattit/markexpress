<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\City;
use App\User;
use App\Parcel;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Doctrine\DBAL\Exception\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Parcel::with('status', 'city')->where('user_id', Auth::user()->id)->get();

        //  foreach ($data as $d){
        //      echo $d->city->city_name;
        //  }
        //  return;


    }

    public function allParcels(Request $request){

        //$data = Parcel::with('status', 'city')->where('user_id', Auth::user()->id);

        //$pp = $request->all();

        if ($request->ajax()) {
            $data = Parcel::with('status', 'city')->where('user_id', Auth::user()->id);
            return DataTables::of($data)
                //                ->addColumn('shipment_created',  function($data){
                //                    return $data->created_at->format('d-F-Y');
                //                })
                //                ->addColumn('consignee_city',  function($data){
                //                    $data_decoded = json_decode($data->binded_addresslog, true);
                //                    //return $data_decoded['addresslog_info']['consignee_address'] ;
                //                    return $data_decoded['city']['city_name'] ;
                //                })
                //                ->addColumn('cod_amount',  function($data){
                //
                //                    return "PKR " .  number_format($data->amount, 1, '.', ',');
                //                })
                //                ->addColumn('delivery_charges',  function($data){
                //                    return "PKR " .  number_format($data->t_basic_charges, 1, '.', ',');
                //                })
                ->addColumn('view', function ($data) {
                    $button = '<a href="' . route('parcel.show', $data->id) . '" name="view" data-parcel-id="' . $data->id . '" class="btn-view-parcel btn btn-outline-warning btn-sm">View Details</a>';
                    return $button;
                })
                //                ->filter(function ($query) {
                //                    if (request()->has('jobFilter') && !empty(request()->jobFilter)) {
                //                        $query->whereHas('job', function($query) {
                //                            $query->where('jobs.id', request('jobFilter'));
                //                        });
                //                }
                //                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('d-m-Y') : '';
                })
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

        $cities = City::orderBy('city_name')->get();
        return view('pages.customer.parcel-create', [
            'body_class' => $body_class,
            'page_title' => $page_title,
            'cities' => $cities,

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
        $validator = Validator::make($input, [
            'consignee_city'=>'required|not_in:0|numeric|min:1|max:465',
            'consignee_nearby_address'=>'required',
            'weight' => 'sometimes|nullable|numeric|min:1|max:50',
            'length' => 'sometimes|nullable|numeric|min:1|max:150',
            'width' => 'sometimes|nullable|numeric|min:1|max:150',
            'height' => 'sometimes|nullable|numeric|min:1|max:150',
            'cod_amount' => 'required|numeric|min:100|max:9900000',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($input);
        }



        $city = City::find($input['consignee_city']);
        $cash_handling_amount = NULL;
        $cash_handling_message = '';
        if ($input['cod_amount'] >= 5000) {
            $cash_handling_amount = ($input['cod_amount'] * 1) / 100; //1 percent amount if charges exceeds 5000
            $cash_handling_amount = round($cash_handling_amount);
            $cash_handling_message = ' 1% <strong>(Rs. ' . $cash_handling_amount . ')</strong> is deducted as cash handling charges.';
        }
        $parcel = Parcel::create([
            'user_id' => Auth::user()->id,
            'assigned_parcel_number' => null,
            'city_id' => $input['consignee_city'],
            'consignee_name' => $input['consignee_name'],
            'consignee_contact' => $input['consignee_contact'],
            'consignee_address' => $input['consignee_address'],
            'consignee_nearby_address' => $input['consignee_nearby_address'],
            'current_last_status' => 'shipment created',
            'amount' => $input['cod_amount'],
            't_basic_charges' => $city->initial_weight_price,
            't_booking_charges' => null,
            't_cash_handling_charges' => $cash_handling_amount,
            't_packing_charges' => null,
            'weight' => $input['weight'],
            'length' => $input['length'],
            'height' => $input['height'],
            'assigned_tracking_number' => null,
        ]);
        $parcel->status()->attach(1);

        $parcel_number = 1000 + $parcel->id;
        $parcel->assigned_parcel_number = $parcel_number;
        $parcel->save();


        return back()->with('success', '<strong>Parcel#' . $parcel->assigned_parcel_number . '</strong>  created successfully.' . $cash_handling_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        if (Auth::user()->id == $parcel->user_id) {

            $parcel_details = Parcel::with(['status' => function ($query) {
                return $query->orderBy('status_id', 'asc');
            }, 'city'])->find($parcel->id);

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




            return view('pages.customer.parcel-show', [
                'parcel' => $parcel_details,
                'response_courier'=>$response_to_show,
            ]);
        } else {
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

    public function getConsignee(Request $request)
    {
        $input = $request->all();
        $addresslog = Addresslog::with('city')->find($input['consignee_id']);

        return response()->view('pages.customer.components.get-consignee', [
            'addresslog' => $addresslog,
            'input' => $input,
        ]);
    }
}
