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
                        $cartCount = \App\Models\Course\CrCourseCart::getCheckoutCourseLists();
                    @endphp
                    <nav id="nav">
                        <ul class="">
                            <li><a class="{{ request()->routeIs('user.course.home') ? 'active' : '' }}" href="{{route('user.course.home')}}">Home</a></li>

                            <li><a class="{{ request()->routeIs('user.course.list') ? 'active' : '' }}" href="{{route('user.course.list')}}">Course</a></li>
                            <li >
                                <a href="{{route('user.course.showCart')}}" class="">
                                    {{-- <i class="fa fa-shopping-cart bag-cart" aria-hidden="true"></i> --}}
                                    <i class="fa fa-heart wishlist-icon" style="font-size: 24px" aria-hidden="true"></i>
                                    <span class="num">{{count(@$cartCount)}}</span>
                                </a>
                            </li>
                            <li class="cart-btn-row">
                                <a class="btn-type3" href="{{route('user.course.logout')}}">Log Out</a>
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