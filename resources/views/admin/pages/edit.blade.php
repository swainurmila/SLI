@extends('admin.layouts.app')
@section('title', 'Edit Page')
@section('subheading', 'Edit page')

@section('content')
    <form action="{{ route('page.update', [$id]) }}" enctype="multipart/form-data" method="post">
        <div class="row">

            <div class="col-md-8">

                @csrf
                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                    data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset
                    id="panel-{{ $id }}">
                    <div class="panel-hdr">
                        <h2> Edit Page </h2>
                    </div>

                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="panel-tag">
                                Add a clean look to your tabs by adding <code>.nav-tabs-clean</code> to <code>.nav-tabs</code>
                            </div> --}}
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                @foreach ($lang as $item)
                                    <li class="nav-item "><a class="nav-link {{ $item->id == 1 ? 'active' : '' }}"
                                            data-toggle="tab" href="#tab-{{ $item->lang_short_name }}" role="tab"><img
                                                alt="" src="/{{ $item->lang_flag }}"
                                                style="max-width: 20px; margin-right: 10px;">{{ $item->lang_name }}</a></li>
                                @endforeach
                                {{-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-en" role="tab">English</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-or" role="tab">Oriya</a></li> --}}
                            </ul>
                            <div class="tab-content p-3">
                                @foreach ($lang as $item)
                                    @php
                                        $lang_title = $item->lang_short_name;
                                    @endphp
                                    <div aria-labelledby="tab-{{ $lang_title }}"
                                        class="tab-pane fade  {{ $item->id == 1 ? 'show active' : '' }}"
                                        id="tab-{{ $lang_title }}" role="tabpanel">
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Add Title </label>
                                            <input class="form-control" id="simpleinput" name="{{ $lang_title }}_title"
                                                type="text"
                                                value="{{ $page->getTranslation('post_title', $lang_title) }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Content</label>
                                            <textarea id="content_{{ $lang_title }}" name="{{ $lang_title }}_content">{{ $page->getTranslation('post_content', $lang_title) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Short Content</label>
                                            <textarea class="form-control" id="{{ $lang_title }}_excerpt" name="{{ $lang_title }}_excerpt" rows="5">{{ $page->getTranslation('post_excerpt', $lang_title) }}</textarea>
                                        </div>

                                    </div>
                                @endforeach


                                {{-- <button type="submit" class="btn btn-sm btn-primary mt-4">save</button> --}}
                            </div>

                        </div>

                    </div>






                </div>

                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                    data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-7">
                    <div class="panel-hdr">
                        <h2>Mark As New</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="show_icon" class="custom-control-input"
                                        id="defaultInline1">
                                    <label class="custom-control-label" for="defaultInline1">Show New Icon</label>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-4">
                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                    data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-2">
                    <div class="panel-hdr">
                        <h2> Page Status </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Publish</label>
                                <select class="form-control" id="" name="page_status">
                                    <option value="1">publish</option>
                                    <option value="0">draft</option>
                                </select>
                            </div>
                            <button class="btn btn-sm btn-primary">save</button>
                        </div>
                    </div>
                </div>

                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                    data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-3">
                    <div class="panel-hdr">
                        <h2>Page attributes</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Select Page Template</label>
                                <select class="form-control" id="" name="page_template_id">
                                    <option value="0">Default</option>
                                    @foreach ($pageTemp as $item)
                                        <option {{ $page->page_template_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->temp_name }}</option>
                                    @endforeach


                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Header</label>
                                <select class="form-control" id="" name="">
                                    <option value="1">publish</option>
                                    <option value="0">draft</option>
                                </select>
                            </div>
                            {{-- <button class="btn btn-sm btn-primary">save</button> --}}
                        </div>
                    </div>
                </div>

                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                    data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-4">
                    <div class="panel-hdr">
                        <h2>Featured Image</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="form-group">
                                <label class="form-label" for="featured_img">Default file input</label>
                                <input type="file" id="featured_img" name="featured_img" class="form-control-file">
                            </div> --}}
                            <div class="d-flex justify-content-center align-items-center" id="img_wrap"
                                style="width:100%; height:200px; border:1px dashed #627ca0">
                                @if ($page->post_attachment != '')
                                    <img alt="" id="page_img" src="{{ $page->post_attachment }}"
                                        style="max-width: 100%; height: 100%;">
                                    <input id="post_img" name="post_attachment" type="hidden"
                                        value="{{ $page->post_attachment }}">
                                @else
                                    <button class="btn btn-md btn-primary uplaodImg" id="uplaodImg" type="button">Upload
                                        image</button>
                                    <img alt="" id="ImgId" src=""
                                        style="max-width: 100%; height: 100%;">
                                    <input id="post_img" name="post_attachment" type="hidden" value="">
                                @endif

                            </div>

                            <a href="#" id="remove_img">Remove Image</a>


                            {{-- <button class="btn btn-sm btn-primary">save</button> --}}
                        </div>
                    </div>
                </div>

                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                    data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-5">
                    <div class="panel-hdr">
                        <h2>File Url</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="form-group">
                                <label class="form-label" for="featured_img">Default file input</label>
                                <input type="file" id="featured_img" name="featured_img" class="form-control-file">
                            </div> --}}
                            <div class="d-flex justify-content-center align-items-center" id="File_wrap"
                                style="width:100%; height:200px; border:1px dashed #627ca0">

                                <button class="btn btn-md btn-primary uplaodFile" id="uplaodFile" type="button">Upload
                                    File</button>
                                {{-- <a href="" id="FileId">view file</a> --}}
                                <input id="post_File" name="post_attachment2" type="hidden" value="">


                            </div>
                            <a href="#" id="remove_file">Remove File</a>
                            {{-- <button class="btn btn-sm btn-primary">save</button> --}}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#remove_img').click(function(e) {
                e.preventDefault();
                //alert('hi');
                $('#img_wrap').empty();
                var btn_html =
                    '<button type="button" class="btn btn-md btn-primary uplaodImg" id="uplaodImg">Upload image</button><img style="max-width: 100%; height: 100%;" id="ImgId" src="" alt=""><input type="hidden" id="post_img" name="post_attachment" value="">';
                $('#img_wrap').append(btn_html);
                $('.uplaodImg').on('click', function() {
                    // Handle button click event
                    console.log('Button clicked');
                    window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
                    inputId = 'ImgId';
                });
            });
            $('#remove_file').click(function(e) {
                e.preventDefault();
                //alert('hi');
                $('#File_wrap').empty();
                var btn_html =
                    '<button class="btn btn-md btn-primary uplaodFile" id="uplaodFile" type="button">UploadFile</button><input id="post_File" name="post_attachment2" type="hidden" value="">';
                $('#File_wrap').append(btn_html);
                $('.uplaodFile').on('click', function() {
                    // Handle button click event
                    console.log('Button clicked');
                    window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
                    inputId = 'FileId';
                });
            });

            $('.uplaodImg').on('click', function() {
                //alert('hi');
                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
                inputId = 'ImgId';

            });

            // input


            // set file link


        });
        $('.uplaodFile').on('click', function() {
            //alert('hi');
            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            inputId = 'FileId';

        });
        let inputId = '';

        function fmSetLink($url) {
            // document.getElementById(inputId).value = $url;
            const filename = $url.substring($url.lastIndexOf('/') + 1);
            const extension = filename.substring(filename.lastIndexOf('.') + 1);

            var url = $url;
            var parsedUrl = new URL(url);
            var path = parsedUrl.pathname;
            //alert(path);
            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg') {
                //alert('image');
                document.getElementById(inputId).src = $url;
                document.getElementById('post_img').value = path;
                var btnn = document.getElementById('uplaodImg');
                btnn.remove();
            

            } else{
                //alert('file');
                // const linkElement = document.getElementById(inputId).href = $url;
                var btnn = document.getElementById('uplaodFile');
            btnn.remove();
            var btn_html = '<a href="' + $url +
                '" id="FileId" target="_blank"><img alt=""  src="{{ asset('assets/backend/img/file.png') }}"></a>';
            $('#File_wrap').append(btn_html);


            document.getElementById('post_File').value = $url;

            //document.getElementById(inputId).href = $url;
        }



        }
    </script>
@endsection
