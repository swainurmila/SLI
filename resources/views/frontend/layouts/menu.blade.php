<div class="theme-menu-wrapper">
    <div class="container-fluid">
        <div class="bg-wrapper clearfix">
            <!-- ============== Menu Warpper ================ -->
            <div class="menu-wrapper float-left">
                <nav id="mega-menu-holder" class="clearfix">
                    <ul class="clearfix">
                        @if ($menu == [])
                            <li class="active"><a href="/">Home</a>
                            </li>
                        @else
                            @foreach ($menu as $item)
                                <li><a href="{{ route('web.inner', [$lang, $item->slug]) }}">{{ MenuItem($item->id, 'name', url()->current() == '/' ? $lang : $lang) != '' ? MenuItem($item->id, 'name', url()->current() == '/' ? $lang : $lang) : MenuItem($item->id, 'title', url()->current() == '/' ? $lang : $lang) }}

                                        {!! $item->children[0] != [] ? '<i class="fa fa-angle-down" aria-hidden="true"></i>' : '' !!}

                                    </a>
                                    @if (!empty($item->children[0]))
                                        <ul class="dropdown">
                                            @foreach ($item->children[0] as $child)
                                                <li>
                                                   
                                                    <a
                                                        href="{{ Illuminate\Support\Str::startsWith($child->slug, ['http://', 'https://']) ? $child->slug : route('web.inner', [$lang, $child->slug]) }}">{{ MenuItem($child->id, 'name', $lang) != '' ? MenuItem($child->id, 'name', $lang) : MenuItem($child->id, 'title', $lang) }}</a>
                                                    @if (!empty($child->children[0]))
                                                        <ul class="">
                                                            @foreach ($child->children[0] as $grandchild)
                                                                <li>
                                                                    <a class="" href="#">

                                                                        {{ MenuItem($grandchild->id, 'name', $lang) != '' ? MenuItem($grandchild->id, 'name', $lang) : MenuItem($grandchild->id, 'title', $lang) }}

                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </nav>
            </div> <!-- /.menu-wrapper -->

            <div class="right-widget float-right">
                <ul>
                    {{-- <li class="social-icon">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="cart-icon">
                        <a href="#"><i class="flaticon-phone-receiver"></i></a>
                    </li> --}}
                    <li class="search-option">
                        <div class="dropdown">
                            <button type="button" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-search" aria-hidden="true"></i></button>
                            <form action="#" class="dropdown-menu">
                                <input type="text" Placeholder="Enter Your Search">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div> <!-- /.right-widget -->
        </div> <!-- /.bg-wrapper -->
    </div> <!-- /.container -->
</div> <!-- /.theme-menu-wrapper -->
