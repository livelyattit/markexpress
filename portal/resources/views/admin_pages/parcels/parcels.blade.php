@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="page-title">Parcels</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">All Parcels</h5>
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
                            <div class="table-container">
                                <div class="table-responsive">
                                    <table  id="parcels_table" class="text-center table table-striped table-hover display actions">
                                        <thead>
                                        <tr>
                                            <th>Created On</th>
                                            <th>Parcel #</th>
                                            <th>Cn #</th>
                                            <th>Account</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Change Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
