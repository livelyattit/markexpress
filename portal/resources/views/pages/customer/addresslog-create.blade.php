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
                <div class="goback-button">
                    <a href="{{route('customer-dashboard')}}"><i class="far fa-arrow-left"></i> Go to Dashboard</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-addresslog-wrapper form-wrapper">
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    @php
                                        echo Session::get('success');
                                    @endphp
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                            <h3>ADD CONSIGNEE INFORMATION</h3>
                            <form onsubmit=" var cc = document.querySelector('.btn-in-submit');cc.setAttribute('disabled', 'disabled');cc.value='Please Wait..'" id="addresslog-create-form" class="addresslog-form form-in" action="{{route('address-log.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Consignee Name</label>
                                    <input required name="consignee_name" value="{{old('consignee_name')}}"   type="text" placeholder="Full Name"  class="form-control">
                                    @if($errors->has('consignee_name'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Consignee Contact</label>
                                    <input required name="consignee_number" value="{{old('consignee_number')}}"   type="tel" placeholder="e.g 03111234567"  class="form-control">
                                    @if($errors->has('consignee_number'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_number')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>City (With Delivery Time)</label>
                                    <select data-placeholder="Select City" required name="consignee_city"   class="form-control select-js">
                                        <option value="" style="display: none"></option>
                                        @foreach($cities as $city)
                                            @if($city->is_enabled ==1)
                                                <option @if(old('consignee_city') == $city->id) selected="selected" @endif value="{{$city->id}}">{{$city->city_name}} ({{$city->delivery_time}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($errors->has('consignee_city'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_city')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Consignee Address</label>
                                    <input required name="consignee_address" value="{{old('consignee_address')}}"   type="text" placeholder="Complete Address"  class="form-control">
                                    @if($errors->has('consignee_address'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_address')}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Nearby Location (Optional)</label>
                                    <input  name="consignee_nearby_address" value="{{old('consignee_nearby_address')}}"  type="text" placeholder="Any nearby location if necessary"  class="form-control">
                                    @if($errors->has('consignee_nearby_address'))
                                        <span class="alert alert-danger">{{$errors->first('consignee_nearby_address')}}</span>
                                    @endif
                                </div>

                                <div class="form-group text-center">
                                    <input type="submit" value="Save Consignee" class="btn btn-success btn-round btn-in-submit">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
