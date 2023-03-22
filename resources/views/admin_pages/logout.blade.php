@extends('admin_layouts.default')
@section('content')

<style>
    .page-content {
        padding: 85px 25px 50px 25px;
    }
</style>
<div class="page-content">

    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <h3>Sign out to Mark Express</h3>
                        <h6>{{route('admin-logout') }}</h6>
                        <a class="waves-effect waves-danger" href="{{route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- Page Content -->
@stop
