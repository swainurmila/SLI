@extends('frontend.layouts.app')
@section('content')
<!-- 
			=============================================
				About Company
			============================================== 
			-->
			@include('frontend.layouts.slider')
            @include('frontend.layouts.latestnews')
			<div class="about-compnay section-spacing mt-5">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-6 col-12"><img src="{{asset(@$homeservice->attachment_img)}}" alt="">
							
						</div>
						<div class="col-lg-6 col-12">
							<div class="text">
								<div class="theme-title-one">
									<h2>{{@$homeservice->title}}</h2>
                                    <p>{!! @$homeservice->content !!}</p>
									{{-- <h2>About Us</h2>
									<p>State Labour Institute, Odisha, an autonomous body under the Labour & ESI Department, Govt. of Odisha, offers diverse functions aimed at enhancing labour welfare. Its spectrum includes training for rural and unorganised labour, vocational guidance, and informal education. Additionally, it provides comprehensive training for factory managers, trade union leaders, and conducts refresher courses for government officers.</p> --}}
								</div> <!-- /.theme-title-one -->
								<ul class="mission-goal clearfix">
									<li>
										<i class="icon flaticon-star"></i>
										<h6 class="font-weight-bold">Vision</h6>
									</li>
									<li>
										<i class="icon flaticon-medal"></i>
										<h6 class="font-weight-bold">Missions</h6>
									</li>

									<li>
										<i class="icon flaticon-target"></i>
										<h6 class="font-weight-bold">History</h6>
									</li>
								</ul> <!-- /.mission-goal -->
							</div> <!-- /.text -->
						</div> <!-- /.col- -->
					</div> <!-- /.row -->
				</div> <!-- /.container -->
			</div> <!-- /.about-compnay -->


			<!--
			=====================================================
				Notification section
			=====================================================
			-->
			<div class="why-we-best">
				<div class="overlay">
					<div class="container">
						<div class="theme-title-one">
							<h2>{{@$labourwelfare->title}}</h2>
                            <p>{!! @$labourwelfare->content !!}</p>
							{{-- <h2>Labour Welfare Initiatives</h2>
							<p>Stay connected with our Notification Section for the latest updates, announcements, and important information regarding labor welfare initiatives.</p> --}}
						</div> <!-- /.theme-title-one -->

						<div class="wrapper row no-gutters shadow">
							<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 order-lg-last">
								<div class="new-description">
									<div class="news-box">
										<h5 class="text-primary mb-3 text-center"><u>LATEST NEWS</u></h5>
										   	<marquee direction="up" scrollamount="4" height="380px" class="contatiner-news-box">
												<ul class="marquee-vertical">
													@foreach ($latestNews as $item)
														@php
															$day=date('d', strtotime($item->date));
															$month=date('m', strtotime($item->date));
															$year=date('y', strtotime($item->date));
														@endphp

														<li>
															<div class="date">
																<span class="day">{{$day}}</span>
																<span class="month"> {{$month}}  <br> {{$year}}</span>
															</div>
															<a href="#" title="Sli-e-training" class="news-text">{!! $item->title !!}<span class="badge rounded-pill bg-danger ml-3 text-white">New</span></a>
														</li>
													@endforeach




													{{-- <li>
														<div class="date">
															<span class="day">24</span>
															<span class="month"> Jan  <br> 2022</span>
														</div>
							  							<a href="#" title="Sli-e-training" class="news-text">online service for training available<span class="badge rounded-pill bg-danger ml-3 text-white">New</span></a>
													</li>
													<li>
														<div class="date">
															<span class="day">17</span>
															<span class="month"> Dec  <br> 2021</span>
														</div>
							  							<a href="#" title="Advertisement of e-library" class="news-text">Invitation of EoI for Research & Case Studies on Labour related subjects under SLI, Odisha</a>
													</li>
													<li>
														<div class="date">
															<span class="day">17</span>
															<span class="month"> Dec  <br> 2021</span>
														</div>
							  							<a href="#" title="e-office Management System" class="news-text">Invitation of EoI for Research & Case Studies on Labour related subjects under SLI, Odisha<span class="pulse2">New</span></a>
													</li>
													<li>
														<div class="date">
															<span class="day">24</span>
															<span class="month"> Jan  <br> 2022</span>
														</div>
							  							<a href="#" title="Sli-e-training" class="news-text">online service for training available<span class="badge rounded-pill bg-danger ml-3 text-white">New</span></a>
													</li>
													<li>
														<div class="date">
															<span class="day">17</span>
															<span class="month"> Dec  <br> 2021</span>
														</div>
							  							<a href="#" title="Advertisement of e-library" class="news-text">Invitation of EoI for Research & Case Studies on Labour related subjects under SLI, Odisha</a>
													</li>? --}}
												</ul>
											</marquee>
											<div style="text-align: right;">
												<a href="#" class="btn btn-sm theme-button-one mt-2">See More</a>
											</div>
									</div>
									
								</div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 order-lg-first">

								<ul class="best-list-item">
									@foreach ($team as $item)
										
									
									<li class="d-flex">
										<span class="leader-box">
											<img src="{{ asset($item->attachment_img) }}" alt="" class="leader-img">
											
										</span>
										<span class="pl-3">
											
											{{-- <h5 class="mb-2"><a href="#">Shri Sarada Prasad Nayak</a></h5>
											<p class="f-desc">Hon'ble Minister, Labour & ESI and Chairman, SLI</p> --}}
											<h5 class="mb-2"><a href="#">
												
												
												<?php

												$teamMemberContent =TeamMember($item->id,'title',$lang);
												$cleanedContent = strip_tags($teamMemberContent);
												echo $cleanedContent;
											?>
												
											
											</a></h5>
											
											<p class="f-desc">
												<?php
													$teamMemberContent = TeamMember($item->id, 'content', $lang);
													$cleanedContent = strip_tags($teamMemberContent);
													echo $cleanedContent;
												?>
												{{-- {!! TeamMember($item->id,'content',$lang) !!}  --}}
											</p>
											
										</span>
									</li>
									@endforeach
									
								</ul>
							</div> <!-- /.col- -->
						</div> <!-- /.wrapper -->
					</div> <!-- /.container -->
				</div> <!-- /.overlay -->
			</div> <!-- /.why-we-best -->


			<!-- 
			=============================================
				Services Section
			============================================== 
			-->
			<div class="service-style-one mb-5 pb-3">
				<div class="container">
					<div class="theme-title-one">
						<h2>{{@$schemeservice->title}}</h2>
                        <p>{!! @$schemeservice->content !!}</p>
						{{-- <h2>OUR SCHEMES & SERVICES</h2>
						<p>A dedicated initiative in Odisha provides a range of schemes and services tailored to bolster workforce capabilities and promote workplace safety, fostering a thriving environment for sustainable labor practices and economic development in the region.</p> --}}
					</div> <!-- /.theme-title-one -->
					<div class="wrapper">
						<div class="row">


							{{-- <div class="col-xl-4 col-md-6 col-12">
								<div class="single-service">
									<div class="img-box"><img src="{{asset('sli_assets/images/home/Publish.jpg')}}" alt=""></div>
									<div class="text">
										<h5 class="service-txt"><a href="{{ route('web.inner', ['lang' => 'en', 'slug' => 'publication-details']) }}">Publications</a></h5>
										<p class="service-desc-txt">Odisha Labor Institute's Informative Publications</p>
										<a href="{{ route('web.inner', ['lang' => 'en', 'slug' => 'publication-details']) }}" class="read-more">READ MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
								</div> 
							</div> --}}

							@foreach ($schemes as $key => $value)
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="single-service">
                                    <div class="img-box"><img style="height: 168px" src="{{ asset($value['attachment_img']) }}" alt=""></div>
                                    <div class="text">
                                        <h5 class="service-txt"><a href="{{@$value->custom_link}}">{{$value['title']}}</a></h5>
                                        <p class="service-desc-txt">{!! $value['content'] !!}</p>
                                        <a href="{{@$value->custom_link}}" class="read-more">{{$value['excerpt']}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
						</div> <!-- /.row -->
					</div> <!-- /.wrapper -->
				</div> <!-- /.container -->
			</div> <!-- /.service-style-one -->


			<!--
			=====================================================
				Partner Slider
			=====================================================
			-->
			<div class="partner-section bg-color">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-12">
							<div class="partner-slider">
								@foreach ($partners as $item)
								
									<div class="item"><img src="{{asset($item->attachment_img)}}" alt=""></div>	
								@endforeach
								
								{{-- <div class="item"><img src="{{asset('sli_assets/images/logo/jana sunani_16.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/IIT_2_0.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/digital-india_4.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/IDICOL-logo_2_1.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/omc-logo_5.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/IPICOL-logo_5.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/ocac_6.png')}}" alt=""></div>
								<div class="item"><img src="{{asset('sli_assets/images/logo/swach-bharat_5.png')}}" alt=""></div> --}}
								
							</div>
						</div>
					</div>
				</div>
			</div>
			 <!-- /.partner-section -->


			

	        <!-- Scroll Top Button -->
			<button class="scroll-top tran3s">
				<i class="fa fa-angle-up" aria-hidden="true"></i>
			</button>    
@endsection