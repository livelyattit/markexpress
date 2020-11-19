        <div class="header-wrapper">
          <div class="header-secondary">
            <div class="container">
              <div class="row">
                <div class="col-12 text-center">
                @guest
                  <a class="logo-header" href="{{route('home')}}">
                    <img src="{{asset("assets/img/MARK-EXPRESS-LOGO.png")}}" />
                  </a>
                @else
                    <a class="logo-header" href="{{route('customer-dashboard')}}">
                        <img src="{{asset("assets/img/MARK-EXPRESS-LOGO.png")}}" />
                    </a>
                @endguest
                </div>
              </div>
              <div class="left-side">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><i class="fad fa-file-alt"></i><a data-toggle="modal" data-target="#enquire-now-modal" href="javascript:;">Enquire Now</a></li>
                        </ul>
                    </div>
                </div>
              </div>
              <div class="right-side">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><i class="fad fa-mobile"></i><a href="tel:03303271638">0330-3271638</a></li>
                            <li><i class="fad fa-envelope"></i><a href="mailto:hello@markexpress.pk">Hello@MarkExpress.Pk</a></li>
                        </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="header-primary">
            <div class="container">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                  @guest
                      <a class="navbar-brand" href="{{route('home')}}">Mark Express</a>
                  @else
                      <a class="navbar-brand" href="{{route('customer-dashboard')}}">Mark Express</a>
                  @endguest
                <button
                  class="navbar-toggler"
                  type="button"
                  data-toggle="collapse"
                  data-target="#navbarColor02"
                  aria-controls="navbarColor02"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor02">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item  {{Request::route()->getName() == 'home' ? 'active' : '' }}">
                      <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{Request::route()->getName() == 'about' ? 'active' : '' }}">
                      <a class="nav-link" href="{{route('home')}}#about-us-section">About</a>
                    </li>
                    <li class="nav-item {{Request::route()->getName() == 'contact' ? 'active' : '' }}">
                      <a class="nav-link" href="{{route('contact')}}">Contact</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" data-toggle="modal" data-target="#enquire-now-modal" href="javascript:;">Enquire Now</a>
                      </li>

                      @guest
                          <li class="nav-item {{Request::route()->getName() == 'login' ? 'active' : '' }}">
                              <a class="nav-link" href="{{route('login')}}">Login | Sign Up</a>
                          </li>
                      @else

                          @if(Auth::user()->role->name == 'customer')
                              <li class="nav-item dropdown">
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                      {{ ucwords(Auth::user()->name)}} <span class="caret"></span>
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item {{Request::route()->getName() == 'customer-dashboard' ? 'active' : '' }}" href="{{route('customer-dashboard')}}">Dashboard</a>
                                      <a class="dropdown-item {{Request::route()->getName() == 'customer-edit-profile' ? 'active' : '' }}" href="{{route('customer-edit-profile')}}">Edit Profile</a>
                                      <a class="dropdown-item" href="{{route('logout') }}"
                                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                              </li>
                          @elseif(Auth::user()->role->name == 'owner')
                              <li class="nav-item dropdown">
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                      {{ ucwords(Auth::user()->name)}} <span class="caret"></span>
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item {{Request::route()->getName() == 'admin-dashboard' ? 'active' : '' }}" href="{{route('admin-dashboard')}}">Admin Dashboard</a>
                                      <a class="dropdown-item" href="{{route('logout') }}"
                                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                              </li>


                          @endif

                      @endguest

                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
