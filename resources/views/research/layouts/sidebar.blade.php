 <div class="vertical-menu">
    <div class="d-flex">
        <div class="navbar-brand-box ps-2">
            <a href="#" class="logo logo-light">
                <span class="logo-sm ps-2">
                    <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="50">
                </span>

                <span class="logo-lg">
                    <div class="d-flex">
                        <span>
                            <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                        </span>
                        <span class="ms-2">
                            <h6 class="logo-text">State Labour Institute</h6>
                            <span class="logo-sm-text">Research Publication</span>
                        </span>
                    </div>
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-1 font-size-16 header-item waves-effect vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
        </button>
    </div>

    <div data-simplebar class="sidebar-menu-scroll">

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('research.admin.dashboard')}}" class="">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                @if (Auth::user()->role_id == 12)

                    @role('Research Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-user-circle"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{route('research.admin.role.index')}}" class="">
                                    <i class="fas fa-hand-point-right font-size-1"></i>
                                    <span>Roles</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('research.user.index')}}" class="">
                                    <i class="fas fa-hand-point-right font-size-1"></i>
                                    <span>Users</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-store"></i>
                            <span>Master</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">

                            <li>
                                <a href="{{route('cat-sub-master')}}" class=""><i class="fas fa-hand-point-right font-size-12"></i>
                                    Category subject
                                </a>
                            </li>
                            <li>
                                <a href="{{route('research.admin.certificate.index')}}" class=""><i
                                        class="fas fa-hand-point-right font-size-12"></i>Certificate</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('research.notification.index')}}" class="">
                            <i class="fas fa-bell"></i>
                            <span>Paper Notification</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('research.admin.submitted-papers.index')}}" class="">
                            <i class="fas fa-paper-plane"></i>
                            <span>Submitted Papers</span>
                        </a>
                    </li>
                    @endrole
                @endif

                @if (Auth::user()->role_id == 13)

                    @role('Research User')
                        <li>
                            <a href="{{route('research.admin.paper.index')}}" class="">
                                <i class="fas fa-tasks"></i>
                                <span>Submit Paper</span>
                            </a>
                        </li>
                    @endrole
                @endif

            </ul>
        </div>
    </div>
</div>
