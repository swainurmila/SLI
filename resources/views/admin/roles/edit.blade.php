@extends('admin.layouts.app')
@section('title', 'Role Dashboard')

@section('subheading', 'Edit Role')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel" id="panel-1">
                <div class="panel-hdr">
                    <h2>
                        Role <span class="fw-300"><i>Edit</i></span>
                    </h2>
                    <div class="panel-toolbar">

                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <form action="{{ route('role.update',[$id]) }}">
                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Role Name</label>
                                <input class="form-control border-info" id="simpleinput" name="name"
                                    placeholder="Role Name" required type="text" value="{{$role->name}}">
                            </div>




                            <div class="form-group">

                            </div>

                            <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                                <thead>
                                    <tr>
                                        <th>Sl.No</th>
                                        <th>Select All</th>
                                        <th>Name</th>
                                        <th>List</th>
                                        <th>Create</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>



{{-- @php
    dd($item);
@endphp --}}

                                    @foreach ($permission->chunk(5) as $key => $chunk)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input masterCheckbox" data-row="{{ $key }}" id="select_all{{ $key }}"
                                                        name="permission_select_all" type="checkbox" >
                                                    <label class="custom-control-label"
                                                        for="select_all{{ $key }}">Select all</label>
                                                </div>
                                            </td>
                                            @foreach ($chunk as $item)

                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input checkbox"
                                                            id="defaultUnchecked{{ $item->id }}" data-row="{{ $key }}" name="permission[]"
                                                            type="checkbox" value="{{ $item->id }}" {{in_array($item->id, $rolePermissions) ? 'checked' : ''}}>
                                                        <label class="custom-control-label"
                                                            for="defaultUnchecked{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="form-group">
                                <button class="btn btn-success waves-effect waves-themed" type="sumbit">save</button>
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



        $(document).ready(function() {
            $(".masterCheckbox").change(function() {
                var row = $(this).data("row");
                var isChecked = $(this).is(":checked");
                $(".checkbox[data-row=" + row + "]").prop("checked", isChecked);
            });
        });
    </script>
@endsection
