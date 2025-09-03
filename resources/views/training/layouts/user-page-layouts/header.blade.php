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
                    <!-- navigation start here -->

                    @php
                        $cartLists = App\Models\Training\TrAddToCart::where('user_id',Auth::user()->id)->get();
                    @endphp
                    <nav id="nav">
                        <ul class="">
                            <li><a class="{{ request()->routeIs('training-user.profile') ? 'active' : '' }}" href="{{route('training-user.profile')}}">Home</a></li>

                            <li><a class="{{ request()->routeIs('training.list') ? 'active' : '' }}" href="{{route('training.list')}}">Training</a></li>
                            <li >
                                <a href="{{route('training-user.cart')}}" class="">
                                    {{-- <i class="fa fa-shopping-cart bag-cart" aria-hidden="true"></i> --}}
                                    <i class="fa fa-heart wishlist-icon" style="font-size: 24px" aria-hidden="true"></i>

                                    <span class="num">{{count(@$cartLists)}}</span>
                                </a>
                            </li>
                            <li class="cart-btn-row">
                                <a class="btn-type3" href="{{route('training.logout')}}">Log Out</a>

                            </li>
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
