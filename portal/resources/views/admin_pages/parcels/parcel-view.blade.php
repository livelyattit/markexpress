@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">Parcel</h5>
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
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <h4 class="text text-dark">{{ucwords($parcel_details->user->name)}} # {{$parcel_details->user->account_code}}</h4>
                <h3 class="text text-dark">Parcel # {{ucwords($parcel_details->assigned_parcel_number)}} </h3>
            </div>
            <div class="col-6">
                <div class="d-flex flex-wrap">
                    <a href="{{route('admin-parcel', ['create',$parcel_details->user->id ])}}" class="m-2 p-2 btn-edit-user btn btn-outline-primary btn-sm btn-icon w-sm"><span class="material-icons">control_point_duplicate</span>New Parcel</a>
                    <a href="{{route('admin-user', ['view',$parcel_details->user->id ])}}" class="m-2 p-2 btn-edit-user btn btn-outline-light btn-sm btn-icon w-sm"><span class="material-icons">wc</span>View User</a>
                    <a href="{{route('admin-parcel', ['edit',$parcel_details->id ])}}" class="m-2 p-2 btn-edit-user btn btn-outline-info btn-sm btn-icon w-sm"><span class="material-icons">edit</span>Edit</a>
                    <a href="javascript:void(0)" data-url="{{route('admin-parcel', ['delete',$parcel_details->id ])}}" class="m-2 p-2 btn-delete-parcel btn btn-outline-danger btn-sm btn-icon w-sm"><span class="material-icons">report_problem</span>Delete</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Parcel Details</h5>
                        <ul class="view-details btn-clipboards">
                            <li>Parcel #: <strong>{{$parcel_details->assigned_parcel_number ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->assigned_parcel_number ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>CN #: <strong>{{$parcel_details->assigned_tracking_number ?? 'Not Set'}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->assigned_tracking_number ?? 'Not Set'}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            @isset($parcel_details->weight)
                            <li>Weight: <strong>{{$parcel_details->weight . " Kg" ?? 'Not Set'}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->weight . " Kg" ?? 'Not Set'}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            @endisset
                            @isset($parcel_details->length)
                                <li>Weight: <strong>{{$parcel_details->length . " cm" ?? 'Not Set'}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->length . " cm" ?? 'Not Set'}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            @endisset
                            @isset($parcel_details->width)
                                <li>Weight: <strong>{{$parcel_details->width . " cm" ?? 'Not Set'}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->width . " cm" ?? 'Not Set'}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            @endisset
                            @isset($parcel_details->height)
                                <li>Weight: <strong>{{$parcel_details->height . " cm" ?? 'Not Set'}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->height . " cm" ?? 'Not Set'}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            @endisset

                            <li>
                                Parcel Status
                                <div class="table-container">
                                    <div class="table-responsive">
                                        <table border="1" class="mini-table table table-striped w-100">
                                            <thead class="table-dark">
                                            <tr>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($parcel_details->status as $status)
                                                    <tr>
                                                        <td class="w-50">
                                                            <span>{{\Carbon\Carbon::parse($status->pivot->updated_at)->format('d-F-Y')}}</span>
                                                        </td>
                                                        <td class="w-50">
                                                            <span>{{$status->status}}</span>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li>
                                Current Call Courier Status
                                @if(is_array($response_courier))
                                    <pre style="display: none">
                                        {{print_r($response_courier)}}
                                    </pre>
                                    @foreach($response_courier as $courier)
                                        @if ($loop->last)
                                           <p class="text-dark">OperationDesc: <span class="text-primary">{{$courier['OperationDesc']}}</span></p>
                                           <p class="text-dark">ProcessDescForPortal: <span class="text-primary">{{$courier['ProcessDescForPortal']}}</span></p>
                                            <i class="text-info">Complete Details can be seen below</i>
                                        @endif
                                    @endforeach

                                @else
                                    <div class="response-courier text-danger">{!! $response_courier !!}</div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Amount Details</h5>
                        <ul class="view-details btn-clipboards">
                            <li>Cod Amount: <strong>{{$parcel_details->amount ? "PKR " .  number_format($parcel_details->amount, 1, '.', ',') : ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->amount ? "PKR " .  number_format($parcel_details->amount, 1, '.', ',') : ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Basic Delivery Charges: <strong>{{$parcel_details->t_basic_charges ? "PKR " .  number_format($parcel_details->t_basic_charges, 1, '.', ',') : ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->t_basic_charges ? "PKR " .  number_format($parcel_details->t_basic_charges, 1, '.', ',') : ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Booking Charges: <strong>{{$parcel_details->t_booking_charges ? "PKR " .  number_format($parcel_details->t_booking_charges, 1, '.', ',') : ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->t_booking_charges ? "PKR " .  number_format($parcel_details->t_booking_charges, 1, '.', ',') : ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Cash Handling: <strong>{{$parcel_details->t_cash_handling_charges ? "PKR " .  number_format($parcel_details->t_cash_handling_charges, 1, '.', ',') : ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->t_cash_handling_charges ? "PKR " .  number_format($parcel_details->t_cash_handling_charges, 1, '.', ',') : ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Packing Charges: <strong>{{$parcel_details->t_packing_charges ? "PKR " .  number_format($parcel_details->t_packing_charges, 1, '.', ',') : ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->t_packing_charges ? "PKR " .  number_format($parcel_details->t_packing_charges, 1, '.', ',') : ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            @php
                              $total_charges = $parcel_details->t_basic_charges + $parcel_details->t_booking_charges + $parcel_details->t_cash_handling_charges + $parcel_details->t_packing_charges;
                              $remaining_charges = $parcel_details->amount - ($parcel_details->t_basic_charges + $parcel_details->t_booking_charges + $parcel_details->t_cash_handling_charges + $parcel_details->t_packing_charges) ;
                            @endphp
                            <li>Total Delivery Charges: <strong>{{"PKR " . number_format($total_charges, 1, '.', ',')}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{"PKR " . number_format($total_charges, 1, '.', ',')}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Remaining Amount: <strong>{{"PKR " . number_format($remaining_charges, 1, '.', ',')}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{"PKR " . number_format($remaining_charges, 1, '.', ',')}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Consignee Details</h5>
                        @php
                        //    $addresslog = json_decode($parcel_details->binded_addresslog, true) ;
                        @endphp
                        {{-- <ul class="view-details btn-clipboards">
                            <li>Name: <strong>{{$addresslog['addresslog_info']['consignee_name'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['addresslog_info']['consignee_name'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Address: <strong>{{$addresslog['addresslog_info']['consignee_address'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['addresslog_info']['consignee_address'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Nearby: <strong>{{$addresslog['addresslog_info']['consignee_nearby_address']}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['addresslog_info']['consignee_nearby_address'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>City: <strong>{{$addresslog['city']['city_name'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['city']['city_name'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Estimated Delivery Time: <strong>{{$addresslog['city']['delivery_time'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['city']['delivery_time'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Customer Details</h5>
                        <ul class="view-details btn-clipboards">
                            <li>Name: <strong>{{$parcel_details->user->name ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->user->name ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Account Code: <strong>{{$parcel_details->user->account_code ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->user->account_code ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Email: <strong><a href="mailto:{{$parcel_details->user->email ?? ''}}">{{$parcel_details->user->email ?? ''}}</a></strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->user->email ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Address: <strong>{{$parcel_details->user->address ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->user->address ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Cnic: <strong>{{$parcel_details->user->cnic ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->user->cnic ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                            <li>Mobile: <strong><a href="tel:{{$parcel_details->user->mobile ?? ''}}">{{$parcel_details->user->mobile ?? ''}}</a></strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->user->mobile ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if(is_array($response_courier))
        <div class="row">
            <div class="col-12">
                    <h5 class="page-title">Call Courier Log</h5>
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ConsignmentNo   </th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>ContactNo</th>
                                    <th>ShipperName</th>
                                    <th>ShipperAddress</th>
                                    <th>TransactionDate</th>
                                    <th>OperationDesc</th>
                                    <th>ProcessDescForPortal</th>
                                    <th>ReceiverName</th>
                                    <th>Relation</th>
                                    <th>ReasonDesc</th>
                                    <th>IsPortalBooking</th>
                                    <th>HomeBranch</th>
                                    <th>DestBranch</th>
                                    <th>codAmount</th>
                                    <th>Weight</th>
                                    <th>Pcs</th>
                                    <th>ServiceType</th>
                                    <th>OriginCity</th>
                                    <th>MDNNo</th>
                                    <th>CallDate</th>
                                    <th>CallTime</th>
                                    <th>CallStatus</th>
                                    <th>CallRemarks</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($response_courier as $courier)
                                <tr>
                                    <td>{{$courier['ConsignmentNo']}}</td>
                                    <td>{{$courier['ConsigneeName']}}</td>
                                    <td>{{$courier['ConsigneeAddress']}}</td>
                                    <td>{{$courier['ConsigneeCity']}}</td>
                                    <td>{{$courier['ContactNo']}}</td>
                                    <td>{{$courier['ShipperName']}}</td>
                                    <td>{{$courier['ShipperAddress']}}</td>
                                    <td>{{$courier['TransactionDate']}}</td>
                                    <td>{{$courier['OperationDesc']}}</td>
                                    <td>{{$courier['ProcessDescForPortal']}}</td>
                                    <td>{{$courier['ReceiverName']}}</td>
                                    <td>{{$courier['Relation']}}</td>
                                    <td>{{$courier['ReasonDesc']}}</td>
                                    <td>{{$courier['IsPortalBooking']}}</td>
                                    <td>{{$courier['HomeBranch']}}</td>
                                    <td>{{$courier['DestBranch']}}</td>
                                    <td>{{$courier['codAmount']}}</td>
                                    <td>{{$courier['Weight']}}</td>
                                    <td>{{$courier['Pcs']}}</td>
                                    <td>{{$courier['ServiceType']}}</td>
                                    <td>{{$courier['OriginCity']}}</td>
                                    <td>{{$courier['MDNNo']}}</td>
                                    <td>{{$courier['CallDate']}}</td>
                                    <td>{{$courier['CallTime']}}</td>
                                    <td>{{$courier['CallStatus']}}</td>
                                    <td>{{$courier['CallRemarks']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        @endif
    </div>

</div><!-- Page Content -->
@stop
