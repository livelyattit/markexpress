@extends('layouts.default')

@section('content')
<section class="about_us_area" id="about">
    <div class="container">
        <div class="row page-title">
            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                <div class="about_us_content_title">
                    <h2>Dashboard</h2>
                    <h5>Welcome User</h5>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <div class="about_us_content_title">
                    <ul class="breadcrumbs">
                        <li><a href="#">home</a></li>
                        <li><a href="#">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@stop
