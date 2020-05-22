@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="page-title">Create New User</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create User</h5>
                        @if ($errors->any())
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <div>{{$error}}</div>--}}
{{--                            @endforeach--}}
                            <div class="alert alert-danger text-white">Errors!! Check the fields</div>
                        @endif
                        <form method="post" action="{{route('admin-user', 'create')}}" class="needs-validation">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Full Name</label>
                                        <input type="text" class="form-control" id="signup-name" name="name" placeholder="Full name" value="{{old('name')}}" required="">
                                        @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <span class="error">{{ $errors->first('name') }}</span>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Email Address</label>
                                        <input type="text" class="form-control" id="signup-email" name="email" placeholder="Email Address" value="{{old('email')}}" required="">
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('email') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Mobile No.</label>
                                        <input type="text" class="form-control" id="signup-mobile" name="mobile" placeholder="Mobile No." value="{{old('mobile')}}" required="">
                                        @if ($errors->has('mobile'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('mobile') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">CNIC No.</label>
                                        <input type="text" class="form-control" id="signup-cnic" name="cnic" placeholder="CNIC No." value="{{old('cnic')}}" required="">
                                        @if ($errors->has('cnic'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('cnic') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Address</label>
                                        <input type="text" class="form-control" id="signup-address" name="address" placeholder="Address" value="{{old('address')}}" required="">
                                        @if ($errors->has('address'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('address') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Password</label>
                                        <input type="text" class="form-control" id="signup-password" name="password" placeholder="Password" value="{{old('password')}}" required="">
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('password') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Confirm Password</label>
                                        <input type="text" class="form-control" id="signup-password-2" name="password_confirmation" placeholder="Confirm Password" value="{{old('password_confirmation')}}" required="">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('password_confirmation') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
