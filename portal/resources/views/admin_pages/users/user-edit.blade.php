@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">Edit User</h5>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <h4 class="text text-dark">{{ucwords($user_details->name)}}</h4>
            </div>
            <div class="col-6">
                <div class="d-flex">
                    <a href="{{route('admin-user', ['view',$user_details->id ])}}" class="m-2 p-2 btn-view-user btn btn-outline-warning btn-sm btn-icon w-50"><span class="material-icons">remove_red_eye</span>View</a>
                    <a href="javascript:void(0)" data-url="{{route('admin-user', ['delete',$user_details->id ])}}" class="m-2 p-2 btn-delete-user btn btn-outline-danger btn-sm btn-icon w-50"><span class="material-icons">report_problem</span>Delete</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Basic Details</h5>
                        @if ($errors->basic_details->any())
                            @foreach ($errors->basic_details->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                            <div class="alert alert-danger text-white">Errors!! Check the fields</div>
                        @endif
                        <form method="post" action="{{route('admin-user', ['edit', $user_details->id, 'basic_details'])}}" class="needs-validation">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Full Name</label>
                                        <input type="text" class="form-control" id="signup-name" name="name" placeholder="Full name" value="{{$user_details->name ?? ''}}" >
                                        @if ($errors->basic_details->has('name'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('name')}} {{ $errors->basic_details->first('name') }}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Email Address</label>
                                        <input type="text" class="form-control" id="signup-email" name="email" placeholder="Email Address" value="{{$user_details->email ?? ''}}" >
                                        @if ($errors->basic_details->has('email'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('email')}} {{ $errors->basic_details->first('email') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Mobile No.</label>
                                        <input type="text" class="form-control" id="signup-mobile" name="mobile" placeholder="Mobile No." value="{{$user_details->mobile ?? ''}}" >
                                        @if ($errors->basic_details->has('mobile'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('mobile')}} {{ $errors->basic_details->first('mobile') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">CNIC No.</label>
                                        <input type="text" class="form-control" id="signup-cnic" name="cnic" placeholder="CNIC No." value="{{$user_details->cnic ?? ''}}" >
                                        <small>Cnic Format 4XXXX-XXXXXXX-X</small>
                                        @if ($errors->basic_details->has('cnic'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('cnic')}} {{ $errors->basic_details->first('cnic') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Address</label>
                                        <input type="text" class="form-control" id="signup-address" name="address" placeholder="Address" value="{{$user_details->address ?? ''}}" >
                                        @if ($errors->basic_details->has('address'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('address')}} {{ $errors->basic_details->first('address') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Password</label>
                                        <input type="text" class="form-control" id="signup-password" name="password" placeholder="Password" value="" >
                                        <small>Leave password field blank if you dont want to change the password</small>
                                        @if ($errors->basic_details->has('password'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('password')}} {{ $errors->basic_details->first('password') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="active" style="display: block !important;">Verification Status</small>
                                       <select name="originality_verified" class="form-control" required="">
                                           @foreach($originality as $originality_verified)
                                               <option @if($user_details->originality_verified == $originality_verified->originality_verified) selected @endif value="{{$originality_verified->originality_verified}}">{{$originality_verified->status}}</option>
                                           @endforeach
                                       </select>
                                        @if ($errors->has('originality_verified'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{ $errors->first('originality_verified') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Personal Details</h5>
                        <div class="row">
                            <div class="col-6">
                                @isset($user_details->personalData->bill_file_name)
                                    <div class="verification-uploaded">
                                        <h4>User Uploaded Bill Copy</h4>
                                        <img class="verification-img" src="{{route('content',
                                 ['authid'=>$user_details->id,
                                 'location'=>'JP7gRq00',
                                    'filename'=>$user_details->personalData->bill_file_name
                                 ])}}">
                                    </div>

                                @endisset
                                <div class="verification-uploader verification-uploader-bill">
                                    <h3>Upload a copy of bill</h3>
                                    <form  enctype="multipart/form-data"  id="form-upload-bill" method="POST" action="{{route('file-upload-bill')}}" class="dropzone from">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user_details->id}}">
                                    </form>
                                </div>
                            </div>

                            <div class="col-6">
                                @isset($user_details->personalData->cnic_file_name)
                                    <div class="verification-uploaded">
                                        <h4>Your Uploaded Cnic Copy</h4>
                                        <img class="verification-img" src="{{route('content',
                                     ['authid'=>$user_details->id,
                                     'location'=>'lL3MgYsS',
                                        'filename'=>$user_details->personalData->cnic_file_name
                                     ])}}">
                                    </div>
                                @endisset
                                    <div class="verification-uploader verification-uploader-cnic">
                                        <h3>Upload a copy of cnic</h3>
                                        <form  enctype="multipart/form-data"  id="form-upload-cnic" method="POST" action="{{route('file-upload-cnic')}}" class="dropzone from">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user_details->id}}">
                                        </form>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Business Details</h5>
                        @if ($errors->business_details->any())
                            @foreach ($errors->business_details->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                            <div class="alert alert-danger text-white">Errors!! Check the fields</div>
                        @endif
                        <form method="post" action="{{route('admin-user', ['edit', $user_details->id, 'business_details'])}}" class="needs-validation">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Business Name</label>
                                        <input type="text" name="business_name" placeholder="Your Business Name" class="form-control" value="{{$user_details->accountDetail->business_name ?? ''}}" >
                                        @if ($errors->business_details->has('business_name'))
                                            <div class="invalid-feedback">
                                                <span class="error">{{old('business_name')}} {{ $errors->business_details->first('business_name') }}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Approx Daily Shipment Quantity</label>
                                        <input min="1" step="1" type="number"  name="shipment_quantity" placeholder="Number of Shipments" class="form-control"  value="{{$user_details->accountDetail->shipment_quantity ?? ''}}" >
                                        @if ($errors->business_details->has('shipment_quantity'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('shipment_quantity')}} {{ $errors->business_details->first('shipment_quantity') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" placeholder="Your Bank Name" value="{{$user_details->accountDetail->bank_name ?? ''}}" >
                                        @if ($errors->business_details->has('bank_name'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('bank_name')}} {{ $errors->business_details->first('bank_name') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Bank Account Title</label>
                                        <input type="text" class="form-control" id="signup-cnic" name="bank_account_title" placeholder="Your Bank Account Title" value="{{$user_details->accountDetail->bank_account_title ?? ''}}" >
                                        @if ($errors->business_details->has('bank_account_title'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('bank_account_title')}} {{ $errors->business_details->first('bank_account_title') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validationCustom01">Bank Account Number With Branch Code Or IBAN Number 24 Digits</label>
                                        <input type="text" class="form-control" id="signup-address" name="bank_account_number" placeholder="Your Bank Account No. Or IBAN" value="{{$user_details->accountDetail->bank_account_number ?? ''}}" >
                                        @if ($errors->business_details->has('bank_account_number'))
                                            <div class="invalid-feedback d-block">
                                                <span class="error">{{old('bank_account_number')}} {{ $errors->business_details->first('bank_account_number') }}</span>
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
