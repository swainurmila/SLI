<header id="header-part">
    <div class="header-top d-none d-lg-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact text-lg-left text-center">
                        <ul>
                            <li><a href=""><span>Government Of Odisha</span></a></li>
                            <li><a href=""><span>ଓଡ଼ିଶା ସରକାର </span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">

                    <div class="header-contact text-lg-right text-center">

                        {{-- <div>
                            @foreach ($language as $item)
                            <a href="{{'/'.$item->lang_short_name.'/'.$current_lang_url }}" style="color: #fff;"><span>{{$item->lang_short_name == 'en' ? 'English' : 'Oriya'}}</span></a>

                            @endforeach
                        </div> --}}

                        {{-- <li class="top-links-item {{$current_lang_url == url('/') ? '/' : $current_lang_url}}"><a href="#">English</a>
                            <ul class="top-links-sub-menu">
                                @foreach ($language as $item)
                                <li class="top-links-item"><a href="{{'/'.$item->lang_short_name.'/'.$current_lang_url }}">{{$item->lang_short_name}}</a></li>
                                @endforeach

                            </ul>
                        </li> --}}
                        <ul>
                            <li>
                                @foreach ($language as $item)
                            <a href="{{'/'.$item->lang_short_name.'/'.$current_lang_url }}" class="lang_{{$item->lang_short_name}} clang" style="color: #fff;"><span>{{$item->lang_short_name == 'en' ? 'English' : 'Oriya'}}</span></a>
                            @endforeach
                            </li>

                            <li><a href="javascript:void(0)" onclick="scrollto('main_content')"><span>A-</span></a>
                            </li>
                            <li><a href="javascript:void(0)" onclick="scrollto('main_content')"><span>A</span></a>
                            </li>
                            <li><a href="javascript:void(0)" onclick="scrollto('main_content')"><span>A+</span></a>
                            </li>
                            <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-1"></div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header top -->

    <div class="header-logo-support pt-30"
        style="background: linear-gradient(90deg, rgb(255 255 255) 0%, rgb(217 255 239) 56%, rgb(213 255 246) 100%);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-10">
                    <div class="logo pb-30">
                        <a href="index.html">
                            <img src="{{asset('assets/frontend/images/lgo1.png')}}" alt="Logo">
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="logo d-none d-md-block float-lg-right">
                        <a>
                            <img src="{{asset('assets/frontend/images/odisha2.png')}}" alt="Logo" style="margin-top: 10px;">
                        </a>
                    </div>
                </div>


            </div><!-- row -->
        </div><!-- container -->
    </div><!-- header logo support -->


    @include('frontend.layouts.menu')

</header>
