@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Assign Batch</h4>

                        <div class="page-title-right">

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('training.admin.assign-training-store') }}" method="POST" class="mb-3"
                                id="assignuserform">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($training_details)
                                            <div class="mb-3 row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="" class="col-form-label">Batch Start
                                                        Date</label>
                                                    <input class="form-control form-valid" type="Date" id="start_date"
                                                        name="start_date" value="{{ $training_details->start_date }}" readonly>
                                                </div>

                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="" class="col-form-label">Batch End
                                                        Date</label>
                                                    <input class="form-control form-valid" type="Date" id="end_date"
                                                        name="end_date" value="{{ $training_details->end_date }}" readonly>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-3 row">
                                                <input type="hidden" name="training_id" value="{{ $training->id }}">
                                                <input type="hidden" name="batch_id" value="{{ $training->Batch->id }}">
                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="" class="col-form-label">Batch Start
                                                        Date</label>
                                                    <input class="form-control form-valid" type="Date" value=""
                                                        min="<?php echo date('Y-m-d', strtotime($training->enroll_end_date . ' +1 day')); ?>" id="start_date" name="start_date">
                                                </div>

                                                <div class="col-sm-12 col-lg-6">
                                                    <label for="" class="col-form-label">Batch End
                                                        Date</label>
                                                    <input class="form-control form-valid" type="Date" value=""
                                                        min="<?php echo date('Y-m-d', strtotime($training->enroll_end_date . ' +1 day')); ?>" id="end_date" name="end_date">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    {{-- @if ($training_details)
                                        <table class="table table-centered table-bordered table-nowrap mb-0 ">
                                            <thead class="table-light ">
                                                <tr class="text-center">
                                                    <th>Sl. No.</th>
                                                    <th>Student Name</th>
                                                    <th>Qualification</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($training_details->trainingOrder as $key => $value)
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            {{ ++$key }}
                                                        </td>
                                                        <td>
                                                            {{ $value->user->first_name }} {{ $value->user->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ isset($value->user->education) && isset($value->user->course_name) ? $value->user->education . '(' . $value->user->course_name . ')' : '-' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else --}}

                                        @if (!$users->isEmpty())
                                            
                                            <table class="table table-centered table-bordered table-nowrap mb-0 ">
                                                <thead class="table-light ">
                                                    <tr class="text-center">
                                                        <th>
                                                            <span class="text-success me-1">Select All</span>
                                                            <input type="checkbox" id="checkbox1" name="checkbox1"
                                                                onclick="toggleCheckboxes()">
                                                        </th>
                                                        <th>Student Name</th>
                                                        <th>Qualification</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $key => $value)


                                                        @php
                                                            $trainingOrder = App\Models\Training\TrTrainingOrder::where('user_id',$value->id)->where('training_id',@$training->id)->where('training_details_id',@$training_details->id)->first();
                                                        @endphp
                                                        <tr>
                                                            <td style="text-align: center;">
                                                                <label>
                                                                    {{-- <input type="checkbox"
                                                                        onchange="changeClass(this,{{ $key }})"
                                                                        id="select_student{{ $key }}"
                                                                        name="select_student[{{ $key }}_{{ $value->id }}]"
                                                                        value="1" class="select-student"> --}}

                                                                    <input type="checkbox"
                                                                        id="select_student{{ $key }}"
                                                                        name="{{ $key }}" {{@$trainingOrder ? 'checked disabled' : ''}} value="{{ @$value->id }}"
                                                                        class="select-student">
                                                                </label>
                                                            </td>
                                                            <td>
                                                                {{ $value->first_name }} {{ $value->last_name }}
                                                            </td>
                                                            <td>{{ isset($value->education) && isset($value->course_name) ? $value->education . '(' . $value->course_name . ')' : '-' }}
                                                            </td>
                                                            
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    {{-- @endif --}}
                                </div><br>
                                @if ($training_details)
                                    <a href="{{ route('training.admin.about',@$training->id) }}" class="btn custom-btn">Back</a>

                                    <input type="hidden" value="{{@$training->id}}" name="training_id">
                                    <input type="hidden" name="batch_id" value="{{ $training->Batch->id }}">
                                    <input type="hidden" name="training_details" value="{{ $training_details->id }}">


                                    <button type="submit" id=""
                                        class="btn custom-btn">Save</button>
                                @else
                                    <button type="submit" disabled id=""
                                        class="btn custom-btn batch_save_btn">Save</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
                <div class="m-4">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Assuming $trainings contains your data
        var trainings = <?php echo json_encode($trainingsArray); ?>;
        // alert(JSON.stringify(trainings)); 
        // Attach event listener to validate dates on change
        document.getElementById('start_date').addEventListener('change', validateDates);
        document.getElementById('end_date').addEventListener('change', validateDates);

        var alertShown = false;

        function validateDates() {
            var startDate = new Date(document.getElementById('start_date').value);
            var endDate = new Date(document.getElementById('end_date').value);

            for (var i = 0; i < trainings.length; i++) {
                var trainingStartDate = new Date(trainings[i].start_date);
                var trainingEndDate = new Date(trainings[i].end_date);

                if ((startDate >= trainingStartDate && startDate <= trainingEndDate) ||
                    (endDate >= trainingStartDate && endDate <= trainingEndDate)) {
                    if (!alertShown) { // Check if alert has been shown
                        alert('Selected dates fall within existing training dates. Please select different dates.');
                        alertShown = true; // Set the flag to true


                        console.log('aaa');
                        $('.batch_save_btn').attr('disabled',true);
                    }
                    return false;
                }
            }

            console.log('bbbb')
            alertShown = false; // Reset the flag if validation passes
            $('.batch_save_btn').attr('disabled',false);
            return true;
        }
    </script>
    <script>
        function toggleCheckboxes() {
            var checkboxes = document.querySelectorAll('.select-student');
            var selectAllCheckbox = document.getElementById('checkbox1');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = selectAllCheckbox.checked;
            }
        }
    </script>
    <script>
        $(document).ready(function() {

            $.validator.addMethod("greaterThanStartDate", function(value, element) {
                var startDate = $('#start_date').val();
                var endDate = value;

                if (!startDate || !endDate) {
                    // If either field is empty, no comparison needed
                    return true;
                }

                // Parse dates to compare
                var startDateTime = Date.parse(startDate);
                var endDateTime = Date.parse(endDate);

                if (isNaN(startDateTime) || isNaN(endDateTime)) {
                    // If either date is invalid, validation should fail
                    return false;
                }

                // Compare dates
                return endDateTime > startDateTime;
            }, "End date must be greater than start date");


            $('#assignuserform').validate({
                rules: {
                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true,
                        greaterThanStartDate: true
                    }
                },
                messages: {
                    start_date: {
                        required: "Please enter the start date."
                    },
                    end_date: {
                        required: "Please enter the end date."
                    }
                },
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
        $('#training_dropdown').on('change', function() {
            //alert(123);
            var training_id = this.value;
            $.ajax({
                url: "{{ route('training.admin.get_training') }}",
                type: "get",
                data: {
                    training_id: training_id,
                },
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                dataType: 'json',
                success: function(result) {
                    console.log(result)
                    $('#batch_dropdown').empty();
                    $.each(result.batch, function(key, value) {
                        $("#batch_dropdown").append('<option value="' + value.id +
                            '">' + value.batch_name + '</option>');
                    });
                }
            });
        });
    </script>
@endsection
