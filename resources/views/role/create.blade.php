@extends('layouts.backend.header')

@section('content')
{{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
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
                                    <h4 class="card-title mb-4">Add Role</h4>
                                </div>
                                
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <form action="{{ route('role.store') }}" method="post" class="comm_frm">
                                        @csrf
                                        {{-- error --}}
                                        @if (\Session::has('error'))
                                            <div id="error" class="text-danger">
                                                {!! \Session::get('error') !!}
                                            </div>
                                        @endif
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Role Title:</label>
                                                    <input type="text" id="exampleInputUsername" onkeypress="return /[a-z A-Z]/i.test(event.key)" class="form-control"
                                                        name="role_title" placeholder="Role Title">
                                                    @if ($errors->has('role_title'))
                                                        <span class="text-danger">{{ $errors->first('role_title') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Role For:</label>
                                                    {{-- <input type="text" id="exampleInputRoleFor" onkeypress="return /[a-z A-Z]/i.test(event.key)" class="form-control"
                                                        name="role_title" placeholder="Role For"> --}}
                                                    <select name="role_for" id="role_for" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1">Library</option>
                                                        <option value="2">Training</option>
                                                        <option value="3">Course</option>
                                                        <option value="4">Research</option>
                                                        <option value="5">E-Office</option>
                                                        <option value="6">Workshop</option>
                                                        <option value="7">Finance</option>
                                                    </select>
                                                    @if ($errors->has('role_for'))
                                                        <span class="text-danger">{{ $errors->first('role_for') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-success waves-effect waves-themed">ADD ROLE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
{{-- </div> --}}
@endsection
