@extends('admin.layouts.app')
@section('title', 'Add Content')
@section('subheading', 'add content')

@section('content')
<form action="{{route('slider.content.store')}}" method="post" enctype="multipart/form-data">
    <div class="row">

            <div class="col-md-8">

                @csrf
                <div id="panel-1" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2> Add Slider Content </h2>
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
                                        <label class="form-label" for="simpleinput">Add Heading </label>
                                        <input type="text" id="simpleinput" name="{{$item->lang_short_name}}_head" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Subheading</label>
                                        <input type="text" id="simpleinput" name="{{$item->lang_short_name}}_subhead" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Add Button Text</label>
                                        <input type="text" id="simpleinput" name="{{$item->lang_short_name}}_txt1" class="form-control" value="">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Add Button Text 1</label>
                                        <input type="text" id="simpleinput" name="{{$item->lang_short_name}}_txt2" class="form-control" value="">
                                    </div>


                                </div>
                                @endforeach

                                <input type="hidden" name="post_id" value="{{$postId}}">
                                <button type="submit" class="btn btn-sm btn-primary mt-4">save</button>
                            </div>

                        </div>

                    </div>



                </div>


            </div>

            <div class="col-md-4">
                <div id="panel-2" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
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

                <div id="panel-3" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2>Button Links</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Add Btn Link 1 </label>
                                <input type="text" name="btnlink1" class="form-control" placeholder="Enter 1st btn link">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Add Btn Link 2 </label>
                                <input type="text" name="btnlink2" class="form-control" placeholder="Enter 2nd btn link">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="panel-4" class="panel" data-panel-collapsed data-panel-fullscreen data-panel-close data-panel-locked data-panel-refresh data-panel-reset data-panel-color data-panel-custombutton>
                    <div class="panel-hdr">
                        <h2>Slider Image</h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            {{-- <div class="form-group">
                                <label class="form-label" for="featured_img">Default file input</label>
                                <input type="file" id="featured_img" name="featured_img" class="form-control-file">
                            </div> --}}
                            <div style="width:100%; height:200px; border:1px dashed #627ca0" class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-md btn-primary" id="uplaodImg">Upload image</button>
                                <img style="max-width: 100%; height: 100%;" id="ImgId" src="" alt="">
                                <input type="hidden" id="post_img" name="post_attachment" value="">
                            </div>


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
    document.addEventListener("DOMContentLoaded", function() {




      document.getElementById('uplaodImg').addEventListener('click', (event) => {
        event.preventDefault();

      //   inputId = 'image2';
        inputId = 'ImgId';

        window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
      });
    });

    // input
    let inputId = '';

    // set file link
    function fmSetLink($url) {
      // document.getElementById(inputId).value = $url;
      //alert($url);
      var url = $url;
      var parsedUrl = new URL(url);
      var path = parsedUrl.pathname;
      //alert(path);
      document.getElementById(inputId).src = $url;
      document.getElementById('post_img').value = path;
      var btnn = document.getElementById('uplaodImg');
      btnn.remove();
    }
  </script>
@endsection
