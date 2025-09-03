@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-11">
                    <div class="">
                        <h4 class="mb-0"><b>Add Exam</b> </h4>
                    </div>
                </div>
                <div class="col-1">
                    <a href="{{ URL::previous() }}" class="btn ms-auto btn-md custom-btn">
                        Back</a>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <form action="{{ route('training.admin.exam.store',$training_details->id) }}" method="POST" id="exam_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="mb-3 row">
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Exam File</label>
                                        <input type="file" class="form-control" name="exam_file" id="exam_file">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Passing Mark</label>
                                        <input type="number" class="form-control" name="passing_mark" id="passing_mark">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Fail Mark</label>
                                        <input type="number" class="form-control" name="fail_mark" id="fail_mark">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Start Date</label>
                                        <input type="date" min="<?php echo $training_details->start_date; ?>" max="<?php echo $training_details->end_date; ?>" class="form-control" name="start_date" id="start_date">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Start Time</label>
                                        <input type="time" class="form-control" name="start_time" id="start_time">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">End Date</label>
                                        <input type="date" min="<?php echo $training_details->start_date; ?>" max="<?php echo $training_details->end_date; ?>" class="form-control" name="end_time" id="end_time">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">End Time</label>
                                        <input type="time" class="form-control" name="end_date" id="end_date">
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn custom-btn">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
        


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#exam_save").validate({
                rules: {
                    exam_file:{
                        required:true,
                        accept: "application/pdf"
                    },
                    start_date:{
                        required:true
                    },
                    end_date:{
                        required:true
                    },
                    start_time:{
                        required:true
                    },
                    end_time:{
                        required:true
                    },
                    passing_mark: {
                        required: true,
                        number: true
                    },
                    fail_mark:{
                        required:true,
                        number:true
                    }
                    
                },
                messages: {
                    exam_file: {
                        required: "Please choose a file",
                        accept: "Please select a PDF file"
                    },
                    passing_mark: "Please enter passing mark",
                    fail_mark: "Please enter fail mark",


                },
                submitHandler: function(form) {
                    console.log("Form is valid. Submitting...");
                    form.submit();
                },
            });


        });
    </script>
@endsection
