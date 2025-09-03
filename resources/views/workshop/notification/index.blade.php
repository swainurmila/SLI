@extends('workshop.layouts.backend.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->


            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>WORKSHOP NOTIFICATION</b> </h4>
                    </div>
                </div>

                <div class="col-2">
                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#addModal">Add Notification</button>
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
                                            <th>For Workshop</th>
                                            <th>Notification Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            {{-- {{dd($item->workshop->title)}} --}}
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->workshop->title ?? '-' }}</td>
                                                <td>{{ $item->notification_title }}</td>
                                                <td>
                                                    <a href="{{ route('workshop-delete-notification', [$item->id]) }}"
                                                         onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('workshop-delete-notification', [$item->id]) }}"
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
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Edit Workshop
                                                                    Notification
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"  onClick="refreshPage()" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('workshop-notification-update', $item->id) }}"
                                                                method="POST" id="workshop_edit{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">For
                                                                                    Workshop:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <select id="selectworkshop"
                                                                                    class="form-select form-valid"             name="workshop_id">
                                                                                    <option value="">Select</option>
                                                                                    @foreach ($workshop as $ws)
                                                                                        <option value="{{ $ws->id }}"
                                                                                            {{ $ws->id == $item->workshop_id ? 'selected' : '' }}>
                                                                                            {{ $ws->title }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <span id="workshop_error"
                                                                                    class="text-danger"></span>
                                                                                @if ($errors->has('workshop_id'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('workshop_id') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Notification
                                                                                    Title:</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="notification_title"
                                                                                    placeholder="Notification Title"
                                                                                    id="notification_title"
                                                                                    value="{{ @$item->notification_title }}"
                                                                                    oninput="capitalizeFirstLetter(this)">
                                                                                <span id="notification_title_error"
                                                                                    class="text-danger"></span>
                                                                                @if ($errors->has('notification_title'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('notification_title') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Start
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="add_start_date"
                                                                                    id="edit_start_date"
                                                                                    value="{{ @$item->start_date }}">
                                                                                <span id="start_date_error"
                                                                                    class="text-danger"></span>
                                                                                @if ($errors->has('add_start_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('add_start_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">End
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="add_end_date" id="edit_end_date"
                                                                                    value="{{ @$item->end_date }}">
                                                                                <span id="end_date_error"
                                                                                    class="text-danger"></span>
                                                                                @if ($errors->has('add_end_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('add_end_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                                                                    <button type="submit" class="btn custom-btn"
                                                                        onclick="return editNotification({{ @$item->id }})">Update</button>
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

                    {{-- <div class="m-4">
                        {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div> --}}
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add Workshop Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"   onClick="refreshPage()"aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('workshop-notification-store') }}" method="POST" id="workshop-notification-form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">For Workshop:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <select id="selectworkshop" class="form-select form-valid" name="workshop_id"
                                        id="workshop_id">
                                        <option value="select">Select</option>
                                        @foreach ($workshop as $ws)
                                            <option value="{{ $ws->id }}">
                                                {{ $ws->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('workshop_id'))
                                        <span class="text-danger">{{ $errors->first('workshop_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Notification Title <Title></Title>:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" class="form-control" name="notification_title"
                                        placeholder="Notification Title" id="notification_title" maxlength="20"
                                        pattern="[a-zA-Z\s]+" onkeypress="return validateKeyPress(event)"
                                        oninput="capitalizeFirstLetter(this)">
                                    @if ($errors->has('notification_title'))
                                        <span class="text-danger">{{ $errors->first('notification_title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Apply Start Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" name="start_date" id="add_start_date"
                                        min="{{ date('Y-m-d') }}">
                                    @if ($errors->has('add_start_date'))
                                        <span class="text-danger">{{ $errors->first('add_start_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Apply End Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" name="end_date" id="add_end_date"
                                        min="{{ date('Y-m-d') }}">
                                    @if ($errors->has('add_end_date'))
                                        <span class="text-danger">{{ $errors->first('add_end_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
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
            // Custom method to validate dates
            $.validator.addMethod("greaterThan", function(value, element, params) {
                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }
                return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
            }, 'Must be greater than the start date.');

            $("#workshop-notification-form").validate({
                rules: {
                    workshop_id: {
                        required: true,
                        notEqual: "select"
                    },
                    notification_title: {
                        required: true,
                        maxlength: 20,
                    },
                    start_date: {
                        required: true,
                        date: true
                    },
                    end_date: {
                        required: true,
                        date: true,
                        greaterThan: "#add_start_date"
                    }
                },
                messages: {
                    workshop_id: {
                        required: "Please select a workshop",
                        notEqual: "Please select a workshop"
                    },
                    notification_title: {
                        required: "Please enter a notification title",
                        maxlength: "Notification title must be 10 characters long"
                    },
                    start_date: {
                        required: "Please select a start date",
                        date: "Please enter a valid date"
                    },
                    end_date: {
                        required: "Please select an end date",
                        date: "Please enter a valid date",
                        greaterThan: "End date must be greater than start date"
                    }
                }
            });


            // $('form[id^="workshop_edit"]').each(function() {
            //     $(this).validate({
            //         rules: {
            //             workshop_id: {
            //                 required: true,
            //                 notEqual: "select"
            //             },
            //             notification_title: {
            //                 required: true,
            //                 maxlength: 20,
            //             },
            //             start_date: {
            //                 required: true,
            //                 date: true
            //             },
            //             end_date: {
            //                 required: true,
            //                 date: true,
            //                 greaterThan: "#add_start_date"
            //             }
            //         },
            //         messages: {
            //             workshop_id: {
            //                 required: "Please select a workshop",
            //                 notEqual: "Please select a workshop"
            //             },
            //             notification_title: {
            //                 required: "Please enter a notification title",
            //                 maxlength: "Notification title must be 10 characters long"
            //             },
            //             start_date: {
            //                 required: "Please select a start date",
            //                 date: "Please enter a valid date"
            //             },
            //             end_date: {
            //                 required: "Please select an end date",
            //                 date: "Please enter a valid date",
            //                 greaterThan: "End date must be greater than start date"
            //             }
            //         }
            //     });
            // });


            $('#add_start_date, #add_end_date').on('change', function() {
                $(this).valid();
            });
            // Custom validator method for select default value
            $.validator.addMethod("notEqual", function(value, element, param) {
                return this.optional(element) || value != param;
            }, "Please select a value");

            // Function to capitalize first letter of each word in the notification title
            function capitalizeFirstLetter(str) {
                return str.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            }

            $('#notification_title').on('input', function() {
                this.value = capitalizeFirstLetter(this.value);
            });
            $('#addModal').on('hidden.bs.modal', function() {
                $("#workshop-notification-form").trigger("reset");
                $("#workshop-notification-form").validate().resetForm();
            });
            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('form').trigger("reset");
                $(this).find('form').validate().resetForm();
            });

        });
    </script>
    <script>
        function editNotification(id) {
            var isValid = true;

            var workshopId = document.getElementById('selectworkshop').value.trim();
            var notificationTitle = document.getElementById('notification_title').value.trim();
            var startDate = document.getElementById('edit_start_date').value.trim();
            var endDate = document.getElementById('edit_end_date').value.trim();

            // Clear previous error messages
            document.getElementById('workshop_error').textContent = '';
            document.getElementById('notification_title_error').textContent = '';
            document.getElementById('start_date_error').textContent = '';
            document.getElementById('end_date_error').textContent = '';

            if (workshopId === '' || workshopId == null) {
                document.getElementById('workshop_error').textContent = 'Please select a workshop';
                isValid = false;
            }
            if (notificationTitle === '' || notificationTitle == null) {
                document.getElementById('notification_title_error').textContent = 'Please enter a notification title';
                isValid = false;
            }
            if (startDate === '' || startDate == null) {
                document.getElementById('start_date_error').textContent = 'Please enter a start date';
                isValid = false;
            }
            if (endDate === '' || endDate == null) {
                document.getElementById('end_date_error').textContent = 'Please enter an end date';
                isValid = false;
            }

            return isValid;
        }
    </script>
    <script>
        function capitalizeFirstLetter(input) {
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
        }
        function refreshPage() {
            window.location.reload();
        }
    </script>

    {{-- <script>
        $(document).ready(function() {

     ator.addMethod("greaterThanOrEqual", function(value, element, params) {
                return this.optional(element) || new Date(value) >= new Date($(params).val());
            }, "End date must be after or equal to start date.");

            // Validate the form
            $("#workshop_edit{{ @$item->id }}").validate({
                rules: {
                    workshop_id: {
                        required: true
                    },
                    notification_title: {
                        required: true,
                        maxlength: 255
                    },
                    add_start_date: {
                        required: true,
                        date: true
                    },
                    add_end_date: {
                        required: true,
                        date: true,
                        greaterThanOrEqual: "#edit_start_date"
                    }
                },
                messages: {
                    workshop_id: {
                        required: "Please select a workshop."
                    },
                    notification_title: {
                        required: "Notification title is required.",
                        maxlength: "Notification title cannot exceed 255 characters."
                    },
                    add_start_date: {
                        required: "Start date is required.",
                        date: "Please enter a valid date."
                    },
                    add_end_date: {
                        required: "End date is required.",
                        date: "Please enter a valid date.",
                        greaterThanOrEqual: "End date must be after or equal to start date."
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });
        });
    </script>--}}
    <script>
        function validateKeyPress(event) {
            // Prevent spaces at the beginning of the input
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }

            // Allow only letters and spaces
            const regex = /^[a-zA-Z\s]*$/;
            return regex.test(event.key);
        }
    </script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>
@endsection
