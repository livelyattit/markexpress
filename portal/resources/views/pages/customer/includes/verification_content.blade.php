<section id="dashboard-header" class="customer-dashboard">

</section>
<section id="dashboard-verification" class="customer-dashboard">
    <div class="container">
        <div class="customer-account-status-badge">
            @if(Auth::user()->originality_verified == 0)
                <div style="background: rgb(255, 0, 0);" class="customer-account-badge">
                    Account: Waiting for confirmation
                </div>
            @elseif(Auth::user()->originality_verified == 1)
                <div style="background: rgb(255, 212, 0);" class="customer-account-badge">
                    Account: In proceeding for confirmation
                </div>
            @elseif(Auth::user()->originality_verified == 2)
                <div style="background: rgb(17, 229, 141);" class="customer-account-badge">
                    Account: Active
                </div>
            @endif

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

                @if(isset(Auth::user()->personalData->bill_file_name )
                            && isset(Auth::user()->personalData->cnic_file_name)
                            && Auth::user()->originality_verified == 1
                            )
                    <div class="row">
                        <div class="col-12">
                            <div class="verification-uploaded-note">
                                <h4><strong>ThankYou!</strong> We successfully got your data. </h4>
                                <ol>
                                    <li>Mark Express is registered with <strong>FBR</strong>. For security reasons we need to ensure that we are working with valid customers.</li>
                                    <li>The purpose of the collected data is to retain the originality of our new and existing customers.</li>
                                    <li>The collected data will not be used anywhere for any reason by Mark Express.</li>
                                    <li>You can still change the copies you uploaded if you think you entered the ones before we start confirming your account.</li>
                                    <li>This screen will be disappeared after we process your account.</li>
                                    <li>If we found anything mismatched, the result will be in account deletion.</li>
                                    <li>You may receive a call for further confirmations as well.</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                @endisset
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
                                    <button class="btn btn-info btn-round btn-in-submit" type="submit">Proceed to verify</button>
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
