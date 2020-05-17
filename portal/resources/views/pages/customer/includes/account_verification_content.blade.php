<section id="dashboard-header" class="customer-dashboard">

</section>
<section id="dashboard-verification" class="customer-dashboard">
    <div class="container">
        <div class="customer-account-status-badge">
                <div style="background: rgb(255, 0, 0);" class="customer-account-badge">
                    Account: Identification Required
                </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="first-time-name">Welcome <strong>{{ucwords(Auth::user()->name)}}</strong></h2>
                <div class="verification-note">
                    <p>You need to verify your identity by submitting the scanned copies of:</p>
                    <ol>
                        <li>Cnic front</li>
                        <li>Recent Bill of (Electricity or Sui Gas)</li>
                    </ol>
                    <p><strong>Note:</strong> The retrievals of above copies retains a purpose to make sure the account is valid.</p>
                </div>

                <div class="row">
                    <div class="col-6">
                        @isset(Auth::user()->personalData->bill_file_name)
                            <div class="verification-uploaded">
                                <h4>Your Uploaded Bill Copy</h4>
                                <img class="verification-img" src="{{route('content',
                                 ['authid'=>Auth::user()->id,
                                 'location'=>'JP7gRq00',
                                    'filename'=>Auth::user()->personalData->bill_file_name
                                 ])}}">
                            </div>

                        @endisset
                        <div class="verification-uploader verification-uploader-bill">
                            <h3>Upload a copy of bill</h3>
                            <form  enctype="multipart/form-data"  id="form-upload-bill" method="POST" action="{{route('file-upload-bill')}}" class="dropzone from">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        @isset(Auth::user()->personalData->cnic_file_name)
                            <div class="verification-uploaded">
                                <h4>Your Uploaded Cnic Copy</h4>
                                <img class="verification-img" src="{{route('content',
                                     ['authid'=>Auth::user()->id,
                                     'location'=>'lL3MgYsS',
                                        'filename'=>Auth::user()->personalData->cnic_file_name
                                     ])}}">
                            </div>

                        @endisset
                        <div class="verification-uploader verification-uploader-cnic">
                            <h3>Upload a copy of cnic</h3>
                            <form  enctype="multipart/form-data"  id="form-upload-cnic" method="POST" action="{{route('file-upload-cnic')}}" class="dropzone from">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center verification-proceed-button-wrapper">
                            @if(Auth::user()->originality_verified == 0)
                                <form id="customer-verification-proceed-form" method="post" action="{{route('customer-verification-proceed')}}">
                                    @csrf
                                    <button class="btn btn-success btn-round btn-in-submit" type="submit">Proceed to Next Step</button>
                                    <div class="form-message"></div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
