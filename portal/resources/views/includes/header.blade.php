<div class="logo_menu" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-6">
                <div class="logo">
                    <a href="{{route('home')}}"><img src="{{asset('assets/img/logo.png')}}" alt="logo"></a>
                </div>
            </div>
            <div class="col-md-6 col-xs-6 col-md-offset-1 col-sm-7 col-lg-offset-1 col-lg-6 mobMenuCol">
                <nav class="navbar">
                    <ul class="nav navbar-nav navbar-right menu">
                        <li>
                            <a href="{{route('home')}}">home</a>
                        </li>
                        <li><a href="{{route('about')}}">about</a></li>
                        <li><a href="{{route('contact')}}">contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-4 col-lg-3 signup">
                <ul class="nav navbar-nav transparent-nav">
                    @guest
                    <li><a href="{{route('login')}}">login</a></li>
                    @if(Route::has('register'))
                    <li><a href="{{route('register')}}">sign up</a></li>
                    @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('customer-dashboard')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{route('customer-create-parcel')}}">Create Parcel</a>
                                <a class="dropdown-item" href="{{route('customer-edit-profile')}}">Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
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
        </div>
    </div>
</div>
