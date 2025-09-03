<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{asset('assets/backend/img/logo.png')}}" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{asset('assets/backend/img/demo/avatars/avatar-admin.png')}}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                       Oasys Tech Solutions
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Samanta Vihar,Near Kalinga Hospital</span>
            </div>
            <img src="{{asset('assets/backend/img/card-backgrounds/cover-2-lg.png')}}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            <li class="active open">
                <a href="#" title="Dashboard">
                    <i class="fad fa-info-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('home')}}" title="Dashboard Home">
                            <span class="nav-link-text">Home</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#" title="Documentation" data-filter-tags="Pages">
                    <i class="fad fa-file-spreadsheet"></i>
                    <span class="nav-link-text" data-i18n="nav.pages">Pages</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('page.index')}}" title="General Docs" data-filter-tags="all pages">
                            <span class="nav-link-text" data-i18n="nav.all_pages">All Pages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('page.add')}}" title="Project Structure" data-filter-tags="new page">
                            <span class="nav-link-text" data-i18n="nav.new_page">New page</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('page.template')}}" title="Project Structure" data-filter-tags="new page">
                            <span class="nav-link-text" data-i18n="nav.new_page">Page Template</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#" title="Documentation" data-filter-tags="Pages">
                    <i class="fad fa-file-spreadsheet"></i>
                    <span class="nav-link-text" data-i18n="nav.pages">Posts</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('post.index')}}" title="General Docs" data-filter-tags="all pages">
                            <span class="nav-link-text" data-i18n="nav.all_pages">All Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('post.create')}}" title="Project Structure" data-filter-tags="new page">
                            <span class="nav-link-text" data-i18n="nav.new_page">New Post</span>
                        </a>
                    </li>


                </ul>
            </li>

            {{-- <li class="nav-title">Users</li>
            <li>
                <a href="#" title="UI Components" data-filter-tags="ui components">
                    <i class="fad fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_components">users</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('user.index')}}" title="Alerts" data-filter-tags="ui components alerts">
                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">All Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Add New User</span>
                        </a>
                    </li>

                </ul>
            </li> --}}

            {{-- <li>
                <a href="#" title="UI Components" data-filter-tags="ui components">
                    <i class="fad fa-users-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_components">Roles</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('role.index')}}" title="Alerts" data-filter-tags="ui components alerts">
                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">All Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Add New Roles</span>
                        </a>
                    </li>

                </ul>
            </li> --}}


            <li class="nav-title">Settings</li>
            <li>
                <a href="#" title="UI Components" data-filter-tags="ui components">
                    <i class="fad fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_components">Settings</span>
                </a>
                <ul>
                    {{-- <li>
                        <a href="{{route('header')}}" title="Alerts" data-filter-tags="ui components alerts">
                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts"> Header</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ url('header') }}" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Header</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('footer') }}" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Footer</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('menu.index')}}" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Menus</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="Authentication" data-filter-tags="pages authentication">
                            <span class="nav-link-text" data-i18n="nav.pages_authentication">Slider</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('slider.index')}}" title="Forget Password" data-filter-tags="pages authentication forget password">
                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_forget_password">All Slider</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('slider.create')}}" title="Locked Screen" data-filter-tags="pages authentication locked screen">
                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_locked_screen">Add New</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="Authentication" data-filter-tags="pages authentication">
                            <span class="nav-link-text" data-i18n="nav.pages_authentication">Gallery</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('gallery.index')}}" title="Forget Password" data-filter-tags="pages authentication forget password">
                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_forget_password">All Gallery</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('gallery.create')}}" title="Locked Screen" data-filter-tags="pages authentication locked screen">
                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_locked_screen">Add New</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>

            </li>
            <li>
                <a href="#" title="UI Components" data-filter-tags="ui components">
                    <i class="fad fa-language"></i>
                    <span class="nav-link-text" data-i18n="nav.ui_components">Language</span>
                </a>
                <ul>
                    <li>
                        <a href="{{route('lang.index')}}" title="Alerts" data-filter-tags="ui components alerts">
                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts"> all language</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('lang.create')}}" title="Accordions" data-filter-tags="ui components accordions">
                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">add language</span>
                        </a>
                    </li>


                </ul>
            </li>

        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
