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
                <div class="d-flex">
                    <a href="{{route('admin-parcel', ['edit',$parcel_details->id ])}}" class="m-2 p-2 btn-edit-user btn btn-outline-info btn-sm btn-icon w-50"><span class="material-icons">edit</span>Edit</a>
                    <a href="javascript:void(0)" data-url="{{route('admin-parcel', ['delete',$parcel_details->id ])}}" class="m-2 p-2 btn-delete-parcel btn btn-outline-danger btn-sm btn-icon w-50"><span class="material-icons">report_problem</span>Delete</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Parcel Details</h5>
                                <ul class="view-details btn-clipboards">
                                    <li>Parcel #: <strong>{{$parcel_details->assigned_parcel_number ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->assigned_parcel_number ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>CN #: <strong>{{$parcel_details->assigned_tracking_number ?? 'Not Set'}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$parcel_details->assigned_tracking_number ?? 'Not Set'}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Amount Details</h5>
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
                    <div class="col-6">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Consignee Details</h5>
                                @php
                                    $addresslog = json_decode($parcel_details->binded_addresslog, true) ;
                                @endphp
                                <ul class="view-details btn-clipboards">
                                    <li>Name: <strong>{{$addresslog['addresslog_info']['consignee_name'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['addresslog_info']['consignee_name'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Address: <strong>{{$addresslog['addresslog_info']['consignee_address'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['addresslog_info']['consignee_address'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Nearby: <strong>{{$addresslog['addresslog_info']['consignee_nearby_address']}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['addresslog_info']['consignee_nearby_address'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>City: <strong>{{$addresslog['city']['city_name'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['city']['city_name'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Estimated Delivery Time: <strong>{{$addresslog['city']['delivery_time'] ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$addresslog['city']['delivery_time'] ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                </ul>
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
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
