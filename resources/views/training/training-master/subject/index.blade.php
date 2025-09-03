@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">


            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>TRAINING SUBJECT</b> </h4>
                    </div>
                </div>

                <div  class="col-2">
                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addModal">Add Subject</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Subject Name</th>
                                            <th>Course Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key=>$item)
                                            <tr class="text-center">
                                                <td>{{++$key}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->Course->course_name}}</td>

                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}" 
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                     </a>
                                                     
                                                     <!-- Add a form to handle the actual delete action -->
                                                     <form id="delete-form-{{ $item->id }}" 
                                                           action="{{ route('training-delete-subjects', [$item->id]) }}" 
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
                                                <div class="modal fade" id="editTranModal{{ @$item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Training Subject
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{route("training-subjects-update", $item->id)}}" method="POST"
                                                                id="course_edit{{@$item->id}}" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Subject Name:<sup><span style="color: red;">*</span></sup></label>
                                                                                <input type="text" id="exampleInputUsername" class="form-control"
                                                                                    name="name" value="{{@$item->name}}" placeholder="Subject Name" required="required">
                                                                                @if ($errors->has('name'))
                                                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                            
                                                                        <div class="col-sm-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Course<sup><span style="color: red;">*</span></sup></label>
                                                                                <select class="form-select form-valid" id="course_id" name="course_id">
                                                                                    <option value="">Select</option>
                                                                                    @foreach ($courses as $course)
                                                                                        <option value="{{ @$course->id }}" {{@$course->id == @$item->course_id ? 'selected' : ''}}>{{ @$course->course_name }}</option>
                                                                                    @endforeach
                                                                                 
                                                                                </select>
                                                                                @if ($errors->has('course_id'))
                                                                                    <span class="text-danger">{{ $errors->first('course_id') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn custom-btn">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                    <div class="m-4">
                        {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training-subjects-store') }}" method="POST" id="subject_save" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Subject Name:<sup><span style="color: red;">*</span></sup></label>
                                    <input type="text" id="exampleInputUsername" class="form-control"
                                        name="name" placeholder="Subject Name" required="required">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Course<sup><span style="color: red;">*</span></sup></label>
                                    <select class="form-select form-valid" id="course_id" name="course_id">
                                        <option value="">Select</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ @$course->id }}">{{ @$course->course_name }}</option>
                                        @endforeach
                                     
                                    </select>
                                    @if ($errors->has('course_id'))
                                        <span class="text-danger">{{ $errors->first('course_id') }}</span>
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
    </div>
    {{-- </div> --}}
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $("#subject_save").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    course_id:{
                        required:true,
                    },

                },
                messages: {
                    name: {
                        required: "Subject name is required",
                    },
                    course_id:{
                        required: "Course Id is required",
                    },
                },
            })
        });
    </script>
@endsection
