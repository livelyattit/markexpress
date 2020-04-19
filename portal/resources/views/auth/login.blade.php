@extends('layouts.default')

@section('content')

<div class="main-wrapper">

    <section id="login-section" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 text-center">
                    <img width="100%" class="delivery_boy" src="{{asset("assets/img/login-box.png")}}">
                </div>
                <div class="col-6">
                    <div class="tab-wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#signup" role="tab" data-toggle="tab">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#login" role="tab" data-toggle="tab">Login</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active show" id="signup">
                                <form id="form-signup">
                                    <div class="form-group">
                                        <input type="text" class="form-control bod-0" id="signup-name" name="name"
                                            aria-describedby="Full Name" placeholder="Full Name" required="">
                                        <small id="nameHelp" class="form-text text-muted">The name should match your
                                            Cnic No.</small>
                                            <div class="form-field-status form-field-name"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bod-0" id="signup-email" name="email"
                                            aria-describedby="Email Address" placeholder="Email Address" required="">
                                            <div class="form-field-status form-field-email"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bod-0" id="signup-mobile" name="mobile"
                                            aria-describedby="Mobile Number" placeholder="Mobile Number" required="">
                                            <div class="form-field-status form-field-number"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control bod-0" id="signup-cnic" name="cnic"
                                            aria-describedby="CNIC Number" placeholder="Cnic No#" required="">
                                        <small id="emailHelp" class="form-text text-muted">Enter CNIC in dashes format
                                            <strong><i>e.g 4XXXX-XXXXXXXX-X</i></strong></small>
                                            <div class="form-field-status form-field-cnic"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control bod-0" id="signup-password-1"
                                            name="password" placeholder="Password" required="">
                                            <div class="form-field-status" data-filter="password"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control bod-0" id="signup-password-2"
                                            name="password_confirmation" placeholder="Confirm Password" required="">
                                            <div class="form-field-status form-field-password"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-message">
                                            
                                        </div>
                                    </div>
                                    <div class="row form-group align-items-center">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success btn-round btn-in-submit btn-containing-loader">
                                                <div class="login-loader loader" style="display:none">
                                                    <img width="35" height="35"
                                                        src="{{asset('/assets/img/loader.gif')}}">
                                                </div>
                                                <span>Register</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="login">
                                <form id="form-login">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control bod-0" id="login_cnic" name="cnic"
                                            aria-describedby="CNIC Number" placeholder="Cnic No#" required="">
                                        <small id="emailHelp" class="form-text text-muted">Enter CNIC in dashes format
                                            <strong><i>e.g 4XXXX-XXXXXXXX-X</i></strong></small>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control bod-0" id="login_password"
                                            name="password" placeholder="Password" required="">
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info checkbox-circle">
                                            <input name="remember" id="remember" class="styled" type="checkbox"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-message">
                                            
                                        </div>
                                    </div>
                                    <div class="row form-group align-items-center">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success btn-round btn-in-submit btn-containing-loader">
                                                <div class="login-loader loader" style="display:none">
                                                    <img width="35" height="35"
                                                        src="{{asset('/assets/img/loader.gif')}}">
                                                </div>
                                                <span>Sign in</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection