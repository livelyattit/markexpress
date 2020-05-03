<section id="dashboard-header" class="customer-dashboard">

</section>

<section id="dashboard-parcels" class="customer-dashboard">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="parcel-welcome">
                    <div class="parcel-welcome-header">
                        <h4>Welcome to <span class="logo-green">Mark</span> <span class="logo-blue">Express</span> <strong>{{ucwords($user_details->name)}}</strong></h4>
                        @if($user_details->parcel->isEmpty())
                            <p class="no-parcel-note">You have not created any parcel yet. Feel free to get started with us.</p>
                            <a href="{{route('address-log.create')}}">Create your first Consignee Information</a>
                        @endif
                    </div>
                </div>
                @if(!$user_details->parcel->isEmpty())
                    @foreach($user_details->parcel as $parcel)
                        @foreach($parcel->status as $status)
                            {{$status->status }}<br>
                        @endforeach
                    @endforeach
                @endif



            </div>
        </div>
    </div>
</section>
