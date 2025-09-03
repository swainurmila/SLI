@extends('admin.layouts.app')
@section('title', 'Role Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Roles <span class="fw-300"><i>Listing</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <a href="{{ route('role.create') }}" class="btn btn-success waves-effect waves-themed">Create</a>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        {{-- <div class="panel-tag">
                        This example shows DataTables and the Responsive extension being used with the Bootstrap framework providing the styling. The DataTables / Bootstrap integration provides seamless integration for DataTables to be used in a Bootstrap page. <strong>Note</strong> that the <code>.dt-responsive</code> class is used to indicate to the extension that it should be enabled on this page, as responsive has special meaning in Bootstrap. The responsive option could also be used if required
                    </div> --}}
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead class="bg-success-700">
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>

                                        <td>
                                            <a href="{{ route('role.delete', [$item->id]) }}"
                                                class="btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                                title="Delete Record">
                                                <i class="fad fa-trash-restore-alt"></i>
                                            </a>
                                            <a href="{{ route('role.edit', [$item->id]) }}"
                                                class="btn btn-sm btn-icon btn-outline-success rounded-circle mr-1"
                                                title="Edit Record">
                                                <i class="fad fa-pen-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {{-- script goes here --}}
    <script type="text/javascript">
        $('#dt-basic-example').dataTable({
            responsive: true
        });
    </script>
@endsection
