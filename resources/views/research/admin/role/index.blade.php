@extends('research.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Roles</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">&nbsp;</h4>
                                </div>
                                <div class="col-md-2 text-left">
                                    <a class="btn ms-auto btn-md custom-btn" href="{{ route('research.admin.role.create') }}">ADD ROLE</a>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Nav tabs -->
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Role Name</th>
                                                <th>Actions</th>
    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>
                                                        <div class="d-flex demo">
                                                            <a href="{{ route('research.admin.role.edit', [$item->id]) }}"
                                                                class="btn btn-sm btn-outline-primary btn-icon btn-inline-block mx-2 edit"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
    
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#admin_paper_table').DataTable();
        });
    </script>
@endsection
