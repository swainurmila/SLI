@extends('training.admin.training.training-about-layout')

@section('training-about')
    <style>
        table tr td.accord-table-content {
            padding: .0rem .75rem;
            border-top-width: 0.05rem;
        }

        .clickable tr {
            pointer-events: none;
        }
    </style>
    
            <div class="tab-content text-muted mt-4 mt-md-0">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">

                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                                <img class="img-fluid"
                                    src="{{ asset('public/upload/training/training_image/' . @$training->TrainingImage->file_name) }}"
                                    alt="">
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-8">  
                            <h5 class="text-danger fw-bold">Training Name : <span class="ms-2">{{ @$training->name }}</span></h5>
                            
                            <div class="">
                                <span class="badge bg-primary font-size-14">{{ucfirst(@$training->TrainingCategory->name)}}</span>
                                <span class="badge bg-warning font-size-14 mx-4"><i class="uil-star"></i> {{@$roundedAverageRating}}</span>
                                <span class="badge bg-secondary font-size-14"><i class="uil-users-alt me-2"></i>{{count(@$training->TrainingReviews)}} Reviews</span>
                            </div>
                            <p class="mt-3">{{@$training->description}}</p>
                            
                            <div class="row">
                                <div class="col-md-6 border-end border-primary">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Duration</strong>
                                            <span
                                                class="mb-0">{{ @$training->training_duration . ' ' . @$training->training_duration_type }}</span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Price</strong>
                    
                                            <span class="mb-0">
                                                @if ($training->payment_type == '0')
                                                    Free
                                                @else
                                                    ₹ {{ number_format(@$training->price, 2, '.', ',') }}
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Language</strong>
                                            <span class="mb-0">
                                                <i class="flag-icon flag-icon-us"></i><span
                                                    class="badge rounded-pill bg-secondary">
                                                    {{ @$training->language->name }} </span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Payment Type</strong>
                                            <span
                                                class="mb-0">{{ @$training->payment_type == '0' ? 'Free' : 'Paid' }}</span>
                                        </li>
                    
                    
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Place</strong>
                    
                                            <span class="mb-0">
                                                {{@$training->Place->name}}
                    
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex px-0 justify-content-between">
                                            <strong>Certificate</strong>
                    
                                            <span class="mb-0">
                                                @if ($training->training_type == '0')
                                                    Yes
                                                @else
                                                    No
                                                @endif
                    
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="batches_datatable" class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Batch Name</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Maximum Students</th>
                                            <th scope="col">Total Class</th>
                                            <th scope="col">Enrolled Students</th>
                                            {{-- <th scope="col">Action</th> --}}
                                            <th scope="col" class="no-collapse">Add New<span><i
                                                        class="ms-2 uil-plus-circle"></i></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($training->TotalBatches as $batch)
                                            <tr data-bs-toggle="" data-bs-target="#accordion{{ $batch->id }}" class="clickable">
            
                                                <td>{{ @$batch->batch_name }}</td>
                                                <td>{{ @$batch->start_time }}</td>
                                                <td>{{ @$batch->end_time }}</td>
                                                <td>{{ @$batch->max_student }}</td>
                                                <td>{{ @$batch->total_class }}</td>
                                                <td>
                                                    <a href="{{ route('training.admin.student.list', ['batch' => @$batch->id]) }}"
                                                        class="">{{ count(@$batch->trainingOrder) }}</a>
                                                </td>
                                                {{-- <td>
                                                    <a class="btn btn-sm btn-danger" type="button"
                                                        onclick="toggleDiv({{ $batch->id }})" title="View List">
                                                        <i class="uil-arrow-circle-down"></i>
                                                    </a>
                                                </td> --}}
                                                <td>
                                                    @if(Auth::user()->role_id == 3)
                                                    <button class="btn btn-sm custom-btn" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#addModal{{ $batch->id }}">New Batch
                                                    </button>
                                                    @else
                                                    <a href="{{route('training.admin.assign-training-to-user', $batch->id)}}" class="btn btn-sm custom-btn">New Batch</a>
                                                    @endif
                                                    <div class="modal fade mode_vid" id="addModal{{ $batch->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Add New
                                                                        Date</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                    </button>
                                                                </div>
            
                                                                <form
                                                                    action="{{ route('training.admin.batch.details', ['trainingid' => @$batch->training_id, 'batchid' => @$batch->id]) }}"
                                                                    method="POST" id="batch_details_save"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-body">
                                                                        <div class="mb-3 row">
            
                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <label for="" class="col-form-label">Batch Start
                                                                                    Date</label>
                                                                                <input class="form-control form-valid" type="Date"
                                                                                    value="" min="<?php echo date('Y-m-d', strtotime($training->enroll_end_date . ' +1 day')) ; ?>"
                                                                                    id="start_date" name="start_date">
                                                                            </div>
            
                                                                            <div class="col-sm-12 col-lg-6">
                                                                                <label for="" class="col-form-label">Batch End
                                                                                    Date</label>
                                                                                <input class="form-control form-valid" type="Date"
                                                                                    value="" min="<?php echo date('Y-m-d', strtotime($training->enroll_end_date . ' +1 day')) ; ?>"
                                                                                    id="end_date" name="end_date">
                                                                            </div>
            
                                                                        </div>
            
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-secondary"
                                                                            >Reset</button>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="batches_dates_datatable" class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Training Name</th>
                                            <th>Batch Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                            {{-- <th class="no-collapse">Add New<span><i
                                                        class="ms-2 uil-plus-circle"></i></span></th> --}}
            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
            
                                        @if (count($training->TotalBatches) > 0)
                                            @foreach ($training->TotalBatches as $key => $details)
            
                                                @foreach ($details->trainingDetailsByBatch as $key1=> $batchDetails)
                                                    
                                                    <tr>
            
                                                        <td>{{ ++$key1 }}</td>
                                                        <td>{{ $batchDetails->training->name }}</td>
            
                                                        <td>{{ $batchDetails->batch->batch_name }}</td>
            
                                                        <td>{{ $batchDetails->start_date }}</td>
            
                                                        <td>{{ $batchDetails->end_date }}</td>
            
                                                        <td> <a href="{{ route('training.admin.class.list', ['id' => $batchDetails->id]) }}"
                                                                class="btn btn-sm btn-warning">
                                                                View Class</a>
            
                                                        
                                                            {{-- <a href="{{ route('training.admin.exam.create', ['id' => $details->id]) }}"
                                                                class="btn btn-sm btn-warning">
                                                                Start Exam</a> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @else
                                            <p class="text-center">No Batch Dates Found !</p>
                                        @endif
            
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="4-tab">

                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="rating_datatable" class="table table-bordered">
                                    <thead class="table-light">
                                        <tr class="">
                                            <th>Sl. No</th>
                                            <th>Training Name</th>
                                            <th>Student Name</th>
                                            <th>Rating</th>
                                            <th>Feedback</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($training->TrainingReviews as $key => $item)
                                            <tr class="">
                                                <td>{{ ++$key }}</td>
                                                <td>{{@$item->trainingDetails->name}}</td>
                                                <td>{{@$item->userDetails->first_name}}</td>
                                                <td>
                                                    @for ($i = 1; $i <= $item->rate; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                                    @endfor

                                                </td>
                                                <td>{{@$item->feedback}}</td>
                                                <td>
                                                    <a href="{{ route('training.admin.review.delete', [@$item->id]) }}" 
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
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
       
    
@endsection


@section('script')
<script>


    $(document).ready(function () {

        $('#batches_datatable').DataTable();
        $('#batches_dates_datatable').DataTable();
        $('#rating_datatable').DataTable();


        $.validator.addMethod("greaterThanStartDate", function (value, element) {
            var startDateValue = $("#start_date").val();
            return Date.parse(value) > Date.parse(startDateValue);
        }, "End date must be greater than start date");

        $("#batch_details_save").validate({

            rules: {
                start_date: {
                    required: true,
                },
                end_date:{
                    required:true,
                    greaterThanStartDate: true
                }

            },
            messages: {
                start_date: {
                    required: "This field is required",
                },
                end_date: {
                    required: "This field is required",
                    greaterThanStartDate: "End date must be greater than start date"
                },
            },
        })
    });
    // none  hide block means open 
    function toggleDiv(e) {
        var divs = document.querySelectorAll('[id^="myDiv"]');
        for (var i = 0; i < divs.length; i++) {
            var div = divs[i];
            if (div.id === "myDiv" + e) {
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            } else {
                div.style.display = "none";
            }
        }
    }


    function toggleDivclass(e) {
        var divs = document.querySelectorAll('[id^="toggleDivclass"]');
        for (var i = 0; i < divs.length; i++) {
            var div = divs[i];
            if (div.id === "toggleDivclass" + e) {
                if (div.style.display === "none") {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            } else {
                div.style.display = "none";
            }
        }
    }
</script>
@endsection
