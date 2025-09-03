@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('subheading', 'create Gallery')

@section('content')
<form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Gallery <span class="fw-300"><i>Create</i></span>
                    </h2>
                    <div class="panel-toolbar">

                    </div>
                </div>
                <div class="panel-container show">
                    {{-- <div class="panel-content mt-4 mb-4 mx-auto col-md-6">



                                @csrf
                                <div class="form-group row"><label
                                        class="form-label col-sm-3 col-form-label text-left text-sm-left"
                                        for="lang_name">Gallery Name:</label>
                                    <div class="col-lg-9">
                                        <input type="text"  id="gallery" name="gallery"
                                            placeholder="Gallery Title"class="form-control border-info"
                                            value=""></div>
                                    <div style="clear:both;"></div>
                                </div>

                                <div class="form-group">
                                    <button type="sumbit" class="btn btn-success waves-effect waves-themed">save</button>
                                </div>





                    </div> --}}

                    <div class="panel-content mt-4 mb-4 mx-auto col-md-6">

                        <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                            @foreach ($lang as $item)
                            <li class="nav-item"><a class="nav-link {{ $item->id == 1 ? 'active' : '' }}" data-toggle="tab" href="#tab-{{ $item->lang_short_name }}" role="tab"><img
                                alt="" src="/{{ $item->lang_flag }}"
                                style="max-width: 20px; margin-right: 10px;">{{ $item->lang_name }}</a></li>
                            @endforeach
                        </ul>


                        <div class="tab-content p-3">
                            @foreach ($lang as $item)
                            @php
                                $lang_title = $item->lang_short_name;
                            @endphp
                            <div class="tab-pane fade {{ $item->id == 1 ? 'show active' : '' }}" id="tab-{{$lang_title}}" role="tabpanel" aria-labelledby="tab-{{ $lang_title }}">
                                <div class="form-group row"><label
                                    class="form-label col-sm-3 col-form-label text-left text-sm-left"
                                    for="lang_name">Gallery Name:</label>
                                <div class="col-lg-9">
                                    <input type="text"  id="gallery" name="{{$lang_title}}_gallery"
                                        placeholder="Gallery Title"class="form-control border-info"
                                        value=""></div>
                                <div style="clear:both;"></div>
                            </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="tab-profile" role="tabpanel" aria-labelledby="tab-profile">Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic. </div> --}}

                            @endforeach
                        </div>
                        <div class="form-group text-center">
                            <button type="sumbit" class="btn btn-success waves-effect waves-themed">save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</form>
@endsection
@section('js')
    <script type="text/javascript">
        $('#dt-basic-example').dataTable({
            responsive: true
        });
    </script>
@endsection
