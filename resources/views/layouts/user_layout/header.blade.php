<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Student | e-Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="e-Library" name="description" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('asset/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- App Css -->
    <link href="{{ asset('asset/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('asset/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <?php

    $notifications = App\Models\Notification::where('to_user_id', Auth::user()->id)->get();

    ?>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <h4>e-Library</h4>
                            </span>
                            <span class="logo-lg">
                                <h4>e-Library</h4>
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <h4>e-Library</h4>
                            </span>
                            <span class="logo-lg">
                                <h4>e-Library</h4>
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
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="uil-bell"></i>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="m-0 font-size-16"> Notifications </h5>
                                    </div>
                                    <div class="col-auto">
                                        {{-- <a href="#!" class="small"> Mark all as read</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                @foreach ($notifications as $not)
                                    <?php
                                    $givenDateTimeStr = $not->created_at;
                                    $givenDateTime = new DateTime($givenDateTimeStr);

                                    // Current date-time
                                    $currentDateTime = new DateTime();

                                    // Calculate the time difference
                                    $timeDifference = $currentDateTime->diff($givenDateTime);

                                    // Format the time difference for display
                                    $formattedDifference = '';

                                    if ($timeDifference->days > 0) {
                                        $formattedDifference .= $timeDifference->days . ' day(s) ';
                                    }

                                    if ($timeDifference->h > 0) {
                                        $formattedDifference .= $timeDifference->h . ' hour(s) ';
                                    }

                                    if ($timeDifference->i > 0) {
                                        $formattedDifference .= $timeDifference->i . ' minute(s) ';
                                    }

                                    ?>
                                    <a href="javascript:void(0);" class="text-dark notification-item">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <i class="uil-arrow-circle-right"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $not->message }}</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1"></p>
                                                    <p class="mb-0"> {{ $formattedDifference }}ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <div class="p-2 border-top">
                                <div class="d-grid">
                                    {{-- <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="uil-arrow-circle-right me-1"></i> View More..
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $user = DB::table('users')
                            ->where('id', Auth::user()->id)
                            ->first(['first_name', 'profile_photo']);
                    @endphp
                    @php
                        // dd(Auth::user()->email );
                        if (Auth::user()->role_id == 5) {
                            $email = Auth::user()->email;
                            $user_id = Auth::user()->id;
                        }
                    @endphp
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            // dd($user->profile_photo);
                            ?>
                            <img class="rounded-circle header-profile-user" src="{{ @$user->profile_photo }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Hi,
                                {{ @$user->first_name }}</span>
                            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{route('library.user.profile')}}"><i
                                    class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                                    class="align-middle">View Profile</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            {{-- <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Large modal</button> --}}
                            {{-- <a class="dropdown-item" id="change-password-link" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-lg" href="#">
                                <i class="uil uil-refresh font-size-18 align-middle text-muted me-1"></i> <span
                                    class="align-middle"> Reset Password</span>
                            </a> --}}
                            <a class="dropdown-item" id="logout-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                                <span class="align-middle">Sign out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @include('layouts.user_layout.sidebar')

        <div class="main-content">


            @yield('content')

        </div>
    </div>
    @include('layouts.user_layout.footer')
</body>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.change_password') }}" method='POST' id="resetPasswordForm">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-sm-12 col-lg-6">
                            <label class="form-label" for="">Password</label>
                            <input type="password" class="form-control form-valid" name="password" id="password"
                                placeholder="" >
                            @if ($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label class="form-label" for="">Confirm Password</label>
                            <input type="password" class="form-control form-valid password-valid"
                                name="password_confirmation" id="password_confirmation" placeholder="" >
                            @if ($errors->has('password_confirmation'))
                                <div class="error">{{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-light">Reset</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</html>

{{--  --}}
