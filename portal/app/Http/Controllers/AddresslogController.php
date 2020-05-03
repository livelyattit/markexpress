<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\City;
use App\Rules\PhoneNumber;
use App\DataTables\AddressLog as DAddressLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
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
            $data = Addresslog::with(['city'=>function($q){

            }]);
            return DataTables::of($data)
                ->addColumn('edit', function($data){
                    $button = '<button type="button" name="edit" data-addresslog-id="'.$data->id.'" class="btn-edit-addresslog btn btn-outline-warning btn-sm">Edit</button>';
                    return $button;
                })
                ->addColumn('delete', function($data){
                    $button = '<button type="button" name="edit" data-addresslog-id="'.$data->id.'" class="btn-delete-addresslog btn btn-outline-danger btn-sm">Delete</button>';
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

        $user_details = BaseController::getUserDetails(Auth::user()->id);
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
            'consignee_alias'=>'required|unique:addresslogs,consignee_alias,NULL,id,user_id,'. Auth::user()->id,
            'consignee_name'=>'required|max:190',
            'consignee_number'=>new PhoneNumber(),
            'consignee_city'=>'required|not_in:0',
            'consignee_address'=>'required|max:100',
            'consignee_nearby_address'=>'max:100',
        ], [
            'consignee_alias.unique'=>'Already taken in your address log.',
        ] )->validate();

        $address_log = Addresslog::create([
            'user_id'=>Auth::user()->id,
            'city_id'=>$input['consignee_city'],
            'consignee_alias'=>$input['consignee_alias'],
            'consignee_name'=>$input['consignee_name'],
            'consignee_contact'=>$input['consignee_number'],
            'consignee_address'=>$input['consignee_address'],
            'consignee_nearby_address'=>$input['consignee_nearby_address'],
        ]);

        return back()->with('success', 'Address has been made successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function show(Addresslog $addresslog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function edit(Addresslog $addresslog)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Addresslog  $addresslog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addresslog $addresslog)
    {
        //
    }
}
