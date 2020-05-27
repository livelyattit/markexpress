@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">Parcel</h5>
                @if(Session::has('success'))
                    <div class="alert alert-success text-white">
                        @php
                            echo Session::get('success');
                        @endphp
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Upload CSV File</h5>
                        <form  enctype="multipart/form-data" method="post" action="{{route('admin-csv')}}">
                            @csrf
                            <div class="form-group">
                                <input required="required" type="file" name="file" class="form-control-file form-control" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <div class="text text-dark"><a download href="{{asset('admin_assets/csv-sample.csv')}}">Click Here</a> to download the sample to create cn#s</div>
                            </div>
                            <div class="form-group">
                                <button class="form-control d-inline-block btn btn-primary waves-effect waves-light w-25" type="submit">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
