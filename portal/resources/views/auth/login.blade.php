@extends('layouts.default')

@section('content')
    <div style="display:none;" class="portal-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-centered">
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="cnic" class="col-md-4 col-form-label text-md-right">{{ __('Cnic No#') }}</label>

                                    <div class="col-md-6">
                                        <small><i>e.g 4XXXX-XXXXXXX-X</i></small>
                                        <input id="cnic" type="text" class="form-control @error('cnic') is-invalid @enderror" name="cnic" value="{{ old('cnic') }}" required autocomplete="cnic" autofocus>

                                        @error('cnic')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                                            <input type="text" class="form-control bod-0" id="signup-name" name="name" aria-describedby="Full Name" placeholder="Full Name" required="">
                                            <small id="nameHelp" class="form-text text-muted">The name should match your Cnic No.</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control bod-0" id="signup-email" name="email" aria-describedby="Email Address" placeholder="Email Address" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control bod-0" id="signup-mobile" name="mobile" aria-describedby="Mobile Number" placeholder="Mobile Number" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control bod-0" id="signup-cnic" name="cnic" aria-describedby="CNIC Number" placeholder="Cnic No#" required="">
                                            <small id="emailHelp" class="form-text text-muted">Enter CNIC in dashes format <strong><i>e.g 4XXXX-XXXXXXXX-X</i></strong></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control bod-0" id="signup-password-1" name="password" placeholder="Password" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control bod-0" id="signup-password-2" name="password_confirmation" placeholder="Confirm Password" required="">
                                        </div>
                                        <div class="row form-group align-items-center">
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-success btn-round">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="login">
                                    <form id="form-login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control bod-0" id="login_cnic" name="cnic" aria-describedby="CNIC Number" placeholder="Cnic No#" required="">
                                            <small id="emailHelp" class="form-text text-muted">Enter CNIC in dashes format <strong><i>e.g 4XXXX-XXXXXXXX-X</i></strong></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control bod-0" id="login_password" name="password" placeholder="Password" required="">
                                        </div>
                                        <div class="row form-group align-items-center">
                                            <div class="col">
                                                <div class="checkbox checkbox-info checkbox-circle">
                                                    <input name="remember" id="remember" class="styled" type="checkbox"  {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember">
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-dark btn-round btn-in-submit">Sign in</button>
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
