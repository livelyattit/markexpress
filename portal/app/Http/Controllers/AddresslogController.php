<?php

namespace App\Http\Controllers;

use App\Addresslog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddresslogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('pages.customer.addresslog-create', [
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

        return response($input);
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
