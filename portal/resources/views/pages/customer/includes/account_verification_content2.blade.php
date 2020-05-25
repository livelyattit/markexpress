<section id="dashboard-header" class="customer-dashboard">

</section>
<section id="dashboard-verification" class="customer-dashboard">
    <div class="container">
        <div class="customer-account-status-badge">
                <div style="background: rgb(255, 212, 0);" class="customer-account-badge">
                    Account: Business Information Required
                </div>

        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="first-time-name">Welcome <strong>{{ucwords(Auth::user()->name)}}</strong></h2>
                <div class="verification-note">
                    <p>You need to enter your business/personal details:</p>
                    <ol>
                        <li>All fields are required.</li>
                        <li>This information will be used to ship the parcel with your given details and handle all transactions.</li>
                    </ol>
                    <p><strong>Note:</strong> The retrievals of collected information will be kept securely and will not be shared with anyone except what described in above point.</p>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="business-information-proceed-wrapper form-wrapper">
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
                            <form onsubmit=" var cc = document.querySelector('.btn-in-submit');cc.setAttribute('disabled', 'disabled');cc.innerHTML='Please Wait..'" id="customer-business-information-proceed-form" class="form-in" method="post" action="{{route('customer-business-information-proceed')}}">
                                @csrf
                                <h4>Business/Personal Details</h4>
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input required value="{{old('business_name')}}" type="text" class="bod form-control" name="business_name" placeholder="Your Business Name">
                                    @if($errors->has('business_name'))
                                        <span class="alert alert-danger">{{$errors->first('business_name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Approx Daily Shipment Quantity</label>
                                    <input min="1" step="1" required value="{{old('shipment_quantity')}}" type="number" class="bod form-control" name="shipment_quantity" placeholder="Number of Shipments">
                                    @if($errors->has('shipment_quantity'))
                                        <span class="alert alert-danger">{{$errors->first('shipment_quantity')}}</span>
                                    @endif
                                </div>
                                <h4>Bank Account Details</h4>
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input required value="{{old('bank_name')}}" type="text" class="bod form-control" name="bank_name" placeholder="Your Bank Name">
                                    @if($errors->has('bank_name'))
                                        <span class="alert alert-danger">{{$errors->first('bank_name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Bank Account Title</label>
                                    <input  required value="{{old('bank_account_title')}}" type="text" class="bod form-control" name="bank_account_title" placeholder="Your Bank Account Title">
                                    @if($errors->has('bank_account_title'))
                                        <span class="alert alert-danger">{{$errors->first('bank_account_title')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Bank Account Number With Branch Code Or IBAN Number 24 Digits</label>
                                    <input min="1" step="1" required value="{{old('bank_account_number')}}" type="text" class="bod form-control" name="bank_account_number" placeholder="Your Bank Account No. Or IBAN">
                                    @if($errors->has('bank_account_number'))
                                        <span class="alert alert-danger">{{$errors->first('bank_account_number')}}</span>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-success btn-round btn-in-submit" type="submit">Submit</button>
                                </div>

                                <div class="form-message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
