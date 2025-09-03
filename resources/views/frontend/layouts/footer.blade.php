<!--
   =====================================================
    Footer
   =====================================================
   -->
<footer class="theme-footer-one">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-6 about-widget">
                    <h6 class="title">About Us</h6>
                    {!! $aboutus->content !!}
                    {{-- <p>State Labour Institute, Odisha, an autonomous body under the Labour & ESI Department, Govt. of Odisha.</p> --}}
                    {{-- <div class="queries"><i class="flaticon-phone-call"></i> Any Queries : <a href="#">0674-2395275</a></div> --}}
                </div> <!-- /.about-widget -->
                <div class="col-xl-3 col-lg-3 col-sm-6 footer-recent-post">
                    <h6 class="title">Location Map</h6>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3742.6196075121447!2d85.83977697500995!3d20.274604881192673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19a75140dcece1%3A0x2fcf16072183c3f6!2sOffice%20Of%20The%20Labour%20Commissioner!5e0!3m2!1sen!2sin!4v1710149138901!5m2!1sen!2sin"
                        style="border:0; width:80%; height:80%;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- /.footer-recent-post -->
                <div class="col-xl-3 col-lg-3 col-sm-6 footer-list">
                    <h6 class="title">Quick Links</h6>
                    <ul>
                        {{-- @foreach ($quickLinks as $item)
                            @php
                                $link = strip_tags($item->custom_link);
                                $link = trim($link);

                                // Check if the link starts with a protocol
                                if (!preg_match('~^(?:f|ht)tps?://~i', $link)) {
                                    // If it doesn't have a protocol, prepend 'https://'
    $link = 'https://' . $link;
                                }
                            @endphp
                            <li><a title="" href="{{ $link }}">{{ $item->title }}</a></li>
                        @endforeach --}}

                        @foreach ($quickLinks as $item)
                            {!! html_entity_decode(preg_replace('/<[^>]+>/', '', $item->content)) !!}
                        @endforeach


                    </ul>
                </div> <!-- /.footer-list -->
                <div class="col-xl-3 col-lg-3 col-sm-6 about-widget">
                    <h6 class="title">Contact Us</h6>
                    <div class="">
                        {!! $contactus->content !!}
                        {{-- <p>State Labour Institute (SLI), Odisha Unit-3, Janpath, Kharavel Nagar, Bhubaneswar , 751001. </p>
                            		<p>Fax : 0674-2535275</p>
									<p>E-Mail : sliodisha[at]gov[dot]in</p> --}}
                    </div>


                    <div class="d-flex mt-3">
                        <ul class="social-icon d-flex ">
                            <li><a href="#" class="text-light"><i class="fa fa-facebook"
                                        aria-hidden="true"></i></a></li>
                            <li class="px-4"><a href="#" class="text-light"><i class="fa fa-twitter"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="#" class="text-light"><i class="fa fa-linkedin"
                                        aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.top-footer -->
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <p>&copy; Developed by Oasys Tech Solutions & Maintained by OCAC </p>
                </div>
                <div class="col-md-4 col-12">
                    <p>Site Visitors : {{ \App\Models\Website\WebsiteVisitor::first()->count ?? 0;}} +</p>
                </div>
            </div>
        </div>
    </div> <!-- /.bottom-footer -->
</footer> <!-- /.theme-footer -->
@section('js')
    <script>
        $(document).ready(function() {
            var columns = [];
            if ($('#ztable tbody tr:first-child th').length > 0) {
                $('#ztable tbody tr:first-child th').each(function() {
                    columns.push($(this).text());
                });
            } else {
                $('#ztable tbody tr:first-child td').each(function() {
                    columns.push($(this).text());
                });
            }
            var headingRow = $('#ztable tbody tr:first-child').detach();
            $('#ztable thead').append(headingRow);

            $('#ztable tbody tr:first-child').remove();
            $('#ztable').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                        "orderable": true,
                        "targets": 0
                    },
                    {
                        "className": "dt-center",
                        "targets": "_all"
                    }
                ],
                "columns": columns.map(function(col) {
                    return {
                        "title": col
                    };
                })
            });
            $('#ztable thead').addClass('thead-light');
            $('#ztable').addClass('table table-bordered');

        });
    </script>
@endsection
