@extends('research.layouts.main')

@section('content')
{{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Add Research Roles</h4>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" class="btn ms-auto btn-md custom-btn">ADD ROLE</button>
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
