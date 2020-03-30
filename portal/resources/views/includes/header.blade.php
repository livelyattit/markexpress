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
                        <li><a href="{{route('home')}}">services</a></li>
                        <li><a href="{{route('contact')}}">contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-4 col-lg-3 signup">
                <ul class="nav navbar-nav">
                    <li><a href="{{route('login')}}">login</a></li>
                    <li><a href="{{route('register')}}">sign up</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
