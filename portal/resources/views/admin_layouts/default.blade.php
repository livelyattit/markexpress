<!DOCTYPE html>
<html lang="en">
<head>
@include('admin_includes.head')
</head>
<body>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="alpha-app">
@include('admin_includes.header')

    @yield('content')

@include('admin_includes.right_side')

</div><!-- App Container -->
@include('admin_includes.libraries')
</body>
</html>
