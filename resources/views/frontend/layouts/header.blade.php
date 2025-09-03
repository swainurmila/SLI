{{-- <header class="header-one">
    <div class="top-header">
        <div class="container-fluid clearfix">
            @php
                use App\Models\Website\MainHeader;
                $mainheaders = MainHeader::all();
            @endphp

            @foreach ($mainheaders as $mainheader)
                {!! html_entity_decode(preg_replace('/<[^>]+>/', '', $mainheader->content)) !!}	
            @endforeach
        </div>
    </div>

    @include('frontend.layouts.menu')
</header> --}}

@php
    $language = app()->getLocale() == 'en' ? "Odia" : "English";
    use App\Models\Website\MainHeader;
    $mainheaders = MainHeader::all();
@endphp

    
    {!! html_entity_decode(preg_replace('/<[^>]+>/', '', @$mainheaders[1]->content)) !!}<a href="{{$switchLanguageUrl }}" class="alink" id="switch-lang" rel="">{{$language}}</a> </div> </div> </div> </div> </div> </section>


<header class="header-one">
    <div class="top-header">
        <div class="container-fluid clearfix">
           
                    
                    {!! html_entity_decode(preg_replace('/<[^>]+>/', '', @$mainheaders[0]->content)) !!}
        </div>
    </div>
 
    @include('frontend.layouts.menu')
</header>