@extends('admin.layouts.app')
@section('title', 'PostTypes')

@section('subheading', 'create PostTypes')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        PostTypes <span class="fw-300"><i>Create</i></span>
                    </h2>
                    <div class="panel-toolbar">

                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{ route('post.store') }}">

                            <div class="form-group">
                                <label class="form-label" for="simpleinput">PostTypes Name</label>
                                <input type="hidden" value="{{ $flag }}" name="flag" id="flag">
                                <input type="text" pattern="[^0-9]*" id="simpleinput" name="name" value=""
                                    class="form-control border-info" placeholder="PostTypes Name" required>
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


        document.getElementById('simpleinput').addEventListener('input', function() {
            var value = this.value;
            var newValue = value.replace(/[^a-zA-Z0-9]/g, ''); // Remove any non-alphanumeric characters
            newValue = newValue.replace(/[0-9]/g, ''); // Remove any numeric characters
            this.value = newValue; // Update the input value without numeric characters
        });
    </script>
@endsection
