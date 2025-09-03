@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training Course</h4>

                        <div class="page-title-right">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addModal">Add Training Course</button>
                        </div>
                    </div>
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
                                            <th>Course Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key=>$item)
                                            <tr class="text-center">
                                                <td>{{++$key}}</td>
                                                <td>{{$item->course_name}}</td>
                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}" 
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                     </a>
                                                     
                                                     <!-- Add a form to handle the actual delete action -->
                                                     <form id="delete-form-{{ $item->id }}" 
                                                           action="{{ route('training-delete-course', [$item->id]) }}" 
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
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Training Course
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{route('training-course-update', $item->id)}}" method="POST"
                                                                id="course_edit{{@$item->id}}" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Course Name:<sup><span style="color: red;">*</span></sup></label>
                                                                                <input type="text" class="form-control"
                                                                                id="course_name"
                                                                                    name="course_name" value="{{@$item->course_name}}" placeholder="Course Name" required="required">
                                                                                @if ($errors->has('course_name'))
                                                                                    <span class="text-danger">{{ $errors->first('course_name') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                            
                                                                        <div class="col-sm-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Category<sup><span style="color: red;">*</span></sup></label>
                                                                                <select class="form-select form-valid" id="categories_id" name="categories_id">
                                                                                    <option value="">Select</option>
                                                                                    @foreach ($categories as $cat)
                                                                                        <option value="{{ @$cat->id }}" {{@$cat->id == @$item->categories_id ? 'selected' : ''}}>{{ @$cat->name }}</option>
                                                                                    @endforeach
                                                                                 
                                                                                </select>
                                                                                @if ($errors->has('categories_id'))
                                                                                    <span class="text-danger">{{ $errors->first('categories_id') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                            
                                            
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Description:<sup><span style="color: red;">*</span></sup></label>
                                                                                <textarea class="form-control" name="course_desc" value="{{@$item->course_desc}}" id="course_desc" cols="30" rows="10">{{@$item->course_desc}}</textarea>
                                                                                @if ($errors->has('course_desc'))
                                                                                    <span class="text-danger">{{ $errors->first('course_desc') }}</span>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training-course-store') }}" method="POST" class="training_course_save" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Course Name:<sup><span style="color: red;">*</span></sup></label>
                                    <input type="text" class="form-control"
                                        id="course_name"
                                        name="course_name" placeholder="Course Name" required="required">
                                    @if ($errors->has('course_name'))
                                        <span class="text-danger">{{ $errors->first('course_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Category<sup><span style="color: red;">*</span></sup></label>
                                    <select class="form-select form-valid" id="categories_id" name="categories_id">
                                        <option value="">Select</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ @$cat->id }}">{{ @$cat->name }}</option>
                                        @endforeach
                                     
                                    </select>
                                    @if ($errors->has('categories_id'))
                                        <span class="text-danger">{{ $errors->first('categories_id') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Description:<sup><span style="color: red;">*</span></sup></label>
                                    <textarea class="form-control" name="course_desc" id="course_desc" cols="30" rows="10"></textarea>
                                    @if ($errors->has('course_desc'))
                                        <span class="text-danger">{{ $errors->first('course_desc') }}</span>
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
            $(".training_course_save").validate({
                rules: {
                    course_name: {
                        required: true,
                    },
                    categories_id:{
                        required:true,
                    },
                    course_desc:{
                        required:true
                    }

                },
                messages: {
                    course_name: {
                        required: "Course Name is required",
                    },
                    categories_id:{
                        required: "Category Id is required",
                    },
                    course_desc:{
                        required: "Course Description field is required",
                    }
                },
            })
        });
    </script>
@endsection
