<section id="dashboard-header" class="customer-dashboard">


</section>

<section id="dashboard-parcels" class="customer-dashboard">

    <div class="container">
        <div class="customer-account-status-badge">
            <div style="background: rgb(17, 229, 141);" class="customer-account-badge">
                Account: Active
            </div>

        </div>
        <div class="intro-section">
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
                <div class="col-4">
                    <div class="parcel-welcome">
                        <div class="parcel-welcome-header">
                            <h6>WELCOME</h6>
                            <h1><strong>{{ucwords(Auth::user()->name)}}</strong></h1>
                            <div class="row">
                                <div class="col-12">
                                    <div class="parcels-status-box today">
                                        <h5>Today Parcels: <strong>{{$dashboard['count_today_bookings']}}</strong></h5>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="parcels-status-box weekly">
                                        <h5>Weekly Parcels: <strong>{{$dashboard['count_weekly_bookings']}}</strong></h5>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="parcels-status-box monthly">
                                        <h5>Monthly Parcels: <strong>{{$dashboard['count_monthly_bookings']}}</strong></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <canvas id="myChart" width="300" height="200"></canvas>
                </div>
                <div class="col-4">
                    <h6>WEEKLY SHIPMENTS STATUS</h6>
                    <ul class="weekly-parcels-status">
                        @foreach ($dashboard['weekly_bookings'] as $booking)
                            <li>
                            <a href="{{route('parcel.show', $booking->id)}}">
                                    <div class="parcel-no">Shipment No. {{$booking->assigned_parcel_number}}</div>
                                    <div class="date">{{$booking->created_at->format('d-m-Y')}}</div>
                                    <div class="current-status">Current Status: <span>{{$booking->current_last_status}}</span></div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div id="dashboard_counters">
            <div class="row">
            <div class="col-3">{{$dashboard['parcels_created']}}</div>
                <div class="col-3">{{$dashboard['parcels_created']}}</div>
                <div class="col-3">{{$dashboard['parcels_created']}}</div>
                <div class="col-3">{{$dashboard['parcels_created']}}</div>
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
        <div class="col-12">
            <h2 class="dashboard-heading">PARCELS</h2>
            <form method="POST" id="search-form" class="form-inline" role="form">

                <div class="form-group">
                    <label for="name">From</label>
                    <input type="text" autocomplete="off" class="form-control" name="from" id="from"
                        placeholder="search From">
                </div>
                <div class="form-group">
                    <label for="email">To</label>
                    <input type="text" autocomplete="off" class="form-control" name="to" id="to"
                        placeholder="search To">
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
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
