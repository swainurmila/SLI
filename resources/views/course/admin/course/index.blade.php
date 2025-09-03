@extends('course.layouts.admin.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b>Course List</b> </h4>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="text-end">
                    <a href="{{ route('course.createcourse')}}" class="btn custom-btn w-xs btn-xs waves-effect waves-light">Add
                        Course<span><i class="ms-2 uil-plus-circle"></i></span></a>
                        
                </div>
            </div>
            <!-- end page title -->
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <table id="datatable_2" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>Course Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($course as $key => $item)
                                                <tr class="">
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>{{ $item->course_name }}</td>
                                                    <td class="text-center">{{ Carbon\Carbon::parse(@$item->course_start_date)->toFormattedDateString() }}</td>
                                                    <td class="text-center">{{ Carbon\Carbon::parse(@$item->course_end_date)->toFormattedDateString() }}</td>
                                                    <td>

                                                        <a href="{{ route('course.editCourse', ['id' => $item->id]) }}"
                                                            class="btn btn-outline-info btn-sm edit"
                                                            title="EditTraining"><i class="uil-edit-alt"></i></a>

                                                        <a href="{{ route('course.admin.course-view', ['id' => $item->id]) }}"
                                                            class="btn custom-btn btn-sm"
                                                            title="About-Training">More<i
                                                                class="uil-info-circle ms-2"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    
    <!-- Add this script in the head section of your HTML -->

    
    
    
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable_1').DataTable();
        $('#datatable_2').DataTable();

        $('#datatable_3').DataTable();
    });
</script>
@endsection
