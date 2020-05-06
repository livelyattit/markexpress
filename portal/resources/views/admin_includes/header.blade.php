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

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="d-md-block d-lg-none nav-item">
                    <a class="nav-link search-link" href="#"><i class="material-icons">search</i></a>
                </li>
                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications_none</i>
                        <span class="badge">4</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dd-notifications" aria-labelledby="navbarDropdown">
                        <li class="notification-drop-title">Today</li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle cyan"><i class="material-icons">done</i></div>
                                    <div class="notification-text"><p><b>Alan Grey</b> uploaded new theme</p><span>7 min ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle deep-purple"><i class="material-icons">cached</i></div>
                                    <div class="notification-text"><p><b>Tom</b> updated status</p><span>14 min ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle red"><i class="material-icons">delete</i></div>
                                    <div class="notification-text"><p><b>Amily Lee</b> deleted account</p><span>28 min ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle cyan"><i class="material-icons">person_add</i></div>
                                    <div class="notification-text"><p><b>Tom Simpson</b> registered</p><span>2 hrs ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle green"><i class="material-icons">file_upload</i></div>
                                    <div class="notification-text"><p>Finished uploading files</p><span>4 hrs ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-drop-title">Yestarday</li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle green"><i class="material-icons">security</i></div>
                                    <div class="notification-text"><p>Security issues fixed</p><span>16 hrs ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle indigo"><i class="material-icons">file_download</i></div>
                                    <div class="notification-text"><p>Finished downloading files</p><span>22 hrs ago</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <div class="notification">
                                    <div class="notification-icon circle cyan"><i class="material-icons">code</i></div>
                                    <div class="notification-text"><p>Code changes were saved</p><span>1 day ago</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link right-sidebar-link" href="#"><i class="material-icons">more_vert</i></a>
                </li>
            </ul>
        </div>
    </nav>
</div><!-- Page Header -->

<div class="page-sidebar">
    <div class="page-sidebar-inner">
        <div class="page-sidebar-profile">
            <div class="sidebar-profile-image">
                <img src="../../assets/images/avatars/avatar1.png">
            </div>
            <div class="sidebar-profile-info">
                <a href="javascript:void(0);" class="account-settings-link">
                    <p>David Doe</p>
                    <span>david@gmail.com<i class="material-icons float-right">arrow_drop_down</i></span>
                </a>
            </div>
        </div>
        <div class="page-sidebar-menu">
            <div class="page-sidebar-settings hidden">
                <ul class="sidebar-menu list-unstyled">
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">inbox</i>Inbox</a></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">star_border</i>Starred</a></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">done</i>Sent Mail</a></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">history</i>History</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="waves-effect waves-grey"><i class="material-icons">exit_to_app</i>Sign Out</a></li>
                </ul>
            </div>
            <div class="sidebar-accordion-menu">
                <ul class="sidebar-menu list-unstyled">
                    <li>
                        <a href="index.html" class="waves-effect waves-grey active">
                            <i class="material-icons">settings_input_svideo</i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-grey">
                            <i class="material-icons">apps</i>Apps<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a href="app-mailbox.html">Mailbox</a></li>
                            <li><a href="app-file-manager.html">File Manager</a></li>
                            <li><a href="app-todo.html">Todo</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-grey">
                            <i class="material-icons">desktop_windows</i>Layouts<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a href="layout-blank.html">Blank Page</a></li>
                            <li><a href="layout-boxed.html">Boxed Layout</a></li>
                            <li><a href="layout-hidden-sidebar.html">Hidden Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-grey">
                            <i class="material-icons">code</i>Components<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a href="ui-alerts.html">Alerts</a></li>
                            <li><a href="ui-accordion.html">Accordion</a></li>
                            <li><a href="ui-badges.html">Badges</a></li>
                            <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                            <li><a href="ui-buttons.html">Buttons</a></li>
                            <li><a href="ui-button-group.html">Button Group</a></li>
                            <li><a href="ui-cards.html">Cards</a></li>
                            <li><a href="ui-code.html">Code</a></li>
                            <li><a href="ui-color.html">Color</a></li>
                            <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                            <li><a href="ui-icons.html">Icons</a></li>
                            <li><a href="ui-list-group.html">List Group</a></li>
                            <li><a href="ui-modal.html">Modal</a></li>
                            <li><a href="ui-pagination.html">Pagination</a></li>
                            <li><a href="ui-popovers.html">Popovers</a></li>
                            <li><a href="ui-progress.html">Progress</a></li>
                            <li><a href="ui-spinners.html">Spinners</a></li>
                            <li><a href="ui-tooltips.html">Tooltips</a></li>
                            <li><a href="ui-typography.html">Typography</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-grey">
                            <i class="material-icons">star_border</i>Plugins<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a href="plugins-code-editor.html">Code Editor</a></li>
                            <li><a href="plugins-nestable.html">Nestable List</a></li>
                            <li><a href="plugins-masonry.html">Masonry</a></li>
                            <li><a href="plugins-idle.html">Idle Timer</a></li>
                            <li><a href="plugins-image-crop.html">Image Crop</a></li>
                            <li><a href="plugins-image-zoom.html">Image Zoom</a></li>
                            <li><a href="plugins-select2.html">Select2</a></li>
                            <li><a href="plugins-plupload.html">Plupload</a></li>
                            <li><a href="plugins-toastr.html">Toastr</a></li>
                            <li><a href="plugins-range-sliders.html">Range Sliders</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="forms.html" class="waves-effect waves-grey">
                            <i class="material-icons">mode_edit</i>Forms
                        </a>
                    </li>
                    <li>
                        <a href="tables.html" class="waves-effect waves-grey">
                            <i class="material-icons">grid_on</i>Tables
                        </a>
                    </li>
                    <li>
                        <a href="charts.html" class="waves-effect waves-grey">
                            <i class="material-icons">trending_up</i>Charts
                        </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-grey">
                            <i class="material-icons">tag_faces</i>Extra Pages<i class="material-icons sub-arrow">keyboard_arrow_right</i>
                        </a>
                        <ul class="accordion-submenu list-unstyled">
                            <li><a href="pages-404.html">404</a></li>
                            <li><a href="pages-500.html">500</a></li>
                            <li><a href="pages-sign-in.html">Sign In</a></li>
                            <li><a href="pages-sign-up.html">Sign Up</a></li>
                            <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                            <li><a href="pages-coming-soon.html">Coming Soon</a></li>
                            <li><a href="pages-invoice.html">Invoice</a></li>
                            <li><a href="pages-pricing-tables.html">Pricing Tables</a></li>
                            <li><a href="pages-help-center.html">Help Center</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-footer">
            <p class="copyright">Stacks ©</p>
            <a href="#!">Privacy</a> &amp; <a href="#!">Terms</a>
        </div>
    </div>
</div><!-- Left Sidebar -->
