@extends('layouts.default')

@section('content')
    <div class="main-wrapper">
        <section id="dashboard-header" class="customer-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </section>
        <section id="dashboard-addresslog" class="customer-dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="goback-button">
                            <a href="{{route('customer-dashboard')}}"><i class="far fa-arrow-left"></i> Go to Dashboard</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-addresslog-wrapper">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                            <h3>ADD CONSIGNEE INFORMATION</h3>
                            <form id="addresslog-create-form" class="addresslog-form" action="{{route('address-log.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Address Alias</label>
                                    <input name="consignee_alias"  type="text" placeholder="e.g Consignee Name"  class="form-control">
                                    @if($errors->has('consignee_alias'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_alias')}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Consignee Name</label>
                                    <input name="consignee_name"   type="text" placeholder="Full Name"  class="form-control">
                                    @if($errors->has('consignee_name'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Consignee Contact</label>
                                    <input name="consignee_number"   type="tel" placeholder="e.g 03111234567"  class="form-control">
                                    @if($errors->has('consignee_number'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_number')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="consignee_city"   class="form-control">
                                        <option value="" style="display: none">Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('consignee_city'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_city')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Consignee Address</label>
                                    <input name="consignee_address"   type="text" placeholder="Complete Address"  class="form-control">
                                    @if($errors->has('consignee_address'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_address')}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Nearby Location (Optional)</label>
                                    <input  name="consignee_nearby_address"  type="text" placeholder="Any nearby location if necessary"  class="form-control">
                                    @if($errors->has('consignee_nearby_address'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_nearby_address')}}</span>
                                    @endif
                                </div>

                                <div class="form-group text-center">
                                    <input type="submit" value="Save Address" class="btn btn-success btn-round btn-in-submit">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
