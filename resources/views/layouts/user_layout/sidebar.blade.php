

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu mm-active">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="#" class="logo logo-dark d-flex">
            <span class="logo-sm">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg" style="margin-top:-10px;">
                
                <h4 class="pt-4 text-primary d-flex align-items-center">
                    <span><img src="{{ asset('assets/images/favicon.png') }}" alt="" height="40"></span>
                    <span class="ms-2">e-Library</span>
                </h4>
            </span>
        </a>

        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <h4 class="pt-4 text-primary">E-Library</h4>
            </span>
            <span class="logo-lg">
                <h4 class="pt-4 text-primary">E-Library</h4>
            </span>
        </a>
    </div>

    

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('admin.home') }}">
                        <i class="uil-home-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('library.index') }}">
                        <?php
                                        
                                    $total_book = App\Models\Book::count(); 
                                        ?>
                        <i class="fas fa-book-open"></i><span
                            class="badge rounded-pill bg-primary float-end">{{@$total_book}}</span>
                        <span>Library</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('library.userBookList') }}">
                        <i class="fas fa-book-open"></i><span class="badge rounded-pill bg-primary float-end"></span>
                        <span>Book Status</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('library.library-card')}}" class="active">
                        <i class="fas fa-book"></i>
                        <span>Library Card</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-repeat"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <?php 
                                    
                                    $cat_data = App\Models\CategoryMaster::get();    
                                    
                                        
                                    ?>
                        @foreach($cat_data as $cat)
                        <?php
                                    
                                    $total_sub_book = App\Models\Book::where('category_id',$cat->id)->count();  
                                    ?>
                        <li>
                            <a href="{{ route('library.index', ['id' => $cat->id]) }}" class=""><i
                                    class="fas fa-hand-point-right font-size-12"></i>{{$cat->name}} <span
                                    class="badge rounded-pill bg-primary float-end">{{@$total_sub_book}}</span>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>