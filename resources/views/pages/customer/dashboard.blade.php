@extends('layouts.default')

@section('content')
    <div class="main-wrapper">

        <section id="dashboard-upperinfo" class="customer-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Account Code: <strong>{{Auth::user()->account_code}}</strong></h3>
                    </div>
                </div>
            </div>
        </section>

        @if(Auth::user()->originality_verified == 0
        && (isset(Auth::user()->personalData->bill_request_confirmation) == 0 || isset(Auth::user()->personalData->cnic_request_confirmation) == 0))
            @include('pages.customer.includes.account_verification_content')
        @elseif(Auth::user()->originality_verified == 0
        && (isset(Auth::user()->personalData->bill_request_confirmation) == 1 || isset(Auth::user()->personalData->cnic_request_confirmation) == 1))
            @include('pages.customer.includes.account_verification_content')
        @elseif(Auth::user()->originality_verified == 1)
            @include('pages.customer.includes.account_verification_content2')
        @elseif(Auth::user()->originality_verified == 2)
            @include('pages.customer.includes.account_confirmation_content')
        @elseif(Auth::user()->originality_verified == 3)
            @include('pages.customer.includes.dashboard_content')
            {{-- @include('includes.popup-edit-address-log') --}}
        @endif

    </div>
@stop
