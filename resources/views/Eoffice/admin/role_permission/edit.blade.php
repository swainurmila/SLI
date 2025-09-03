@extends('Eoffice.admin.layouts.page-layouts.main')

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
                                    <form action="{{ route('eoffice.admin.role.update', [$role->id]) }}" method="post">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        
                                        {{-- error --}}
                                        @if (\Session::has('error'))
                                            <div id="error" class="text-danger">
                                                {!! \Session::get('error') !!}
                                            </div>
                                        @endif
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Role Title:</label>
                                                    <input type="text" class="form-control" name="role_title"
                                                        placeholder="Role Title" value="{{ $role->name }}">
                                                    @if ($errors->has('role_title'))
                                                        <span class="text-danger">{{ $errors->first('role_title') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div id="panel-2" class="pane2">
                                                    <div class="panel-hdr">
                                                        <h5>
                                                            Role Permission
                                                        </h5>
                                                    </div>
                                                    <div class="panel-container show">
                                                        <div class="panel-content">
                                                            <table
                                                                class="table table-bordered table-hover table-striped w-100">
                                                                <thead>
                                                                    <tr>

                                                                        <th>{{ __('Module Name') }}</th>
                                                                        <th>{{ __('Show') }}</th>
                                                                        <th>{{ __('Create') }}</th>
                                                                        <th>{{ __('Edit') }}</th>
                                                                        <th>{{ __('Delete') }}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @php $counter = 0; @endphp
                                                                    @foreach ($permission->chunk(5) as $chunk)
                                                                        <tr>
                                                                            @foreach ($chunk as $key => $value)
                                                                                <td><input type="checkbox"
                                                                                        id="md_checkbox_{{ $key }}"
                                                                                        class="filled-in chk-col-primary"
                                                                                        value="{{ $value->id }}"
                                                                                        name="{{$counter}}"
                                                                                        {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                                                    <label
                                                                                        for="md_checkbox_{{ $key }}">{{ $key % 5 == 0 ? ucfirst($value->name) : '' }}</label>
                                                                                </td>
                                                                                @php $counter++; @endphp
                                                                            @endforeach
                                                                        </tr>
                                                                    @endforeach
{{-- 
                                                                    @foreach ($permission->chunk(5) as $chunk)

                                                                    <tr>
                                                                        @foreach ( $chunk as $key => $value)
                                                                        <td><input type="checkbox" id="md_checkbox_{{$key}}" class="filled-in chk-col-primary"
                                                                                value="{{$value->id}}" name="permission[]" {{in_array($value->id, $rolePermissions) ?
                                                                            'checked' : ''}}>
                                                                            <label for="md_checkbox_{{$key}}">{{ ($key % 5 == 0) ? ucfirst($value->name) : '' }}</label>
                                                                        </td>
                                                                        @endforeach
                                                                    </tr>
                                                                    @endforeach --}}

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-success waves-effect waves-themed"
                                                value="Submit">
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
