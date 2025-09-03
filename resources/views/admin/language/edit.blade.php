@extends('admin.layouts.app')
@section('title', 'Role Dashboard')

@section('subheading', 'create Role')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Language <span class="fw-300"><i>Edit</i></span>
                    </h2>
                    <div class="panel-toolbar">

                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content mt-4 mb-4 mx-auto col-md-6">

                        
                            <form action="{{ route('lang.update',$id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row"><label
                                        class="form-label col-sm-3 col-form-label text-left text-sm-left"
                                        for="lang_name">language Name:</label>
                                    <div class="col-lg-9">
                                        <input type="text"  id="lang_name" value="{{@$lang->lang_name}}" name="lang_name"
                                            placeholder="language name"class="form-control border-info"
                                            value=""></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="form-group row"><label
                                        class="form-label col-sm-3 col-form-label text-left text-sm-left"
                                        for="lang_short_name">language Short Name:</label>
                                    <div class="col-lg-9">
                                        <input type="text"  id="lang_short_name" value="{{@$lang->lang_short_name}}" name="lang_short_name"
                                            placeholder="language Short name"class="form-control border-info"
                                            value=""></div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-3 col-form-label text-left text-sm-left"
                                        for="lang_name">language Icon:
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" id="example-fileinput" name="flag" class="form-control-file mt-2">
                                        <img alt="" class="mt-3" id="lang_img" src="{{ asset(@$lang->lang_flag) }}"
                                    style="max-width: 100%; height: 100%;">
                                    </div>
                                    
                                    <div style="clear:both;"></div>
                                </div>








                                <div class="form-group">
                                    <button type="sumbit" class="btn btn-success waves-effect waves-themed">save</button>
                                </div>

                            </form>
                        


                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $('#dt-basic-example').dataTable({
            responsive: true
        });
    </script>
@endsection
