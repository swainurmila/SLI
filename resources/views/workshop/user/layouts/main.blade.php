@extends('workshop.layouts.user.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('user-assets/css/profile-style.css') }}">
    <link rel="stylesheet" href="{{ asset('user-assets/css/icofont.min.css') }}">
@endsection
@section('content')
@php
$user = App\Models\User::find(Auth::user()->id);
@endphp
    <div class="dashboardarea sp_bottom_100">
        <div class="dashboard">
            <div class="container-fluid">
                <div class="row profile-user-content">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="dashboard__inner sticky-top"
                            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="dashboard__nav__title">
                                {{-- {{dd( $user)}} --}}
                                <h6>Welcome, {{ @$user->user_name }} </h6>
                            </div>
                            @include('workshop.user.layouts.sidebar')

                        </div>
                    </div>

                    @yield('profile-content')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endsection
