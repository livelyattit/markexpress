        <div class="header-wrapper">
          <div class="header-secondary">
            <div class="container">
              <div class="row">
                <div class="col-12 text-center">
                  <a class="logo-header" href="#">
                    <img src="{{asset("assets/img/logo-header.jpg")}}" />
                  </a>
                </div>
              </div>
              <div class="left-side">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><i class="fad fa-box"></i><a href="#">Create Your Parcel</a></li>
                            <li><i class="fad fa-file-alt"></i><a data-toggle="modal" data-target="#enquire-now-modal" href="javascript:;">Enquire Now</a></li>
                        </ul>
                    </div>
                </div>
              </div>
              <div class="right-side">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><i class="fad fa-mobile"></i><a href="tel:03301234567">0330-1234567</a></li>
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
                <a class="navbar-brand" href="#">Mark Express</a>
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
                    <li class="nav-item active">
                      <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('contact')}}">Contact</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" data-toggle="modal" data-target="#enquire-now-modal" href="javascript:;">Enquire Now</a>
                      </li>

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login | Sign Up</a>
                    </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ ucwords(Auth::user()->name)}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('customer-dashboard')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{route('customer-create-parcel')}}">Create Parcel</a>
                                <a class="dropdown-item" href="{{route('customer-edit-profile')}}">Edit Profile</a>
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
                    @endguest
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>