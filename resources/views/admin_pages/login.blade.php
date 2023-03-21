@extends('admin_layouts.default')
@section('content')

<style>
    .page-content {
        padding: 85px 25px 50px 25px;
    }
</style>
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Admin Panel</h5>
                        <h3>Sign Into Mark Express</h3>
                        <form id="form-login" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input required type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input required type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary waves-effect waves-light btn-in-submit">Submit</button>
                            </div>
                            <div class="form-message"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
