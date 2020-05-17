@extends('layouts.default')

@section('content')
    <div class="main-wrapper">

        @if(Auth::user()->originality_verified == 0)
            @include('pages.customer.includes.account_verification_content')
        @elseif(Auth::user()->originality_verified == 1)
            @include('pages.customer.includes.account_verification_content2')
        @elseif(Auth::user()->originality_verified == 2)
            @include('pages.customer.includes.account_confirmation_content')
        @elseif(Auth::user()->originality_verified == 3)
            @include('pages.customer.includes.dashboard_content')
            @include('includes.popup-edit-address-log')
        @endif

    </div>
@stop
