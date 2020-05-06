@extends('layouts.default')

@section('content')
    <div class="main-wrapper">

        @if(Auth::user()->originality_verified == 2)
            @include('pages.customer.includes.dashboard_content')
        @else
            @include('pages.customer.includes.verification_content')
        @endif

    </div>
@stop
