<section id="about-part">
    <div class="container">
        <div class="section-title3">
            <!-- <h3>{!! $page->getTranslation('post_title', $lang) !!}</h3> -->
        </div>
        <!-- <div class="theme-inner-banner mb-3">
            <div class="overlay">
                <div class="container">
                    <h2>Gallery List</h2>
                </div>
            </div>
        </div> -->
        <div class="shop-page section-spacing">
            <div class="container">
                <div class="shop-filter">
                    <ul class="clearfix">
                        <li>
                            <select class="form-control" id="exampleSelect1">
                                <option>All Photos</option>
                                <option>Infrastructure</option>
                                <option>Events</option>
                                <option>Training Programme</option>
                                <option>Meetings</option>
                            </select>
                        </li>
                    </ul>
                </div> <!-- /.shop-filter -->
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all"
                                    role="tab" aria-controls="all" aria-selected="true">All Photos</a>
                            </li>
                            @foreach ($gallery as $gal)
                                <li class="nav-item">
                                    <a class="nav-link" id="infra-tab" data-toggle="tab"
                                        href="#infra{{ $gal->id }}" role="tab" aria-controls="infra"
                                        aria-selected="false">{{ ucfirst(@$gal->post_title) }}</a>
                                </li>
                            @endforeach

                        </ul>
                        <div class="tab-content pt-5" id="myTabContent">
                            <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all">
                                <section id="gallery">
                                    <div id="image-gallery">
                                        <div class="row">
                                            @foreach ($allphoto as $img)
                                                <div class="col-lg-3 col-md-4 col-6 image">
                                                    <div class="single-product">
                                                        <div class="image-box">
                                                            <div class="img-wrapper">

                                                                @php
                                                                    // Get the file extension
                                                                    $extension = strtolower(
                                                                        pathinfo(
                                                                            $img->gallery_image,
                                                                            PATHINFO_EXTENSION,
                                                                        ),
                                                                    );
                                                                @endphp


                                                                @if ($extension === 'mp4')
                                                                    {{-- It's an MP4 file, display video tag --}}
                                                                    <a href="{{ asset($img->gallery_image) }}">
                                                                        <img src="{{ asset('sli_assets/images/play.jpg') }}"
                                                                            class="img-responsive" alt="Media Image">
                                                                    </a>
                                                                @else
                                                                    {{-- It's an image file, display img tag --}}
                                                                    <a href="{{ asset($img->gallery_image) }}">
                                                                        <img src="{{ asset($img->gallery_image) }}"
                                                                            class="img-responsive" alt="Media Image">
                                                                    </a>
                                                                @endif

                                                                {{-- <a href="{{ asset($img->gallery_image) }}"><img
                                                                        src="{{ asset($img->gallery_image) }}"
                                                                        class="img-responsive"></a> --}}
                                                                <div class="img-overlay">
                                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /.single-product -->
                                                </div> <!-- /.col- -->
                                            @endforeach



                                        </div>
                                    </div>
                                </section>
                            </div>

                            @foreach ($gallery as $gal)
                                <div class="tab-pane fade" id="infra{{ @$gal->id }}" role="tabpanel"
                                    aria-labelledby="infra-tab{{ @$gal->id }}">
                                    <section id="gallery">
                                        <div id="image-gallery">
                                            <div class="row">

                                                @foreach ($gal->gallery as $data)
                                                    <div class="col-lg-3 col-md-4 col-6 image">
                                                        <div class="single-product">
                                                            <div class="image-box">
                                                                <div class="img-wrapper">
                                                                    <a href="{{ asset($data->gallery_image) }}"><img
                                                                            src="{{ asset($data->gallery_image) }}"
                                                                            class="img-responsive"></a>
                                                                    <div class="img-overlay">
                                                                        <i class="fa fa-plus-circle"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- /.single-product -->
                                                    </div> <!-- /.col- -->
                                                @endforeach

                                            </div>
                                        </div>
                                    </section>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                {{-- <div class="theme-pagination text-center">
                    <ul>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                    </ul>
                </div> --}}
            </div>
        </div>


    </div>

</section>
