@extends('admin_layouts.default')
@section('content')
<div class="page-content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5 class="page-title">User</h5>
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
                <h4 class="text text-dark">{{ucwords($user_details->name)}} # {{$user_details->account_code}}</h4>
            </div>
            <div class="col-6">
                <div class="d-flex">
                    <a href="{{route('admin-parcel', ['create',$user_details->id ])}}" class="m-2 p-2 btn-edit-user btn btn-outline-primary btn-sm btn-icon w-50"><span class="material-icons">control_point_duplicate</span>New Parcel</a>
                    <a href="{{route('admin-user', ['edit',$user_details->id ])}}" class="m-2 p-2 btn-edit-user btn btn-outline-info btn-sm btn-icon w-50"><span class="material-icons">edit</span>Edit</a>
                    <a href="javascript:void(0)" data-url="{{route('admin-user', ['delete',$user_details->id ])}}" class="m-2 p-2 btn-delete-user btn btn-outline-danger btn-sm btn-icon w-50"><span class="material-icons">report_problem</span>Delete</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Basic Details</h5>
                                <ul class="view-details btn-clipboards">
                                    <li>Name: <strong>{{$user_details->name ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->name ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Account Code: <strong>{{$user_details->account_code ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->account_code ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Email: <strong><a href="mailto:{{$user_details->email ?? ''}}">{{$user_details->email ?? ''}}</a></strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->email ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Address: <strong>{{$user_details->address ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->address ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Cnic: <strong>{{$user_details->cnic ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->cnic ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Mobile: <strong><a href="tel:{{$user_details->mobile ?? ''}}">{{$user_details->mobile ?? ''}}</a></strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->mobile ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5 class="card-title">Business Details</h5>
                                <ul class="view-details btn-clipboards">
                                    <li>Business Name: <strong>{{$user_details->accountDetail->business_name ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->accountDetail->business_name ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Shipment Quantity: <strong>{{$user_details->accountDetail->shipment_quantity ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->accountDetail->shipment_quantity ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Bank Name: <strong>{{$user_details->accountDetail->bank_name ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->accountDetail->bank_name ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Bank Account Title: <strong>{{$user_details->accountDetail->bank_account_title ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->accountDetail->bank_account_title ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                    <li>Bank Account Number: <strong>{{$user_details->accountDetail->bank_account_number ?? ''}}</strong> <button type="button" class="btn btn-default btn-copy js-tooltip js-copy btn-xs" data-toggle="tooltip" data-placement="bottom" data-copy="{{$user_details->accountDetail->bank_account_number ?? ''}}" title="Copy to clipboard"><span class="material-icons">file_copy</span></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card info-card">
                    <div class="card-body">
                        <h5 class="card-title">Personal Details</h5>
                        <div class="row">
                            <div class="col-6">
                                @isset($user_details->personalData->bill_file_name)
                                    <h4>Uploaded Bill Copy</h4>
                                    <div class="verification-uploaded">
                                        <img class="verification-img" src="{{route('content-admin',
                                 ['authid'=>$user_details->id,
                                 'location'=>'JP7gRq00',
                                    'filename'=>$user_details->personalData->bill_file_name
                                 ])}}">
                                    </div>

                                @endisset
                            </div>
                            <div class="col-6">
                                @isset($user_details->personalData->cnic_file_name)
                                    <h4>Uploaded Cnic Copy</h4>
                                    <div class="verification-uploaded">

                                        <img class="verification-img" src="{{route('content-admin',
                                     ['authid'=>$user_details->id,
                                     'location'=>'lL3MgYsS',
                                        'filename'=>$user_details->personalData->cnic_file_name
                                     ])}}">
                                    </div>

                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
