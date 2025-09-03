 <div class="service-details section-spacing">
     <div class="container">
         <div class="row">

             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 theme-sidebar-one">
                 <div class="sidebar-box service-categories">
                     <ul class="nav flex-column" id="v-tab" role="tablist" aria-orientation="vertical">
                         @foreach ($publications as $key => $array)
                             <li class=""><a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-01-tab"
                                     data-toggle="tab" href="#v-tab-01{{ $key }}" role="tab"
                                     aria-controls="v-tab-01" aria-selected="true">{{ $array->post_title }}</a>
                             </li>
                         @endforeach
                     </ul>
                 </div> <!-- /.service-categories -->
             </div>
             <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                 <div class="tab-content" id="v-tabContent">
                     @foreach ($publications as $key => $array)
                         <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}"
                             id="v-tab-01{{ $key }}" role="tabpanel"
                             aria-labelledby="v-tab-01-tab{{ $key }}">

                             <!--
                                    =====================================================
                                        Prabashi shramika
                                    =====================================================
                                    -->

                             <div class="our-team section-spacing">
                                 <div class="container">
                                     <div class="wrapper">
                                         <div class="row">
                                             @foreach ($array->data as $publicationimg)
                                                 <div class="col-lg-3 col-sm-6 col-12">
                                                     <div class="team-member publication-content-box">
                                                         <div class="image-box">
                                                             <img src="{{ asset($publicationimg->attachment_img) }}"
                                                                 alt="" style="width: 195px; height: 207px;">
                                                             <div class="overlay">
                                                                 <div class="hover-content">
                                                                     <ul>
                                                                         <li><a href="{{ asset($publicationimg->attachment_file) }}"
                                                                                 title="download the pdf"><i
                                                                                     class="fa fa-download"
                                                                                     aria-hidden="true"></i></a></li>
                                                                     </ul>
                                                                     <p>{!! $publicationimg->content !!}</p>
                                                                 </div> <!-- /.hover-content -->
                                                             </div> <!-- /.overlay -->
                                                         </div> <!-- /.image-box -->
                                                         <div class="text"> 
                                                             <h6>{{ $publicationimg->title }}</h6>
                                                             <span>{{ $publicationimg->excerpt }}</span>
                                                         </div> <!-- /.text -->
                                                     </div> <!-- /.team-member -->
                                                 </div> <!-- /.col- -->
                                             @endforeach


                                         </div> <!-- /.row -->
                                     </div> <!-- /.wrapper -->
                                 </div> <!-- /.container -->

                             </div> <!-- /.our-team -->
                         </div>
                     @endforeach

                 </div>
             </div>
         </div>
     </div>
 </div>
 
