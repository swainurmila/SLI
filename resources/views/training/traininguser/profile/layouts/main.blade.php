@extends('training.layouts.user-page-layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('user-assets/css/profile-style.css') }}">
@endsection
@section('content')

    @php
        $user = App\Models\User::with('trainingOrders')->where('id',Auth::user()->id)->first();
    @endphp

    <div class="dashboardarea sp_bottom_100">
        <div class="dashboard">
            <div class="container-fluid">
                <div class="row profile-user-content">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="dashboard__inner sticky-top" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <div class="dashboard__nav__title">
                                <h6>Welcome, {{@$user->first_name}} {{@$user->last_name}} </h6>
                            </div>
                            @include('training.traininguser.profile.layouts.sidebar')

                        </div>
                    </div>
                    @yield('profile-content')


                </div>
            </div>
        </div>
    </div>
@endsection
