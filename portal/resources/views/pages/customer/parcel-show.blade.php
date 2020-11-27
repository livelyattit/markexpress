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
        <section id="dashboard-addresslog" class="customer-dashboard parcel-show">
            <div class="container">
                <div class="goback-button">
                    <a href="{{route('customer-dashboard')}}"><i class="far fa-arrow-left"></i> Go to Dashboard</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>SHIPMENT DETAILS</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h4>Parcel # {{$parcel->assigned_parcel_number}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="parcel-info-wrapper">
                            <h5>Consignee Details</h5>
                            <ul>
                                <li><span>Consignee:</span> <strong>{{$parcel->consignee_name}}</strong></li>
                                <li><span>Name:</span> <strong>{{$parcel->consignee_name}}</strong></li>
                                <li><span>Address:</span> <strong>{{$parcel->consignee_address}}</strong></li>
                                <li><span>Nearby:</span> <strong>{{$parcel->consignee_nearby_address}}</strong></li>
                                <li><span>City:</span> <strong>{{$parcel->city->city_name}}</strong></li>
                                <li><span>Estimated Delivery Time:</span> <strong>{{$parcel->city->delivery_time}}</strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="parcel-info-wrapper">
                            <h5>Shipment Details</h5>
                            <ul>
                                <li><span>Consignee:</span> <strong>{{$parcel->consignee_name}}</strong></li>
                                <li><span>Name:</span> <strong>{{$parcel->consignee_name}}</strong></li>
                                <li><span>Address:</span> <strong>{{$parcel->consignee_address}}</strong></li>
                                <li><span>Nearby:</span> <strong>{{$parcel->consignee_nearby_address}}</strong></li>
                                <li><span>City:</span> <strong>{{$parcel->city->city_name}}</strong></li>
                                <li><span>Estimated Delivery Time:</span> <strong>{{$parcel->city->delivery_time}}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>SHIPMENT TIMELINE</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="parcel-show">
                            <div class="parcel-timeline-wrapper">
                                <div class="timeline-centered">
                                    @foreach($parcel->status as $status)
                                        <article class="timeline-entry">

                                            <div class="timeline-entry-inner">
                                                <time class="timeline-time" datetime="{{$status->pivot->updated_at}}"><span>{{\Carbon\Carbon::parse($status->pivot->updated_at)->format('d-F-Y')}}</span> <span>{{\Carbon\Carbon::parse($status->pivot->updated_at)->format('l')}}</span></time>

                                                <div class="timeline-icon bg-success">
                                                    <i class="entypo-feather"></i>
                                                </div>

                                                <div class="timeline-label">
                                                    <h2><span>{{$status->status}}</span></h2>
                                                </div>
                                            </div>

                                        </article>

                                    @endforeach



                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h3>SHIPMENT LOG</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(is_array($response_courier))
                            <button class="btn btn-success mb-3" type="button" data-toggle="collapse" data-target="#courier-log" aria-expanded="false" aria-controls="courier-log">
                                Click to show log
                            </button>
                            <div class="collapse" id="courier-log">
                                <div class="card card-body">
                                    <p><strong><i>This log is only for enquiry purposes.</i></strong></p>
                                    <div class="table-responsive">
                                        <table class="table display table-bordered table-striped">
                                            <thead>
                                                <tr>

                                                    <th>ContactNo</th>
                                                    <th>Address</th>
                                                    <th>TransactionDate</th>
                                                    <th>OperationDesc</th>
                                                    <th>ProcessDescForPortal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($response_courier as $courier)
                                                @if (strtolower($courier['OperationDesc']) != 'booked')
                                                    @php
                                                    $transaction_date =  \Carbon\Carbon::parse($courier['TransactionDate'])->format('d-m-Y H:i:s');
                                                    @endphp
                                                    <tr>
                                                        <td>{{$courier['ContactNo']}}</td>
                                                        <td>{{$courier['ConsigneeAddress']}}</td>
                                                        <td>{{$transaction_date}}</td>
                                                        <td>{{$courier['OperationDesc']}}</td>
                                                        <td>{{$courier['ProcessDescForPortal']}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @else
                        <h6>No Log Yet</h6>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
