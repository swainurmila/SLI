@extends('layouts.backend.header')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Users</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">Users List</h4>
                                </div>
                                <div class="col-md-2 text-left">
                                    <a class="btn ms-auto btn-md custom-btn" href="{{ route('users.create') }}">ADD USER</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ @$item->first_name . ' ' . @$item->last_name }}</td>
                                                <td>{{ $item->email }}</td>

                                                <td>
                                                    @if (!$item->getRoleNames()->isEmpty())
                                                        @foreach ($item->getRoleNames() as $role)
                                                            {{ $role }}<br>
                                                        @endforeach
                                                    @else
                                                        User
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="d-flex demo">
                                                        <a href="{{ route('role.destroy', [$item->id]) }}"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                            class="btn btn-sm btn-outline-danger btn-icon btn-inline-block mr-4"
                                                            title="Delete Record">
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                        <!-- Add a form to handle the actual delete action -->
                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="{{ route('users.destroy', [$item->id]) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <a href="{{ route('users.edit', [$item->id]) }}"
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
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    {{-- </div> --}}
@endsection
