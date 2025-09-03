<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <h4>e-Office</h4>
                    </span>
                    <span class="logo-lg">
                        <h4>e-Office</h4>
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <h4>e-Office</h4>
                    </span>
                    <span class="logo-lg">
                        <h4>e-Office</h4>
                    </span>
                </a>
            </div>

            <button type="button"
                class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="uil-search"></span>
                </div>
            </form> --}}
            <div class="">
                {{-- <img src="assets/images/SLI -logo.png" alt="" class="ps-3"> --}}
                {{-- <img src="{{ asset('assets/images/SLI -logo.png') }}" alt="Header Avatar"> --}}
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset(Auth::guard('officer')->user()->profile_photo) }}" alt="Header Avatar">
                        
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Hi, {{Auth::guard('officer')->user()->first_name}}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('admin.office.viewprofile')}}"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">View Profile</span></a>
                    <form id="logout-form" action="{{ route('admin.training.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>

                    <a class="dropdown-item" id="logout-link" href="{{route('office.logout')}}">
                        <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">Sign out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>