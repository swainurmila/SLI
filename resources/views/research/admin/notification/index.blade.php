@extends('research.layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->


            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>Paper Notification</b> </h4>
                    </div>
                </div>

                <div class="col-2">
                    @if (date('Y-m-d') > @$latestNotification->end_date)
                        <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#addModal">Add Notification</button>
                    @endif
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
                                            <th>Notification Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            {{-- {{dd($data)}} --}}
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ @$item->notification_title }}</td>
                                                <td>{{ @$item->start_date ? \Carbon\Carbon::parse(@$item->start_date)->toFormattedDateString() : '---' }}
                                                </td>
                                                <td>{{ @$item->end_date ? \Carbon\Carbon::parse(@$item->end_date)->toFormattedDateString() : '---' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('delete-category', [$item->id]) }}"
                                                        onclick="event.preventDefault(); confirmDelete({{ $item->id }});"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('research.notification.destroy', [$item->id]) }}"
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
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Paper
                                                                    Notification
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"
                                                                    id="reloadButton">
                                                                </button>
                                                            </div>

                                                            <form
                                                                action="{{ route('research.notification.update', $item->id) }}"
                                                                method="POST" id="category_edit{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                @method('PATCH')
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Notification
                                                                                    Title:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="text" class="form-control"
                                                                                    name="notification_title"
                                                                                    id="notification_title"
                                                                                    value="{{ @$item->notification_title }}"
                                                                                    pattern="[a-zA-Z\s]+"
                                                                                    title="The category subject name must contain only letters and spaces."
                                                                                    onkeypress="return validateKeyPress(event)"
                                                                                    maxlength="50">
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
                                                                                    name="start_date" id="edit_start_date"
                                                                                    value="{{ @$item->start_date }}">
                                                                                @if ($errors->has('start_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('start_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">End
                                                                                    Date:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="date" class="form-control"
                                                                                    name="end_date" id="edit_end_date"
                                                                                    value="{{ @$item->end_date }}">
                                                                                @if ($errors->has('end_date'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('end_date') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add Paper Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('research.notification.store') }}" method="POST" id="paper-notification-form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Notification Title:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" class="form-control" name="notification_title"
                                        id="notification_title" pattern="[a-zA-Z\s]+"
                                        title="The category subject name must contain only letters and spaces."
                                        onkeypress="return validateKeyPress(event)" maxlength="50">
                                    @if ($errors->has('notification_title'))
                                        <span class="text-danger">{{ $errors->first('notification_title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Apply Start Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>"
                                        name="start_date" id="start_date">
                                    @if ($errors->has('start_date'))
                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Apply End Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>" name="end_date"
                                        id="end_date">
                                    @if ($errors->has('end_date'))
                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#reloadButton, #reloadclose').on('click', function() {
                location.reload();
            });
        });
    </script>
    <script>
        $('#addModal').on('hidden.bs.modal', function() {
            location.reload();
        })
        $.validator.addMethod("greaterThanStartDate", function(value, element) {
            var startDate = $('#start_date').val();
            var endDate = value;

            if (!startDate || !endDate) {
                return true;
            }

            var startDateParts = startDate.split('-');
            var endDateParts = endDate.split('-');

            var startDateTime = new Date(startDateParts[0], startDateParts[1] - 1, startDateParts[
                2]);
            var endDateTime = new Date(endDateParts[0], endDateParts[1] - 1, endDateParts[2]);

            return endDateTime > startDateTime;
        }, "End date must be greater than start date");

        $("#paper-notification-form").validate({
            rules: {
                notification_title: {
                    required: true,
                },
                start_date: {
                    required: true,
                },
                end_date: {
                    required: true,
                    greaterThanStartDate: true
                },
            },
            messages: {
                notification_title: {
                    required: "Notification title is required",
                },
                start_date: {
                    required: "Start Date field is required",
                },
                end_date: {
                    required: "End Date field is required",
                },
            },
        });
        $('#start_date, #end_date').on('change', function() {
            $(this).valid();
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Get the input elements for start date and end date
            var startDateInput = document.getElementById('edit_start_date');
            var endDateInput = document.getElementById('edit_end_date');

            // Add event listener for input change on end date
            endDateInput.addEventListener('change', function() {
                // Parse the dates
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                // Compare the dates
                if (endDate <= startDate) {
                    alert('End date must be greater than start date.');
                    endDateInput.value = ''; // Clear the end date input
                }
            });
        });
    </script>
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
