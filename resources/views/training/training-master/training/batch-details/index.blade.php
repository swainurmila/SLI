{{-- @extends('training.admin.layouts.page-layouts.main') --}}
@extends('training.admin.training.training-about-layout')

@section('training-about')
    {{-- <div class="container"> --}}
    <div class="">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-9">
                    <div class="">
                        &nbsp;
                    </div>
                </div>

                {{-- @php

                    $currentDate = Carbon\Carbon::now();
                    $currentDate = $currentDate->toDateString();
                    $latestTrainingDetails = App\Models\Training\TrTrainingDetail::with('training','batch')->where('training_id',$trainingid)->where('batch_id',$batchid)->orderBy('id','desc')->first();
                @endphp

                @if(@$currentDate > @$latestTrainingDetails->end_date)
                    <div class="col-2">
                        <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#addModal">Add Batch Details</button>
                    </div>
                @endif --}}

                <div class="col-2">
                    <button class="btn ms-auto btn-md btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#addModal">Add New Date</button>
                </div>
                <div class="col-1">
                    <a href="{{URL::previous()}}"
                        class="btn btn-sm btn-outline-dark btn-rounded px-4 my-3 my-sm-0 me-3 m-b-10"><i class="fas fa-arrow-left"></i></a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">




                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0 text-center">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Training Name</th>
                                            <th>Batch Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Enrolled Students</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainingDetails as $key => $details)
                                        <tr class="text-center">
                                            <td>{{++$key}}</td>
                                            <td>{{$details->training->name}}</td>
                                            
                                            <td>{{$details->batch->batch_name}}</td>
                                            
                                            <td>{{$details->start_date}}</td>
                                            
                                            <td>{{$details->end_date}}</td>
                                            <td>
                                                <a href="{{ route('training.admin.student.list', ['batch' => @$details->batch->id]) }}"
                                                    class="">{{ count(@$details->trainingOrders) }}
                                            
                                            </td>
                                            
                                            <td>
                                               

                                            <a href="{{ route('training.admin.class.list', ['id' => $details->id]) }}"
                                                class="btn btn-sm btn-outline-dark btn-rounded px-4 my-3 my-sm-0 me-3 m-b-10"><i class="fas fa-arrow-right"></i></a>
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

    <div class="modal fade mode_vid" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training.admin.batch.details', ['trainingid' => @$trainingid,'batchid'=>@$batchid]) }}" method="POST" id="batch_details_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-3 row">
                           
                            <div class="col-sm-12 col-lg-6">
                                <label for="" class="col-form-label">Batch Start Date</label>
                                <input class="form-control form-valid" type="Date" value=""
                                    min="<?php echo date('Y-m-d'); ?>" id="start_date" name="start_date">
                            </div>

                            <div class="col-sm-12 col-lg-6">
                                <label for="" class="col-form-label">Batch End Date</label>
                                <input class="form-control form-valid" type="Date" value=""
                                    min="<?php echo date('Y-m-d'); ?>" id="end_date" name="end_date">
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            $("#batch_details_save").validate({
                rules: {
                    start_date: {
                        required: true
                    },
                    end_date:{
                        required:true
                    }
                },
                messages: {
                    start_date: "Please enter batch start date",
                    end_date: "Please enter batch end date",

                },
                submitHandler: function(form) {
                    form.submit();
                },
            });


        });
    </script>
@endsection
