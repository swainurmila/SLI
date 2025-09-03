@extends('course.layouts.admin.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b>Enrolled Students</b> </h4>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-10">
                                    <form action="{{ route('course.admin.enrollList') }}" method="GET" class="mb-3">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <label class="form-label" for="">Course</label>
                                                <select class="form-select" name="course" id=""
                                                    required>
                                                    <option value="">Select</option>
                                                    @foreach ($no_of_courses as $no_of_course)
                                                        <option value="{{ @$no_of_course->id }}">{{ @$no_of_course->course_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-2" style="margin-top: 29px">
                                                <button type="submit" class="btn custom-btn"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <a href="{{ route('course.admin.student.export') }}"
                                        class="btn ms-auto btn-md custom-btn">Export All</a>
                                </div>

                            </div>



                            <div class="table-responsive">
                                @if (!$enrolledCourses->isEmpty())
                                    <table id="course_enroll_table" class="table table-centered table-nowrap mb-0">
                                        <thead class="table-secondary">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($enrolledCourses as $key => $item)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ @$item->UserDetails->first_name . ' ' . @$item->UserDetails->last_name }}</td>
                                                    <td>{{ @$item->UserDetails->email }}</td>
                                                    <td>{{ @$item->UserDetails->contact_no }}</td>
                                                    <td> 
                                                        <a href="{{route('course.admin.course-view',@$item->course_id)}}">
                                                            <span
                                                            class="badge text-bg-dark">{{ @$item->course->course_name }}</span>
                                                        </a>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-center">Records Not Found !</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="m-4">
                        {!! $enrolledCourses->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>

        $('#course_enroll_table').DataTable();
        $(document).ready(function() {
            $(".training-data").change(function() {
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: `{{ route('training.fetch.batchlist', ['training_id' => ':id']) }}`
                        .replace(':id', id),
                    success: function(response) {
                        let selectElement = $(".batches-data");
                        // Clear existing options
                        selectElement.empty();
                        // Append new options
                        $.each(response, function(index, option) {
                            selectElement.append($('<option>', {
                                value: option.id,
                                text: option.batch_name
                            }));
                        });
                    },
                    error: function(error) {
                        console.error('Ajax request failed:', error);
                    }
                });
            });
        });
    </script>
@endsection
