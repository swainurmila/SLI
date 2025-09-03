@extends('training.admin.layouts.page-layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training Details</h4>

                        <div class="page-title-right">
                            <a href="{{ route('training.createTraining') }}" class="btn custom-btn  btn-md">Add
                                Training</a>
                        </div>

                    </div>
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
                                                <th>Training Name</th>
                                                <th>Training Duration</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($trainings as $key => $item)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    {{-- <td>
                                                        @if ($item->payment_type == 0)
                                                            <span class="badge text-bg-success">Free</span>
                                                        @else
                                                            <span class="badge text-bg-dark">Paid</span>
                                                        @endif
                                                    </td> --}}
                                                    <td>{{ $item->training_duration . ' ' . $item->training_duration_type }}
                                                    </td>
                                                    <td>{{ number_format(@$item->price, 2, '.', ',') }}</td>
                                                    {{-- <td>{{ $item->User->role ?? '-' }}</td> --}}

                                                    <td>

                                                        <a href="{{ route('training.editTraining', ['id' => $item->id]) }}"
                                                            class="btn btn-outline-info btn-sm edit" title="EditTraining"><i
                                                                class="uil-edit-alt"></i></a>

                                                        <a href="{{ route('training.admin.about', ['id' => $item->id]) }}"
                                                            class="btn custom-btn btn-sm" title="About-Training">More<i
                                                                class="uil-info-circle ms-2"></i></a>
                                                        {{-- <button title="View"
                                                            class="btn btn-outline-warning btn-sm"
                                                            data-bs-target="#exampleModalToggle-{{ @$item->id }}"
                                                            data-bs-toggle="modal"><i
                                                                class="fa fa-eye"></i></button> --}}

                                                        @php
                                                            $batches = App\Models\Training\TrBatch::with(
                                                                'trainingOrder',
                                                            )
                                                                ->where('training_id', @$item->id)
                                                                ->get();

                                                        @endphp


                                                        <div class="modal modal-lg fade"
                                                            id="exampleModalToggle-{{ @$item->id }}" aria-hidden="true"
                                                            aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalToggleLabel2">
                                                                            {{ @$item->name }} -
                                                                            Batches List</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="table-responsive">

                                                                            <table
                                                                                class="table table-centered table-nowrap mb-0">
                                                                                <thead class="table-secondary">
                                                                                    <tr>
                                                                                        <th>Sl. No</th>
                                                                                        <th>Batch Name</th>
                                                                                        <th>Start Time</th>
                                                                                        <th>End Time</th>
                                                                                        <th>Max Students</th>
                                                                                        <th>Total Class</th>
                                                                                        <th class="text-center">
                                                                                            Actions</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="table-group-divider">
                                                                                    @foreach ($batches as $batchkey => $batch)
                                                                                        @php
                                                                                            $class_count = App\Models\Training\TrTrainingClass::where(
                                                                                                'batch_id',
                                                                                                @$batch->id,
                                                                                            )->count();
                                                                                        @endphp

                                                                                        <tr>
                                                                                            <td class="text-center">
                                                                                                {{ ++$batchkey }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $batch->batch_name }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $batch->start_time }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $batch->end_time }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $batch->max_student }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                {{ $batch->total_class }}
                                                                                            </td>
                                                                                            <td class="text-center">


                                                                                                @if (count(@$batch->trainingOrder) > 0)
                                                                                                    <a href="{{ route('training.admin.student.list', ['batch' => @$batch->id]) }}"
                                                                                                        class="btn btn-sm custom-btn position-relative">
                                                                                                        Show Enroll
                                                                                                        Students
                                                                                                        <span
                                                                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                                                            {{ count(@$batch->trainingOrder) > 10 ? '10+' : count(@$batch->trainingOrder) }}</span>

                                                                                                    </a>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="text-center">No
                                                                                                        Enrollment
                                                                                                        Found</span>
                                                                                                @endif

                                                                                                {{-- <a href="{{ route('training.admin.class.list', ['id' => @$batch->id]) }}"
                                                                                class="btn btn-sm custom-btn  position-relative">
                                                                                Class
                                                                                <span
                                                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{@$class_count}}</span>

                                                                            </a> --}}

                                                                                                <a href="{{ route('training.admin.batch.details', ['trainingid' => @$item->id, 'batchid' => @$batch->id]) }}"
                                                                                                    class="btn btn-sm custom-btn  position-relative">
                                                                                                    Batch Details

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
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('user.add-user-details') }}" method="POST" id="user_details_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 row">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">First Name</label>
                                    <input class="form-control" type="text" name="first_name" required>
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" required>
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Name</label>
                                    <input class="form-control" type="text" name="user_name" required>
                                    @if ($errors->has('user_name'))
                                        <div class="error">{{ $errors->first('user_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Password</label>
                                    <input class="form-control" type="password" value="" name="password" required>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" required>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Contact No</label>
                                    <input class="form-control" type="text" name="contact_no" pattern="[6-9]\d{9}"
                                        title="Please enter a valid 10-digit contact number starting with 6, 7, 8, or 9"
                                        maxlength="10" required>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">State</label>
                                    <select class="form-select select2" name="state_id" id="add_state_dropdown" required>
                                        <option value="">Select</option>

                                    </select>

                                    @if ($errors->has('state_id'))
                                        <div class="error">{{ $errors->first('state_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label class="col-form-label">District</label>
                                    <select class="form-select select2" name="district_id" id="district_dropdown"
                                        required>
                                        <option value="">Select District</option>
                                    </select>
                                    @if ($errors->has('district_id'))
                                        <div class="error">{{ $errors->first('district_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Present
                                        Address</label>
                                    <textarea name="present_address" class="form-control" required></textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">Permanent
                                        Address</label>
                                    <textarea name="permanent_address" class="form-control" required></textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="" class="col-form-label">User Mode</label>
                                    <select class="form-select" name="user_mode" required>
                                        <option value="">Select</option>
                                        <option value="2">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile
                                        Photo</label>

                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="profile_photo" required>
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
    
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#add_state_dropdown').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.get_city') }}",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#district_dropdown').empty();
                        $.each(result.city, function(key, value) {
                            $("#district_dropdown").append('<option value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable_1').DataTable();
            $('#datatable_2').DataTable();

            $('#datatable_3').DataTable();
        });
    </script>
@endsection
