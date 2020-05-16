<div class="page-header">
    <nav class="navbar navbar-expand primary">
        <section class="material-design-hamburger navigation-toggle">
            <a href="javascript:void(0)" data-activates="slide-out" class="button-collapse material-design-hamburger__icon">
                <span class="material-design-hamburger__layer"></span>
            </a>
        </section>
        <a class="navbar-brand" href="{{route('admin-dashboard')}}">MarkExpress</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</div><!-- Page Header -->

<div class="page-sidebar">
    <div class="page-sidebar-inner">
        <div class="page-sidebar-profile">

            <div class="sidebar-profile-info">
                <a href="javascript:void(0);" class="account-settings-link">
                    @if(Auth::check())
                        <p>{{Auth::user()->name}}</p>
                        <span>{{Auth::user()->email}}</span>
                    @endif
                </a>
            </div>
        </div>
        <div class="page-sidebar-menu">
            <div class="sidebar-accordion-menu">
                <ul class="sidebar-menu list-unstyled">
                    <li>
                        <a href="{{route('admin-dashboard')}}" class="waves-effect waves-grey active">
                            <i class="material-icons">settings_input_svideo</i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="waves-effect waves-grey">
                            <i class="material-icons">apps</i>Users<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a>All Users</a></li>
                            <li><a>Unverified Users</a></li>
                            <li><a>Create User</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0)" class="waves-effect waves-grey">
                            <i class="material-icons">dashboard</i>Parcels<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a>All Parcels</a></li>
                            <li><a>Create Parcel</a></li>
                            <li><a>Parcels Payment Due</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <p class="copyright">Mark Express © 2020</p>
            <a href="javascript:void(0)">Privacy</a> &amp; <a href="javascript:void(0)">Terms</a>
        </div>
    </div>
</div><!-- Left Sidebar -->
