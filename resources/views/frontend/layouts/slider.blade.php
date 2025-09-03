<!-- 
			=============================================
				Theme Main Banner
			============================================== 
			-->

			{{-- <div id="theme-main-banner" class="banner-one"> --}}
				
					{{-- <div data-src="{{asset('sli_assets/images/home/'.$item->slider_image)}}">
						<div class="camera_caption">
							<div class="container">
							</div>
						</div>
					</div> --}}
					<div id="theme-main-banner" class="banner-one">
						@foreach ($slider as $item)
							{{-- @php
								print_r($item);
								die();
							@endphp --}}
						<div data-src="{{ asset($item->slider_image) }}">
							<div class="camera_caption">
								<div class="container">
								</div>
							</div>
						</div>
						@endforeach
					</div>
	
				{{-- <div id="theme-main-banner" class="banner-one">
				 <div data-src="{{asset('sli_assets/images/home/sli-slider2.jpg')}}">
					<div class="camera_caption">
						<div class="container">
						</div>
					</div>
				</div>
				<div data-src="{{asset('sli_assets/images/home/sli-slider3.jpg')}}">
					<div class="camera_caption">
						<div class="container">
						</div>
					</div>
				</div>
			</div>


			 --}}



			
		
		
		
			
			 