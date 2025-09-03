@extends('admin.layouts.app')
@section('title', 'Users Dashboard')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel" id="panel-1">
                <div class="panel-hdr">
                    <h2>
                        Users <span class="fw-300"><i>Listing</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <a class="btn btn-success waves-effect waves-themed" href="{{ route('user.create') }}">Create</a>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        {{-- <div class="panel-tag">
                        This example shows DataTables and the Responsive extension being used with the Bootstrap framework providing the styling. The DataTables / Bootstrap integration provides seamless integration for DataTables to be used in a Bootstrap page. <strong>Note</strong> that the <code>.dt-responsive</code> class is used to indicate to the extension that it should be enabled on this page, as responsive has special meaning in Bootstrap. The responsive option could also be used if required
                    </div> --}}
                        <!-- datatable start -->
                        <table class="table table-bordered table-hover table-striped w-100" id="dt-basic-example">
                            <thead class="bg-success-700">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @foreach ($item->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                                href="#" title="Delete Record">
                                                <i class="fad fa-trash-restore-alt"></i>
                                            </a>
                                            <a class="btn btn-sm btn-icon btn-outline-success rounded-circle mr-1"
                                                href="{{ route('user.edit', [$item->id]) }}" title="Edit Record">
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

    <script>
        /* demo scripts for change table color */
        /* change background */


        $(document).ready(function() {
            $('#dt-basic-example').dataTable({
                responsive: true
            });

            $('.js-thead-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });

        });
    </script>
@endsection
