<!--====== Banner Bottom section Start ======-->
<section style="background: linear-gradient(90deg, rgb(20 161 96) 35%, rgb(109 138 245) 100%);
			padding: 2px 0;">
</section>
<section class="bottom-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="left_head">latest news</div>
            </div>
            <div class="col-md-9">
                <div class="right_marq">
                    <marquee style="width: 100%;" scrollamount="5"
                        onmouseout="this.setAttribute('scrollamount', 5, 0);this.start();"
                        onmouseover="this.setAttribute('scrollamount', 0, 0);this.stop();">


                        {{-- <a href="#" target="_blank">&nbsp;<u>Click here for enrollment of the training programme,
                                and the last date for enrollment of training programme is March 28, 2024.</u> | <span
                                class="badge bg-danger">Enroll Now</span> | <span class="blink-soft">
                                <strong class="text-warning">&nbsp;(Online)</strong></span></a> --}}


                        @foreach ($latestNews as $item)
                            @php
                                $day = date('d', strtotime($item->date));
                                $month = date('m', strtotime($item->date));
                                $year = date('y', strtotime($item->date));
                            @endphp
							<a href="#" target="_blank"><span class="badge bg-danger">New</span> | <u>{!! $item->title !!}</u> |</a>
                        @endforeach
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="background: linear-gradient(90deg, rgb(20 161 96) 35%, rgb(109 138 245) 100%);
			padding: 2px 0;">
</section>
<!--====== Banner Bottom section End ======-->
