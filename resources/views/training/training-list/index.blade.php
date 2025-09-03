@extends('training.layouts.user-page-layouts.main')
@section('content')
<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{asset('user-assets/images/Banner.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h1 class="">Online Training Module</h1>
            </div>
        </div>
    </div>
</section><!-- Mt Contact Banner of the Page end -->
<div class="container">
    <div class="row">
        <!-- sidebar of the Page start here -->
        <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
            <!-- shop-widget filter-widget of the Page start here -->
            <section class="shop-widget filter-widget bg-grey">
                <h2>FILTER</h2>
                
                <form action="{{ route('training.list') }}" method="POST" id="traing_list" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <span class="sub-title">Refine by</span>
                <!-- nice-form start here -->
                <ul class="list-unstyled nice-form">
                    <li>
                        <label for="refine_by1">
                            <input id="refine_by1" name="refine_by[]" value="0" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Free</span>
                        </label>
                        <span class="num">5</span>
                    </li>
                    <li>
                        <label for="refine_by2">
                            <input id="refine_by2" name="refine_by[]" value="1" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Paid</span>
                        </label>
                        <span class="num">12</span>
                    </li>
                </ul><!-- nice-form end here -->
                <span class="sub-title">Filter by type</span>
                
                <!-- nice-form start here -->
                <ul class="list-unstyled nice-form">
                    <li>
                        <label for="type1">
                            <input id="type1"  name="type[]" value="0" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Training with Certificate</span>
                        </label>
                        <span class="num">2</span>
                    </li>
                    <li>
                        <label for="type2">
                            <input id="type2" name="type[]" value="1" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">Training without Certificate</span>
                        </label>
                        <span class="num">12</span>
                    </li>
                </ul><!-- nice-form end here -->
                <span class="sub-title">Categories / Subject</span>
                <!-- nice-form start here -->
                <ul class="list-unstyled nice-form">
                    @foreach($tr_categores as $tr_cat)
                    <li>
                        <label for="training_category_id{{$tr_cat->id}}">
                            <input   id="training_category_id{{$tr_cat->id}}" name="training_category_id[]" value="{{$tr_cat->id}}"  type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">{{$tr_cat->name}}</span>
                        </label>
                        <span class="num">2</span>
                    </li>
                    @endforeach
                    
                </ul><!-- nice-form end here -->
                <span class="sub-title">Filter by Language</span>
                <!-- nice-form start here -->
                <ul class="list-unstyled nice-form">
                    
                    @foreach($languages as $lan)
                    <li>
                        <label for="language_id-{{$lan->id}}">
                            <input id="language_id-{{$lan->id}}" value="{{$lan->id}}" name="language_id[]" type="checkbox">
                            <span class="fake-input"></span>
                            <span class="fake-label">{{$lan->name}}</span>
                        </label>
                    </li>
                     
                    @endforeach
                </ul><!-- nice-form end here -->
                
                <span class="sub-title">Filter by Price</span>
                <div class="price-range">
                    <div class="range-slider">
                        <span class="dot"></span>
                        <span class="dot dot2"></span>
                    </div>
                    <span class="price">Price &nbsp;   $ 10  &nbsp;  -  &nbsp;   $ 599</span>
                     
                    <button type="submit"  class="filter-btn">Filter</button>
                </div>
            </form>
            </section><!-- shop-widget filter-widget of the Page end here -->
            <!-- shop-widget of the Page start here -->
            <section class="shop-widget">
                <h2>CATEGORIES</h2>
                <!-- category list start here -->
                <ul class="list-unstyled category-list">
                    <li>
                        <a href="#">
                            <span class="name">EBOOKS</span>
                            <span class="num">12</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="name">Video</span>
                            <span class="num">24</span>
                        </a>
                    </li>
                </ul><!-- category list end here -->
            </section><!-- shop-widget of the Page end here -->
        </aside><!-- sidebar of the Page end here -->
        <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
            <!-- mt shoplist header start here -->
            <header class="mt-shoplist-header">
                <!-- btn-box start here -->
                <div class="btn-box">
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="drop-link">
                                Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
                            </a>
                            <div class="drop">
                                <ul class="list-unstyled">
                                    <li><a href="#">E-Book</a></li>
                                    <li><a href="#">Video</a></li>
                                    <li><a href="#">Price</a></li>
                                    <li><a href="#">Relevance</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div><!-- btn-box end here -->
            </header><!-- mt shoplist header end here -->
            <!-- mt productlisthold start here -->
            <div class="product-detail-tab course-tab">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="mt-tabs text-center text-uppercase">
                                <li><a href="#tab1" class="active">All</a></li>
                                <li><a href="#tab2">e-book</a></li>
                                <li><a href="#tab3">Video</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab1">
                                    <ul class="mt-productlisthold list-inline">
                                        @foreach($training_lists as $training)
                                        <li>
                                            <?php 
 
                                              $training_image = App\Models\Training\TrainingImages::where('training_id',$training->id)->first();
                                              $image_parth = 'public/upload/training/training_image/'.@$training_image->file_name;
                                                ?>
                                            <!-- mt product1 large start here -->
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="{{route('training-user.course-details',@$training->id)}}"><img src="{{ asset(@$image_parth) }}" alt="image"></a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a href="{{route('training-user.course-details',@$training->id)}}">{{$training->name}}</a></strong>
                                                    <span class="price"><span>₹</span> <span>{{number_format(@$training->price, 2, '.', ',')}}</span></span>
                                                </div>
                                            </div><!-- mt product1 center end here -->
                                        </li>
                                        @endforeach
                                        
                                    </ul><!-- mt productlisthold end here -->
                                    <!-- mt pagination start here -->
                                    <nav class="mt-pagination">
                                        <ul class="list-inline">
                                            {{-- <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                        </ul> --}}
                                    </nav><!-- mt pagination end here -->
                                </div>
                                <div id="tab2">
                                    <ul class="mt-productlisthold list-inline">

                                        <li>
                                            <!-- mt product1 large start here -->
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="course-details.html"><img src="images/1e.jpg" alt="image"></a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a href="course-details.html">2Tech Innovator Bootcamp</a></strong>
                                                    <span class="price"><span>₹</span> <span>399.00</span></span>
                                                </div>
                                            </div><!-- mt product1 center end here -->
                                        </li>
                                         
                                    </ul><!-- mt productlisthold end here -->
                                    <!-- mt pagination start here -->
                                    <nav class="mt-pagination">
                                        <ul class="list-inline">
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                        </ul>
                                    </nav><!-- mt pagination end here -->
                                </div>
                                <div id="tab3">
                                    <ul class="mt-productlisthold list-inline">
                                        <li>
                                            <!-- mt product1 large start here -->
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="course-details.html"><img src="images/4v.jpg" alt="image"></a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a href="course-details.html">Financial Literacy</a></strong>
                                                    <span class="price"><span>₹</span> <span>399.00</span></span>
                                                </div>
                                            </div><!-- mt product1 center end here -->
                                        </li>
                                        <li>
                                            <!-- mt product1 large start here -->
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="course-details.html"><img src="images/5v.jpg" alt="image"></a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a href="course-details.html">Health and Wellness</a></strong>
                                                    <span class="price"><span>₹</span> <span>269.00</span></span>
                                                </div>
                                            </div><!-- mt product1 center end here -->
                                        </li>
                                        <li>
                                            <!-- mt product1 large start here -->
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="course-details.html"><img src="images/6v.jpg" alt="image description"></a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
                                                                <li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a href="course-details.html">Cybersecurity Fundamentals</a></strong>
                                                    <span class="price"><span>₹</span> <span>139.00</span></span>
                                                </div>
                                            </div><!-- mt product1 center end here -->
                                        </li>
                                    </ul><!-- mt productlisthold end here -->
                                    <!-- mt pagination start here -->
                                    <nav class="mt-pagination">
                                        <ul class="list-inline">
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                        </ul>
                                    </nav><!-- mt pagination end here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection