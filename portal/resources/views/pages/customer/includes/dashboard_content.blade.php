<section id="dashboard-header" class="customer-dashboard">


</section>

<section id="dashboard-parcels" class="customer-dashboard">

    <div class="container">
        <div class="customer-account-status-badge">
                <div style="background: rgb(17, 229, 141);" class="customer-account-badge">
                    Account: Active
                </div>

        </div>
        <div class="row intro-section">
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
                <div class="row">
                    <div class="col-6">
                        <div class="parcel-welcome">
                            <div class="parcel-welcome-header">
                                <h6>WELCOME</h6>
                                <h1><strong>{{ucwords(Auth::user()->name)}}</strong></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        Chart Here
                    </div>
                </div>


            </div>
        </div>


        {{-- <h5 class="card-title">Personal Details</h5>
                        <div class="row">
                            <div class="col-6">
                                @isset(Auth::user()->personalData->bill_file_name)
                                    <div class="verification-uploaded">
                                        <h4>User Uploaded Bill Copy</h4>
                                        <img class="verification-img" src="{{route('content-customer',
                                 ['authid'=>Auth::user()->id,
                                 'location'=>'JP7gRq00',
                                    'filename'=>Auth::user()->personalData->bill_file_name
                                 ])}}">
                                    </div>

                                @endisset
                            </div>

                            <div class="col-6">
                                @isset(Auth::user()->personalData->cnic_file_name)
                                    <div class="verification-uploaded">
                                        <h4>Your Uploaded Cnic Copy</h4>
                                        <img class="verification-img" src="{{route('content-customer',
                                     ['authid'=>Auth::user()->id,
                                     'location'=>'lL3MgYsS',
                                        'filename'=>Auth::user()->personalData->cnic_file_name
                                     ])}}">
                                    </div>
                                @endisset
                            </div>
                        </div> --}}



        @if(!Auth::user()->parcel->isEmpty())
            <div class="row">
                <div class="col-4">
                    <div class="parcels-status-box today">
                        <h3>Today Parcels <span>{{$count_today_bookings}}</span></h3>

                    </div>
                </div>
                <div class="col-4">
                    <div class="parcels-status-box weekly">
                        <h3>Weekly Parcels <span>{{$count_weekly_bookings}}</span></h3>

                    </div>
                </div>
                <div class="col-4">
                    <div class="parcels-status-box monthly">
                        <h3>Monthly Parcels <span>{{$count_monthly_bookings}}</span></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="dashboard-heading">PARCELS</h2>
                    <div class="table-responsive">
                        <table id="parcels_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Created On</th>
                                <th>Parcel No.</th>
                                <th>Current Status</th>
                                <th>Consignee</th>
                                <th>City</th>
                                <th>Cod Amount</th>
                                <th>Total Delivery Charges</th>
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
