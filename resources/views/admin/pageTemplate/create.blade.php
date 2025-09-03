@extends('admin.layouts.app')
@section('title', 'PageTemplate')

@section('subheading', 'create PageTemplate')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        PageTemplate <span class="fw-300"><i>Create</i></span>
                    </h2>
                    <div class="panel-toolbar">

                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <form action="{{ route('temp_store') }}">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Template Name</label>
                                <input type="text" id="simpleinput" name="name" value=""
                                    class="form-control border-info" placeholder="Page Template Name" required>
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
