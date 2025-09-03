@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training Enrollments</h4>

                        <div class="page-title-right">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#addModal">Add Enrollment</button>
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
                                            <th>Category Name</th>
                                            <th>Enrollment Start Date</th>
                                            <th>Enrollment End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categoryEnrollments as $key => $item)
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ @$item->trainingCategory->name }}</td>
                                                <td>{{ @$item->enrollment_start_date }}</td>
                                                <td>{{ @$item->enrollment_end_date }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('delete-category', [$item->id]) }}" 
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                     </a>
                                                     
                                                     <form id="delete-form-{{ $item->id }}" 
                                                           action="{{ route('training-delete-subjects', [$item->id]) }}" 
                                                           method="POST" style="display: none;">
                                                           @method('DELETE')
                                                         @csrf
                                                     </form> --}}

                                                    @if (\Carbon\Carbon::today()->format('Y-m-d') < @$item->enrollment_end_date)
                                                        <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                            title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#editTranModal{{ @$item->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                                <div class="modal fade" id="editTranModal{{ @$item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Enrollment
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form
                                                                action="{{ route('training-enrollment-update', $item->id) }}"
                                                                method="POST" id="enrollment_save{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                @method('PUT')
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Category
                                                                                    Name<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <select
                                                                                    class="form-select form-valid training_category"
                                                                                    id="category_id{{ @$item->id }}"
                                                                                    name="category_id">
                                                                                    <option value="">Select</option>
                                                                                    @foreach ($categories as $category)
                                                                                        <option
                                                                                            value="{{ @$category->id }}"
                                                                                            {{ @$category->id == @$item->category_id ? 'selected' : '' }}>
                                                                                            {{ @$category->name }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                                @if ($errors->has('category_id'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('category_id') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Trainings<sup><span
                                                                                    style="color: red;">*</span></sup></label>
                                                                                <span class="results">
                                            
                                                                                </span>
                                                                                {{-- <label class="form-label">Trainings<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                            
                                                                                <span class="results"></span> --}}
                                                                                
                                                                                
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Enrollment Start
                                                                                    Date<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date"
                                                                                    name="enrollment_start_date"
                                                                                    value="{{ @$item->enrollment_start_date }}"
                                                                                    id="enrollment_start_date{{ @$item->id }}"
                                                                                    class="form-control">
                                                                                @if ($errors->has('enrollment_start_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('enrollment_start_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Enrollment End
                                                                                    Date<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date"
                                                                                    name="enrollment_end_date"
                                                                                    id="enrollment_end_date{{ @$item->id }}"
                                                                                    value="{{ @$item->enrollment_end_date }}"
                                                                                    class="form-control">
                                                                                @if ($errors->has('enrollment_end_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('enrollment_end_date') }}</span>
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
                        {{-- {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!} --}}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Enrollment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training-enrollment-store') }}" method="POST" id="enrollment_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Category Name<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <select class="form-select form-valid training_category" id="category_id"
                                        name="category_id">
                                        <option value="">Select</option>
                                        {{-- <option value="all">All</option> --}}
                                        @foreach ($categories as $category)
                                            <option value="{{ @$category->id }}">{{ @$category->name }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('category_name'))
                                        <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Trainings<sup><span
                                        style="color: red;">*</span></sup></label>
                                    <span class="results">

                                    </span>
                                    {{-- <label class="form-label">Trainings<sup><span
                                                style="color: red;">*</span></sup></label>

                                    <span class="results"></span> --}}
                                    
                                    
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Enrollment Start Date<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" name="enrollment_start_date" id="enrollment_start_date"
                                        class="form-control">
                                    @if ($errors->has('enrollment_start_date'))
                                        <span class="text-danger">{{ $errors->first('enrollment_start_date') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Enrollment End Date<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" name="enrollment_end_date" class="form-control">
                                    @if ($errors->has('enrollment_end_date'))
                                        <span class="text-danger">{{ $errors->first('enrollment_end_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection


@section('script')
    <script>
        $(document).ready(function() {


            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $("#enrollment_start_date").val();
                var endDate = value;

                if (startDate && endDate) {
                    var startDateObj = new Date(startDate);
                    var endDateObj = new Date(endDate);

                    if (endDateObj > startDateObj) {
                        return true;
                    } else {
                        return false;
                    }
                }
                return true;
            }, "Enrollment End Date must be greater than Enrollment Start Date");






            $("#enrollment_save").validate({
                rules: {
                    category_id: {
                        required: true,
                    },
                    enrollment_start_date: {
                        required: true
                    },
                    enrollment_end_date: {
                        required: true,
                        greaterThanStartDate: true
                    },

                },
                messages: {
                    category_id: {
                        required: "Category Id is required",
                    },
                    enrollment_start_date: {
                        required: "Enrollment Start Date is required",
                    },
                    enrollment_end_date: {
                        required: "Enrollment End Date is required",
                        greaterThanStartDate: "Enrollment End Date must be greater than Enrollment Start Date"
                    },
                },
            })



            $('.training_category').change(function() {
                $.ajax({
                    url: 'get-training-category',
                    type: 'GET',
                    data: {
                        category: $(this).val()
                    },
                    success: function(response) {
                        $('.results').empty();
                        $.each(response, function(index, item) {
                            var html = `<div>
                                <input type="checkbox" id="training_name_${index}" name="training_id[]"
                                    class="" value="${item.id}">
                                <label for="training_name_${index}" class="form-label">${item.name}</label>
                            </div>`;
                            $('.results').append(html);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            })
        });
    </script>
@endsection
