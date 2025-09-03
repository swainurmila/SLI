<!-- mt header style4 start here -->
<header id="mt-header" class="style4">
    <!-- mt bottom bar start here -->
    <div class="mt-bottom-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <!-- mt logo start here -->
                    <div class="mt-logo"><a href="#"><img src="{{asset('user-assets/images/SLI -logo.png')}}" alt="logo"></a></div>
                    <!-- mt icon list start here -->
                    <ul class="mt-icon-list">

                        @php
                            $cart_totals = App\Models\Training\TrAddToCart::where('user_id',Auth::user()->id)->count();
                        @endphp
                        <li >
                            <a href="{{route('training-user.cart')}}" class=" active">
                                <span class="icon-handbag"></span>
                                <span class="num">{{@$cart_totals > 0 ? @$cart_totals : ''}}</span>
                            </a>
                        </li>

                        


                        <li class="drop">
                            <a href="#" class="cart-opener active">
                                {{Auth::user()->first_name}}
                            </a>
                            <!-- mt drop start here -->
                            <div class="mt-drop">
                                <!-- mt drop sub start here -->
                                <div class="mt-drop-sub">
                                    <div class="mt-side-widget">
                                        <div class="cart-btn-row">
                                            <a class="btn-type3" href="{{route('training-user.profile')}}">My Profile</a>
                                        </div>
                                        <div class="cart-btn-row">
                                            <a class="btn-type3" href="{{route('training.logout')}}">Sign Out</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- mt drop sub end here -->
                            </div><!-- mt drop end here -->
                            <span class="mt-mdropover"></span>
                        </li>
                        {{-- <li><a href="{{route('training.logout')}}" class="btn btn-custom">Sign Out</a></li> --}}
                    </ul><!-- mt icon list end here -->
                    <!-- navigation start here -->
                    <nav id="nav">
                        <ul class="">
                            <li><a class="{{ request()->routeIs('training.list') ? 'active' : '' }}" href="{{route('training.list')}}">Training</a></li>
                        </ul>
                    </nav>
                    <!-- mt icon list end here -->
                </div>
            </div>
        </div>
    </div>
    <!-- mt bottom bar end here -->
    <span class="mt-side-over"></span>
</header><!-- mt header style4 end here -->