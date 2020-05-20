<section id="dashboard-header" class="customer-dashboard">


</section>

<section id="dashboard-parcels" class="customer-dashboard">

    <div class="container">
        <div class="customer-account-status-badge">
                <div style="background: rgb(17, 229, 141);" class="customer-account-badge">
                    Account: Active
                </div>

        </div>
        <div class="row">
            <div class="col-12">
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
                <div class="parcel-welcome">
                    <div class="parcel-welcome-header">
                        <h4>Welcome to <span class="logo-green">Mark</span> <span class="logo-blue">Express</span> <strong>{{ucwords($user_details->name)}}</strong></h4>
                        @if($user_details->addressLog->isEmpty() && $user_details->parcel->isEmpty())
                            <p class="no-parcel-note">You have not created any parcel yet. Feel free to get started with us.</p>
                        @else
                            <div class="create-parcel-btn-wrapper">
                                    <p>Get Started</p>
                                    <div class="btn-add-consignee-wrapper text-center">
                                        <a class="btn btn-info btn-round btn-outline-success btn-create-parcel" href="{{route('parcel.create')}}">Create the Parcel</a>
                                        <h6>OR</h6>
                                        <a class="btn btn-info btn-round btn-outline-success btn-add-consignee" href="{{route('address-log.create')}}">Add New Consignee</a>
                                    </div>
                            </div>

                        @endif
                        @if($user_details->addressLog->isEmpty())
                        <a href="{{route('address-log.create')}}">Add your Consignee Information</a>
                        @endif

                    </div>
                </div>
{{--                @if(!$user_details->parcel->isEmpty())--}}
{{--                    @foreach($user_details->parcel as $parcel)--}}
{{--                        @foreach($parcel->status as $status)--}}
{{--                            {{$status->status }}<br>--}}
{{--                        @endforeach--}}
{{--                    @endforeach--}}
{{--                @endif--}}



            </div>
        </div>
        @if(!$user_details->addressLog->isEmpty())
            <div class="row">
                <div class="col-12">
                    <h2 class="dashboard-heading">ADDRESS LOG</h2>
                    <div class="table-responsive">
                        <table id="addresslog_table" class="table table-bordered table-hover display responsive nowrap">
                            <thead>
                            <tr>
                                <th>Consignee Alias</th>
                                <th>Full Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Nearby</th>
                                <th>City (Delivery Time)</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        @endif

        @if(!$user_details->parcel->isEmpty())
            <div class="row">
                <div class="col-12">
                    <h2 class="dashboard-heading">PARCELS</h2>
                    <div class="table-responsive">
                        <table id="parcels_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Parcel No.</th>
                                <th>Current Status</th>
                                <th>Consignee</th>
                                <th>Created On</th>
                                <th>Address</th>
                                <th>Cod Amount</th>
                                <th>View</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        @endif


    </div>
</section>
