@extends('layouts.default')

@section('content')
<div class="main-wrapper">

            <section id="dashboard-header" class="customer-dashboard">

            </section>
            <section id="dashboard-verification" class="customer-dashboard">

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            
                            <h2 class="first-time-name">Welcome {{ucwords($user_details->name)}}</h2>
                            <p>You need to verify your identity by submitting the scanned copies of:</p>
                            <ol>
                                <li>Cnic front</li>
                                <li>Recent Bill of (Elecrivity or Sui Gas)</li>
                            </ol>
                            <p><strong>Note:</strong> The retrievals of above copies retains a purpose to make sure the account is <valid class=""></valid></p>

                            <form  enctype="multipart/form-data" id="form-upload-bill" method="POST" action="{{route('file-upload-bill')}}" class="  form">
                                @csrf
                               
                                  <input name="file_bill" type="file" />
                                  <input name="submit_img" type="submit" value="submit" />
                                
                              </form>

                            <div class="row">
                                <div class="col-6">
                                    <div class="verification-uploader">
                                        
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="verification-uploader">
                                        <form  enctype="multipart/form-data"  id="form-upload-cnic" method="POST" action="{{route('file-upload-cnic')}}" class="dropzone from">
                                            @csrf
                                            <div class="fallback">
                                              <input name="file_cnic" type="file" />
                                            </div>
                                          </form>
                                    </div>
                                </div>
                            </div>
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

        </div>
@stop