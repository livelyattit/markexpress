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
                        <div class="form-parcel-wrapper form-wrapper">
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
                            <h3>CREATE PARCEL</h3>
                            <form onsubmit=" var cc = document.querySelector('.btn-in-submit');cc.setAttribute('disabled', 'disabled');cc.value='Please Wait..'" id="parcel-create-form" class="parcel-form form-in" action="{{route('parcel.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Consignee</label>
                                        <select data-placeholder="Select Consignee" required name="addresslog_id"   class="form-control select-js">
                                            <option value="" style="display: none"></option>
                                            @foreach($user_details->addresslog as $address)
                                                    <option @if(old('addresslog_id') == $address->id) selected="selected" @endif value="{{$address->id}}">{{$address->consignee_alias}} ({{$address->consignee_address}})</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('addresslog_id'))
                                            <span class="alert alert-danger">{{$errors->first('addresslog_id')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cod Amount</label>
                                    <input required name="cod_amount" value="{{old('cod_amount')}}"   type="tel" placeholder="Enter Amount e.g 1000"  class="form-control">
                                    @if($errors->has('cod_amount'))
                                        <span class="alert alert-danger">{{$errors->first('cod_amount')}}</span>
                                    @endif
                                </div>
                                <hr>
                                <div class="optional-fields-wrapper">
                                    <h4>Optional Fields</h4>
                                    <div class="row form-group">
                                            <div class="col-12">
                                                <label>Weight in Kgs.</label>
                                                <input step="1"  min="1" max="50" name="weight" value="{{old('weight')}}"   type="number" placeholder="Enter Weight e.g 10"  class="form-control">
                                                @if($errors->has('weight'))
                                                    <span class="alert alert-danger">{{$errors->first('weight')}}</span>
                                                @endif
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <label>Length in Cm.</label>
                                            <input step="1" min="1" max="150" name="length" value="{{old('length')}}"   type="number" placeholder="Enter Length e.g 110"  class="form-control">
                                            @if($errors->has('length'))
                                                <span class="alert alert-danger">{{$errors->first('length')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <label>Width in Cm.</label>
                                            <input step="1"  min="1" max="150" name="width" value="{{old('width')}}"   type="number" placeholder="Enter Width e.g 110"  class="form-control">
                                            @if($errors->has('width'))
                                                <span class="alert alert-danger">{{$errors->first('width')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-12">
                                            <label>Height in Cm.</label>
                                            <input step="1"  min="1" max="150" name="height" value="{{old('height')}}"   type="number" placeholder="Enter Height e.g 110"  class="form-control">
                                            @if($errors->has('height'))
                                                <span class="alert alert-danger">{{$errors->first('height')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <input type="submit" value="Create Parcel" class="btn btn-success btn-round btn-in-submit">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
