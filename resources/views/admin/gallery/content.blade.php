@extends('admin.layouts.app')
@section('title', 'Add Content')
@section('subheading', 'add content')

@section('content')
    <form action="{{ route('gallery.content.store') }}" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-8">

                @csrf
                <div id="panel-1" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close
                    data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2> Add Gallery Content </h2>
                    </div>

                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="panel-tag">
                                Add a clean look to your tabs by adding <code>.nav-tabs-clean</code> to <code>.nav-tabs</code>
                            </div> --}}
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                @foreach ($lang as $item)
                                    <li class="nav-item"><a class="nav-link {{ $item->id == 1 ? 'active' : '' }}"
                                            data-toggle="tab" href="#tab-{{ $item->lang_short_name }}" role="tab"><img
                                                src="/{{ $item->lang_flag }}" style="max-width: 20px; margin-right: 10px;"
                                                alt="">{{ $item->lang_name }}</a></li>
                                @endforeach
                                {{-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-en" role="tab">English</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-or" role="tab">Oriya</a></li> --}}
                            </ul>
                            <div class="tab-content p-3">
                                @foreach ($lang as $item)
                                    <div class="tab-pane fade  {{ $item->id == 1 ? 'show active' : '' }}"
                                        id="tab-{{ $item->lang_short_name }}" role="tabpanel"
                                        aria-labelledby="tab-{{ $item->lang_short_name }}">
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Add Title </label>
                                            <input type="text" id="simpleinput" name="{{ $item->lang_short_name }}_title"
                                                class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Add Description</label>
                                            <textarea name="{{ $item->lang_short_name }}_desc" class="form-control"></textarea>
                                        </div>



                                    </div>
                                @endforeach

                                <input type="hidden" name="post_id" value="{{ $postId }}">
                                <button type="submit" class="btn btn-sm btn-primary mt-4">save</button>
                            </div>

                        </div>

                    </div>



                </div>


            </div>

            <div class="col-md-4">
                <div id="panel-2" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close
                    data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2> Image Status </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Publish</label>
                                <select name="page_status" id="" class="form-control">
                                    <option value="1">publish</option>
                                    <option value="0">draft</option>
                                </select>
                            </div>
                            {{-- <button class="btn btn-sm btn-primary">save</button> --}}
                        </div>
                    </div>
                </div>



                <div id="panel-4" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close
                    data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2>Gallery Image</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="form-group">
                                <label class="form-label" for="featured_img">Default file input</label>
                                <input type="file" id="featured_img" name="featured_img" class="form-control-file">
                            </div> --}}
                            <div class="d-flex justify-content-center align-items-center" id="img_wrap"
                                style="width:100%; height:200px; border:1px dashed #627ca0">

                                <button class="btn btn-md btn-primary uplaodImg" id="uplaodImg" type="button">Upload
                                    image</button>
                                <img alt="" id="ImgId" src="" style="max-width: 100%; height: 100%;">
                                <input id="post_img" name="post_attachment" type="hidden" value="">

                            </div>

                            <a href="#" id="remove_img">Remove Image</a>


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
        // document.addEventListener("DOMContentLoaded", function() {




        //   document.getElementById('uplaodImg').addEventListener('click', (event) => {
        //     event.preventDefault();

        //   //   inputId = 'image2';
        //     inputId = 'ImgId';

        //     window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
        //   });
        // });

        // // input
        // let inputId = '';

        // // set file link
        // function fmSetLink($url) {
        //   // document.getElementById(inputId).value = $url;
        //   //alert($url);
        //   var url = $url;
        //   var parsedUrl = new URL(url);
        //   var path = parsedUrl.pathname;
        //   //alert(path);
        //   document.getElementById(inputId).src = $url;
        //   document.getElementById('post_img').value = path;
        //   var btnn = document.getElementById('uplaodImg');
        //   btnn.remove();
        // }
    </script>

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


            $('.uplaodImg').on('click', function() {
                //alert('hi');
                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
                inputId = 'ImgId';

            });

            // input


            // set file link


        });

        let inputId = '';
        // function fmSetLink($url) {
        //         // document.getElementById(inputId).value = $url;
        //         const filename = $url.substring($url.lastIndexOf('/') + 1);
        //         const extension = filename.substring(filename.lastIndexOf('.') + 1);

        //         var url = $url;
        //         var parsedUrl = new URL(url);
        //         var path = parsedUrl.pathname;
        //         //alert(path);
        //         if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
        //             //alert('image');
        //             document.getElementById(inputId).src = $url;
        //             document.getElementById('post_img').value = path;
        //             var btnn = document.getElementById('uplaodImg');
        //             btnn.remove();
        //         }



        //     }




        function fmSetLink($url) {
            // document.getElementById(inputId).value = $url;
            const filename = $url.substring($url.lastIndexOf('/') + 1);
            const extension = filename.substring(filename.lastIndexOf('.') + 1);

            var url = $url;
            var parsedUrl = new URL(url);
            var path = parsedUrl.pathname.substring(1);
            var imagePath = new URL(url).pathname.substring(2);
            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg') {
                document.getElementById(inputId).src = "{{ URL::asset('') }}" + imagePath;
                document.getElementById('post_img').value = path;
                var btnn = document.getElementById('uplaodImg');
                btnn.remove();
            } else if (extension == 'mp4') {

                var video = document.createElement('video');
                video.src = $url;
                video.controls = true; // Add controls for play/pause/etc.
                document.getElementById('img_wrap').appendChild(video);
                var btnn = document.getElementById('uplaodImg');
                btnn.remove();
                // Store video URL
                document.getElementById('post_img').value = $url;


            } else {
                document.getElementById(inputId).src = $url;
                document.getElementById('post_img').value = path;
                var btnn = document.getElementById('uplaodImg');
                btnn.remove();
            }
        }
    </script>
@endsection
