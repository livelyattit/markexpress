<!doctype html>
<html lang="{{str_replace('-', '_', app()->getLocale())}}">
<head>
    @include('includes.head')
</head>
<body class="js @isset($body_class) {{$body_class}} @endisset">
<div id="preloader"></div>
<div class="web-wrapper">
    <header>
        @include('includes.header')
    </header>
    <main id="main">
        @yield('content')
    </main>
    <footer>
        @include('includes.footer')
    </footer>
</div>

@include('includes.popup-enquire-now')
@include('includes.libraries')
</body>
</html>
