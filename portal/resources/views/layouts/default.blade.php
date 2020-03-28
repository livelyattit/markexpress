<!doctype html>
<html lang="{{str_replace('-', '_', app()->getLocale())}}">
<head>
    @include('includes.head')
</head>
<body>
<div class="web-wrapper">
    <header>
        @include('includes.header')
    </header>
    <div id="main" class="row">
        @yield('content')
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
</div>

@include('includes.libraries')
</body>
</html>
