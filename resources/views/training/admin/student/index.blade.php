@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Students</h4>

                        <div class="page-title-right">
                            <a href="{{ route('training.admin.student.export') }}"
                                        class="btn btn-md custom-btn">Export All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('training.admin.student.list') }}" method="GET" class="mb-3">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3 mb-3 mb-sm-0">
                                                <label class="form-label" for="">Trainings</label>
                                                <select class="form-select training-data" name="training" id=""
                                                    required>
                                                    <option value="">Select</option>
                                                    @foreach ($trainings as $training)
                                                        <option value="{{ @$training->id }}">{{ @$training->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">Batches</label>
                                                <select class="form-select batches-data" name="batch" id=""
                                                    required>
                                                    <option value="">Select</option>

                                                </select>
                                            </div>
                                            <div class="col-md-2" style="margin-top: 29px">
                                                <button type="submit" class="btn custom-btn"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                @if (!$trainingOrders->isEmpty())
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr class="">
                                                <th>Sl. No</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Training</th>
                                                <th>Batch</th>
                                                <th>Batch Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($trainingOrders as $key => $item)
                                                <tr class="">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ @$item->user->first_name . ' ' . @$item->user->last_name }}</td>
                                                    <td>{{ @$item->user->email }}</td>
                                                    <td>{{ @$item->user->contact_no }}</td>
                                                    <td> <span
                                                            class="badge text-bg-dark">{{ @$item->training->name }}</span>
                                                    </td>
                                                    <td>{{ @$item->batch->batch_name }}</td>
                                                    <td>{{ \carbon\Carbon::parse(@$item->userTrainingDetails->start_date)->toFormattedDateString() ." - ".  \Carbon\Carbon::parse(@$item->userTrainingDetails->end_date)->toFormattedDateString()}}</td>

                                                    <td>
                                                        <button title="Edit" class="btn custom-btn btn-sm"
                                                            data-bs-target="#exampleModalToggle-{{ @$item->id }}"
                                                            data-bs-toggle="modal"><i class="fas fa-pencil-alt"></i></button>
                                                    </td>


                                                        <div class="modal  fade"
                                                            id="exampleModalToggle-{{ @$item->id }}" aria-hidden="true"
                                                            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            {{ @$item->user->first_name }} Training Details
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>

                                                                    @php
                                                                        $trainingBatches = App\Models\Training\TrBatch::where('training_id', @$item->training_id)->get();
                                                                    @endphp


                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('training.student.branch.update', $item->id) }}"
                                                                            method="POST" id="student_update"
                                                                            enctype="multipart/form-data">
                                                                            @method('PUT')
                                                                            @csrf
                                                                            <div class="modal-body text-start">
                                                                                <div class="row">

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Training
                                                                                            Name : </label>
                                                                                    </div>
                                                                                    <div class="col-md-2">&nbsp;</div>
                                                                                    <div class="col-md-6">
                                                                                        {{ @$item->training->name }}
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Training
                                                                                            Duration : </label>
                                                                                    </div>
                                                                                    <div class="col-md-2">&nbsp;</div>

                                                                                    <div class="col-md-6">
                                                                                        {{ @$item->training->training_duration }}
                                                                                        {{ @$item->training->training_duration_type }}
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Batch Name
                                                                                            : </label>
                                                                                    </div>
                                                                                    <div class="col-md-2">&nbsp;</div>
                                                                                    <div class="col-md-6">
                                                                                        {{ @$item->batch->batch_name }}
                                                                                    </div>


                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Batch
                                                                                            Date : </label>
                                                                                    </div>
                                                                                    <div class="col-md-2">&nbsp;</div>

                                                                                    <div class="col-md-6">
                                                                                        {{ \carbon\Carbon::parse(@$item->userTrainingDetails->start_date)->toFormattedDateString() ." - ".  \Carbon\Carbon::parse(@$item->userTrainingDetails->end_date)->toFormattedDateString()}}
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Batch
                                                                                            Timing : </label>
                                                                                    </div>
                                                                                    <div class="col-md-2">&nbsp;</div>

                                                                                    <div class="col-md-6">
                                                                                        {{ @$item->batch->start_time }} -
                                                                                        {{ @$item->batch->end_time }}
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Change
                                                                                            Batch :<sup><span
                                                                                                    style="color: red;">*</span></sup></label>
                                                                                    </div>
                                                                                    <div class="col-md-2">&nbsp;</div>
                                                                                    <div class="col-md-6">
                                                                                        <select class="form-control"
                                                                                            name="batch_id"
                                                                                            id="change-batch">
                                                                                            @foreach ($trainingBatches as $batch)
                                                                                                <option
                                                                                                    value="{{ @$batch->id }}"
                                                                                                    {{ @$batch->id == @$item->batch_id ? 'selected' : '' }}>
                                                                                                    {{ @$batch->batch_name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">

                                                                            <button type="submit"
                                                                                class="btn custom-btn">Update Batch</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </t>
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
                    {{-- <div class="m-4">
                        {!! $trainingOrders->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
    <script>
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
                           selectElement.append('<option value="">Select</option>')
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
