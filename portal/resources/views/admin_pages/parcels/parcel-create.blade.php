@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">Parcel</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Parcel</h5>
                        @if ($errors->any())
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <div>{{$error}}</div>--}}
{{--                            @endforeach--}}
                            <div class="alert alert-danger text-white">Errors!! Check the fields</div>
                        @endif
                        <form novalidate method="post" action="{{route('admin-parcel', 'create')}}" class="needs-validation">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h5 class="text-dark mt-4 mb-3"><strong>ADDRESSLOG FIELDS</strong></h5>
                                    <div class="form-group">
                                        @empty($user_details)
                                            <span class="d-block">Select Account</span>
                                            <select name="user_account" required="required" data-placeholder="Select Account" id="ajax-accounts" class="js-states form-control">
                                                <option value=""></option>
                                            </select>
                                            @if ($errors->has('user_account'))
                                                <div class="d-block invalid-feedback">
                                                    <span class="error">{{ $errors->first('user_account') }}</span>
                                                </div>
                                            @endif
                                        @else
                                            <h3>Account: {{$user_details->account_code}}<span class="text-primary"> | </span>{{$user_details->name}}<span class="text-primary"> | </span>{{$user_details->email}}</h3>
                                            <input type="hidden" name="user_account" value="{{$user_details->id}}">
                                        @endempty

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address Alias</label>
                                        <input readonly required name="consignee_alias" value="{{'generated-' . time()}}"  type="text" placeholder="e.g Consignee Name"  class="form-control">
                                        @if($errors->has('consignee_alias'))
                                            <div class="d-block invalid-feedback">
                                                <span class="error">{{ $errors->first('consignee_alias') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Consignee Name</label>
                                        <input required name="consignee_name" value="{{old('consignee_name')}}"   type="text" placeholder="Full Name"  class="form-control">
                                        @if($errors->has('consignee_name'))
                                            <div class="d-block invalid-feedback">
                                                <span class="error">{{ $errors->first('consignee_name') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Consignee Contact</label>
                                        <input required name="consignee_number" value="{{old('consignee_number')}}"   type="tel" placeholder="e.g 03111234567"  class="form-control">
                                        @if($errors->has('consignee_number'))
                                            <div class="d-block invalid-feedback">
                                                <span class="error">{{ $errors->first('consignee_number') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="d-block">City (With Delivery Time)</span>
                                        <select data-placeholder="Select City" required name="consignee_city"   class="form-control select-js">
                                            <option value="" style="display: none"></option>
                                            @foreach($cities as $city)
                                                @if($city->is_enabled ==1)
                                                    <option @if(old('consignee_city') == $city->id) selected="selected" @endif value="{{$city->id}}">{{$city->city_name}} ({{$city->delivery_time}})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('consignee_city'))
                                            <div class="d-block invalid-feedback">
                                                <span class="error">{{ $errors->first('consignee_city') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Consignee Address</label>
                                        <input required name="consignee_address" value="{{old('consignee_address')}}"   type="text" placeholder="Complete Address"  class="form-control">
                                        @if($errors->has('consignee_address'))
                                            <div class="d-block invalid-feedback">
                                                <span class="error">{{ $errors->first('consignee_address') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nearby Location (Optional)</label>
                                        <input  name="consignee_nearby_address" value="{{old('consignee_nearby_address')}}"  type="text" placeholder="Any nearby location if necessary"  class="form-control">
                                        @if($errors->has('consignee_nearby_address'))
                                            <div class="d-block invalid-feedback">
                                                <span class="error">{{ $errors->first('consignee_nearby_address') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="parcel-fields-wrapper">
                                        <hr>
                                        <h5 class="text-dark mt-4 mb-3"><strong>PARCEL FIELDS</strong></h5>
                                        <div class="form-group">
                                            <label>Cod Amount</label>
                                            <input autocomplete="off" required name="cod_amount" value="{{old('cod_amount')}}"   type="number" placeholder="Enter Amount e.g 1000"  class="form-control fn-number">
                                            <div class="fn-number-words"></div>
                                            @if($errors->has('cod_amount'))
                                                <div class="d-block invalid-feedback">
                                                    <span class="error">{{ $errors->first('cod_amount') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="optional-fields-wrapper">
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <label>Weight in Kgs.</label>
                                                    <input step="1"  min="1" max="50" name="weight" value="{{old('weight')}}"   type="number" placeholder="Enter Weight e.g 10"  class="form-control">
                                                    @if($errors->has('weight'))
                                                        <div class="d-block invalid-feedback">
                                                            <span class="error">{{ $errors->first('weight') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <label>Length in Cm.</label>
                                                    <input step="1" min="1" max="150" name="length" value="{{old('length')}}"   type="number" placeholder="Enter Length e.g 110"  class="form-control">
                                                    @if($errors->has('length'))
                                                        <div class="d-block invalid-feedback">
                                                            <span class="error">{{ $errors->first('length') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <label>Width in Cm.</label>
                                                    <input step="1"  min="1" max="150" name="width" value="{{old('width')}}"   type="number" placeholder="Enter Width e.g 110"  class="form-control">
                                                    @if($errors->has('width'))
                                                        <div class="d-block invalid-feedback">
                                                            <span class="error">{{ $errors->first('width') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <label>Height in Cm.</label>
                                                    <input step="1"  min="1" max="150" name="height" value="{{old('height')}}"   type="number" placeholder="Enter Height e.g 110"  class="form-control">
                                                    @if($errors->has('height'))
                                                        <div class="d-block invalid-feedback">
                                                            <span class="error">{{ $errors->first('height') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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
