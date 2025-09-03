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
                        $cartCount = \App\Models\Workshop\WsAddToCart::getCheckoutWorkshopLists();
                    @endphp
                    <nav id="nav">
                        <ul class="">
                            <li><a class="{{ request()->routeIs('workshop.user.dashboard') ? 'active' : '' }}" href="{{route('workshop.user.dashboard')}}">Dashboard</a></li>

                            <li><a class="{{ request()->routeIs('user.workshop.list') ? 'active' : '' }}" href="{{route('user.workshop.list')}}">Workshop</a></li>
                            <li >
                                <a href="{{route('user.workshop.showCart')}}" class="">
                                    <i class="fa fa-shopping-cart bag-cart" aria-hidden="true"></i>
                                    <span class="num">{{count(@$cartCount)}}</span>
                                </a>
                            </li>
                            <li class="cart-btn-row">
                                {{-- <a class="btn-type3" href="{{route('workshop.user.logout')}}">Sign Out</a> --}}
                                <form id="logout-form" action="{{ route('workshop.user.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" id="logout-link" href="#" class="btn-type3"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                                <span class="align-middle">Log out</span>
                            </a>

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
