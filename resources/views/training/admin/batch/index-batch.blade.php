@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training Batch</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">Training Batch List</h4>
                                </div>
                                <div class="col-md-2 text-left">
                                    <a href="{{route('training.createBatch')}}" class="btn ms-auto btn-md custom-btn">Add Training Batch</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Batch Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Max Student</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($batches as $key=>$item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->batch_name}}</td>
                                                <td>{{$item->start_time}}</td>
                                                <td>{{$item->end_time}}</td>
                                                <td>{{$item->max_student}}</td>
                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}" 
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                     </a>
                                                     
                                                     <!-- Add a form to handle the actual delete action -->
                                                     <form id="delete-form-{{ $item->id }}" 
                                                           action="{{ route('training-delete-category', [$item->id]) }}" 
                                                           method="POST" style="display: none;">
                                                           @method('DELETE')
                                                         @csrf
                                                     </form>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
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
    {{-- <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Training Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training-category-store') }}" method="POST" id="training-category-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Training Category Title:<sup><span style="color: red;">*</span></sup></label>
                                    <input type="text" id="exampleInputUsername" class="form-control"
                                        name="name" id="name" placeholder="Training Category Title" required="required">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    {{-- </div> --}}
@endsection


