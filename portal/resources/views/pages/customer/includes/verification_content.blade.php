<section id="dashboard-header" class="customer-dashboard">

</section>
<section id="dashboard-verification" class="customer-dashboard">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="first-time-name">Welcome <strong>{{ucwords(Auth::user()->name)}}</strong></h2>
                <div class="verification-note">
                    <p>You need to verify your identity by submitting the scanned copies of:</p>
                    <ol>
                        <li>Cnic front</li>
                        <li>Recent Bill of (Elecrivity or Sui Gas)</li>
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
                @isset(Auth::user()->personalData->bill_file_name , Auth::user()->personalData->cnic_file_name )
                    <div class="row">
                        <div class="col-12">
                            <div class="verification-uploaded-note">
                                <h4>This screen will be disappeared once your content gets verified by us. You may receive a call for further confirmations as well. </h4>
                            </div>

                        </div>
                    </div>
                @endisset
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

            </div>
        </div>
    </div>
</section>
