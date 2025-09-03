@extends('admin.layouts.app')
@section('title', 'Add PostType')
@section('subheading', 'add PostType')

@section('content')
<form action="{{route("$routeName.store",[$routeName])}}" method="post" enctype="multipart/form-data">
    <div class="row">

            <div class="col-md-8">

                @csrf
                <div id="panel-1" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2> Add PostType </h2>
                    </div>

                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="panel-tag">
                                Add a clean look to your tabs by adding <code>.nav-tabs-clean</code> to <code>.nav-tabs</code>
                            </div> --}}
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                @foreach ($lang as $item)
                                <li class="nav-item"><a class="nav-link {{$item->id == 1 ? 'active' : ''}}" data-toggle="tab" href="#tab-{{$item->lang_short_name}}" role="tab"><img src="/{{$item->lang_flag}}" style="max-width: 20px; margin-right: 10px;" alt="">{{$item->lang_name}}</a></li>
                                @endforeach
                                {{-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-en" role="tab">English</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-or" role="tab">Oriya</a></li> --}}
                            </ul>
                            <div class="tab-content p-3">
                                @foreach ($lang as $item)
                                <div class="tab-pane fade  {{$item->id == 1 ? 'show active' : ''}}" id="tab-{{$item->lang_short_name}}" role="tabpanel" aria-labelledby="tab-{{$item->lang_short_name}}">
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Add Title </label>
                                        <input type="text" id="simpleinput" name="{{$item->lang_short_name}}_title" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Content</label>
                                        <textarea id="content_{{$item->lang_short_name}}" name="{{$item->lang_short_name}}_content"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Short Content</label>
                                        <textarea id="{{$item->lang_short_name}}_excerpt" rows="5" class="form-control" name="{{$item->lang_short_name}}_excerpt"></textarea>
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
                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" name="show_icon" class="custom-control-input" id="defaultInline1">
                                    <label class="custom-control-label" for="defaultInline1">Show New Icon</label>
                                </div>
                            </div> --}}
                            <div class="form-check">
                                <input class="form-check-input" name="show_icon" type="checkbox" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Show New Icon
                                </label>
                              </div>



                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-4">
                <div id="panel-2" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2> Page Status </h2>
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
                            <input type="hidden" name="post_id" value="{{$id}}">
                            <input type="hidden" name="post_type" value="{{$routeName}}">
                            <button type="submit" class="btn btn-sm btn-primary">save</button>
                        </div>
                    </div>
                </div>



                <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-3">
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

                                <button class="btn btn-md btn-primary uplaodImg" id="uplaodImg" type="button">Upload
                                    image</button>
                                <img alt="" id="ImgId" src=""
                                    style="max-width: 100%; height: 100%;">
                                <input id="post_img" name="post_attachment" type="hidden" value="">

                        </div>

                        <a href="#" id="remove_img">Remove Image</a>


                        {{-- <button class="btn btn-sm btn-primary">save</button> --}}
                    </div>
                </div>
            </div>

            <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-4">
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

            <div id="panel-8" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                <div class="panel-hdr">
                    <h2> Add Custom Link </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Add Url</label>
                            <input type="text" class="form-control" name="custom_link" value="">
                        </div>
                       
                    </div>
                </div>
            </div>

            </div>

    </div>
</form>
@endsection
@section('js')
<script>
 
 
 
 
 
// Function to handle image selection and display
function handleImageUpload(imageUrl) {
    // Set the src attribute of the img tag to the selected image URL
    $('#ImgId').attr('src', imageUrl);
    // Set the value of the hidden input field to the selected image URL
    $('#post_img').val(imageUrl);
}
 
 
 
    $(document).ready(function() {
 
 
 
 
        $('#remove_img').click(function(e){
            e.preventDefault();
            //alert('hi');
            $('#img_wrap').empty();
            var btn_html = '<button type="button" class="btn btn-md btn-primary uplaodImg" id="uplaodImg">Upload image</button><img style="max-width: 100%; height: 100%;" id="ImgId" src="" alt=""><input type="hidden" id="post_img" name="post_attachment" value="">';
            $('#img_wrap').append(btn_html);
            $('.uplaodImg').on('click', function() {
            // Handle button click event
            console.log('Button clicked');
            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            inputId = 'ImgId';
            });
        });
        $('#remove_file').click(function(e){
            e.preventDefault();
            //alert('hi');
            $('#File_wrap').empty();
            var btn_html = '<button class="btn btn-md btn-primary uplaodFile" id="uplaodFile" type="button">UploadFile</button><input id="post_File" name="post_attachment2" type="hidden" value="">';
            $('#File_wrap').append(btn_html);
            $('.uplaodFile').on('click', function() {
            // Handle button click event
            console.log('Button clicked');
            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            inputId = 'FileId';
            });
        });
 
        $('.uplaodImg').on('click', function() {
           
            window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            // Set the inputId for later use
            inputId = 'ImgId';
           
        });
       
       
     
 
 
        // set file link
 
 
    });
    $('.uplaodFile').on('click',function() {
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
            var path = parsedUrl.pathname.substring(1);
            var imagePath = new URL(url).pathname.substring(2);
            if(extension == 'png' || extension == 'jpg' || extension == 'jpeg'){
                document.getElementById(inputId).src = "{{URL::asset('')}}" + imagePath;
                document.getElementById('post_img').value = path;
                var btnn = document.getElementById('uplaodImg');
                btnn.remove();
            }else{
                //alert('file');
               // const linkElement = document.getElementById(inputId).href = $url;
                var btnn = document.getElementById('uplaodFile');
                btnn.remove();
                var btn_html = '<a href="'+path+'" id="FileId" target="_blank"><img alt=""  src="{{asset('assets/backend/img/file.png')}}"></a>';
                $('#File_wrap').append(btn_html);
 
 
                document.getElementById('post_File').value = path;
 
                //document.getElementById(inputId).href = $url;
            }
 
 
 
        }
 
 
</script>
@endsection
