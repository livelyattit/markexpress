@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="page-title">Users</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
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
                                    <table  id="users_table" class="text-center table table-striped table-hover display actions">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Status</th>
                                            <th>Cnic</th>
                                            <th>Address</th>
                                            <th>Created On</th>
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
