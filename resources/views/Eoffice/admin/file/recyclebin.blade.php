@extends('Eoffice.admin.layouts.page-layouts.main')
@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <style type="text/css">
        .dropdown-toggle {

            height: 40px;

            width: 240px !important;

        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active text-custom-primary">Recyclebin</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mt-3 table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl. No.
                                            </th>
                                            <th>File No.
                                            </th>
                                            <th>Subject</th>
                                            <th>Sent On</th>
                                            <th>Deleted Form</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($office_files as $key => $file)
                                            <tr>
                                                <td>{{ ++$key }}
                                                </td>
                                                <td>
                                                    <p>{{ $file->officeFileFlow->officeFile->file_no }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $file->officeFileFlow->subject }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ isset($file->officeFileFlow->created_at) ? $file->officeFileFlow->created_at->format('d-m-Y') : 'NA' }}
                                                    </p>

                                                </td>
                                                <td>
                                                    <p>{{ $file->deleted_form }}</p>
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.office.restore-file', ['id' => @$file->id]) }}"
                                                        class="btn custom-btn btn-sm  waves-effect waves-light"
                                                        title="Restore">Restore
                                                    </a>
                                                    @if ($file->deleted_form == 'Draft')
                                                        <button type="button"
                                                            class="btn custom-btn btn-sm waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#send-modal{{ @$file->id }}">Forward</button>

                                                        <button type="button"
                                                            class="btn custom-btn btn-sm waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#reply-modal{{ @$file->id }}">Reply</button>
                                                        <a href="{{ route('admin.office.delete-recyclebin-file', $file->id) }}"
                                                            onclick="event.preventDefault(); confirmDelete({{ $file->id }});"
                                                            class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                            title="Delete Record">
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                        <form id="delete-form-{{ $file->id }}"
                                                            action="{{ route('admin.office.delete-recyclebin-file', $file->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('POST')
                                                        </form>
                                                    @endif
                                                </td>
                                                {{-- {{dd($file->officeDraft->remarks)}} --}}
                                                <div class="modal fade" id="send-modal{{ $file->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Forward Form</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="{{ route('admin.office.sentFile') }}"
                                                                    method="POST" id="send_file{{ $file->id }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">To</label>
                                                                            <select
                                                                                class="form-select form-valid{{ $file->id }}"
                                                                                id="to_user_id{{ $file->file_id }}"
                                                                                name="to_user_id">

                                                                                <option value="">Select</option>
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}">
                                                                                        {{ $users->first_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Subject</label>
                                                                            <input type=""
                                                                                class="form-control form-valid{{ $file->id }} save-draft"
                                                                                name="subject" readonly
                                                                                value="{{ @$file->officeFileFlow->subject }}"
                                                                                id="subject{{ $file->file_id }}"
                                                                                placeholder="">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label" for="">Receipt
                                                                                No.</label>
                                                                            <input type="" readonly
                                                                                class="form-control form-valid{{ $file->id }} save-draft"
                                                                                id="receipt_no{{ $file->file_id }}"
                                                                                value="{{ @$file->officeFileFlow->officeFile->file_no }}"
                                                                                name="receipt_no" placeholder="">
                                                                            <input type="hidden"
                                                                                class="form-control form-valid{{ $file->id }}"
                                                                                id="file_id{{ $file->id }}"
                                                                                name="file_id" value="{{ $file->file_id }}"
                                                                                placeholder="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="emailSelect">CC</label>
                                                                            <select id="forwardemailSelect"
                                                                                class="selectpicker form-control" multiple
                                                                                data-live-search="true"
                                                                                onchange="updateForwardSelectedUsers()">
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}">
                                                                                        {{ $users->first_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <input type="hidden" name="cc_user_id"
                                                                                id="forward_cc_users">
                                                                        </div>
                                                                        <input type="hidden" id="selectedEmails"
                                                                            name="selectedEmails">

                                                                        <div class="col-md-4">
                                                                            <label class="form-label" for="">Set
                                                                                Due Date</label>
                                                                            <input type="date" name="due_date"
                                                                                class="form-control form-valid{{ $file->id }} save-draft"
                                                                                id="due_date{{ $file->file_id }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Priority</label>
                                                                            <select name="priority_type"
                                                                                class="form-select form-valid{{ $file->id }} save-draft"
                                                                                id="priority_type{{ $file->file_id }}">
                                                                                <option value="">Select</option>
                                                                                @foreach ($priorities as $priority)
                                                                                    <option value="{{ @$priority->id }}"
                                                                                        {{ @$priority->id == @$file->officeFileFlow->officeFile->priority_type ? 'selected' : '' }}>
                                                                                        {{ @$priority->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    @if ($file->deleted_form == 'Draft')
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="">Message</label>
                                                                                <textarea name="remarks" class="form-control form-valid{{ $file->id }} save-draft"
                                                                                    value="{{ @$file->officeDraft->remarks }}" id="remarks{{ $file->file_id }}" cols="10" rows="5">{{ @$file->officeDraft->remarks }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="">Message</label>
                                                                                <textarea name="remarks" class="form-control form-valid{{ $file->id }} save-draft"
                                                                                    value="{{ @$file->officeFileFlow->remarks }}" id="remarks{{ $file->file_id }}" cols="10" rows="5">{{ @$file->officeFileFlow->remarks }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if ($file->deleted_form == 'Draft')
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="">Forward
                                                                                    Message</label>
                                                                                <textarea name="forward_message" class="form-control form-valid{{ $file->id }} save-draft"
                                                                                    value="{{ @$file->officeDraft->forward_message }}" id="forward_message{{ $file->file_id }}" cols="10"
                                                                                    rows="5">{{ @$file->officeDraft->forward_message }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        @if (@$file->officeFileFlow->forward_message)
                                                                            <div class="row mb-3">
                                                                                <div class="col-md-12">
                                                                                    <label class="form-label"
                                                                                        for="">Forward
                                                                                        Message</label>
                                                                                    <textarea name="forward_message" class="form-control form-valid{{ $file->id }} save-draft"
                                                                                        value="{{ @$file->officeFileFlow->forward_message }}" id="forward_message{{ $file->file_id }}" cols="10"
                                                                                        rows="5">{{ @$file->officeFileFlow->forward_message }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    <input type="hidden" name="draft_id"
                                                                        value="{{ $file->draft_id }}">
                                                                    <div class="text-end mt-3">
                                                                        <button type="button"
                                                                            onclick="saveForm({{ $file->id }})"
                                                                            class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
                                                <!--reply form modal-->
                                                {{-- {{dd($file->draft_id)}} --}}
                                                <div class="modal fade" id="reply-modal{{ $file->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reply Form</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form action="{{ route('admin.office.replyFile') }}"
                                                                    method="POST" id="replyfile{{ $file->id }}"
                                                                    enctype="multipart/form-data">

                                                                    @csrf


                                                                    <div class="row mb-3">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">To</label>

                                                                            <select
                                                                                class="form-select form-valid-reply{{ $file->id }}"
                                                                                name="to_user_id">
                                                                                <option value="">Select</option>
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}"
                                                                                        {{ $file->officeUser->id == $users->id ? 'selected' : '' }}>
                                                                                        {{ $users->first_name }}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Subject</label>
                                                                            <input type="" readonly
                                                                                class="form-control form-valid-reply{{ $file->id }}"
                                                                                name="subject"
                                                                                value="{{ @$file->officeFileFlow->subject }}"
                                                                                id="" placeholder="">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Receipt
                                                                                No.</label>
                                                                            <input type="" readonly
                                                                                class="form-control form-valid-reply{{ $file->id }}"
                                                                                id=""
                                                                                value="{{ @$file->officeFileFlow->officeFile->file_no }}"
                                                                                name="receipt_no" placeholder="">
                                                                            <input type="hidden"
                                                                                class="form-control form-valid-reply{{ $file->id }}"
                                                                                id="" name="file_id"
                                                                                value="{{ $file->file_id }}"
                                                                                placeholder="">
                                                                        </div>


                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="emailSelect">CC</label>
                                                                            <select id="replyemailSelect"
                                                                                class="selectpicker form-control" multiple
                                                                                data-live-search="true"
                                                                                onchange="updateSelectedUsers()">
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}">
                                                                                        {{ $users->first_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <input type="hidden" name="cc_user_id"
                                                                                id="cc_users">
                                                                            {{-- <select id="emailSelect" name="cc_user_id[]"
                                                                                class="form-control" multiple>
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}">
                                                                                        {{ $users->first_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select> --}}
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label" for="">Set
                                                                                Due Date</label>
                                                                            <input type="date" name="due_date"
                                                                                class="form-control form-valid-reply{{ $file->id }}"
                                                                                id="" placeholder="">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Priority</label>
                                                                            <select name="priority_type"
                                                                                class="form-select form-valid-reply{{ $file->id }}">
                                                                                <option>Select</option>
                                                                                @foreach ($priorities as $priority)
                                                                                    <option value="{{ @$priority->id }}"
                                                                                        {{ @$priority->id == @$file->officeFileFlow->officeFile->priority_type ? 'selected' : '' }}>
                                                                                        {{ @$priority->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    @if ($file->deleted_form == 'Draft')
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="">Message</label>
                                                                                <textarea name="remarks" class="form-control {{ $file->id }} save-draft"
                                                                                    value="{{ @$file->officeDraft->remarks }}" id="remarks{{ $file->file_id }}" cols="10" rows="5">{{ @$file->officeDraft->remarks }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <label class="form-label"
                                                                                    for="">Message</label>
                                                                                <textarea name="remarks" class="form-control {{ $file->id }} save-draft"
                                                                                    value="{{ @$file->officeFileFlow->remarks }}" id="remarks{{ $file->file_id }}" cols="10" rows="5">{{ @$file->officeFileFlow->remarks }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <div class="text-end mt-3">
                                                                        <input type="hidden" name="draft_id"
                                                                            value="{{ $file->draft_id }}">
                                                                        <button type="button"
                                                                            onclick="saveFormreply({{ $file->id }})"
                                                                            class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
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
@endsection
@section('script')
    <script>
        function saveForm(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    if ($(this).next('.validation-msg').length === 0) {
                        $(this).after(
                            '<span class="validation-msg" style="color:red">This field is required</span>');
                    }
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                    $(this).next('.validation-msg').remove();
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                $('#send_file' + e).submit();
            } else {
                return false;
            }
        }

        function saveFormreply(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid-reply' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    if ($(this).next('.validation-msg').length === 0) {
                        $(this).after(
                            '<span class="validation-msg" style="color:red">This field is required</span>');
                    }
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                    $(this).next('.validation-msg').remove();
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#replyfile' + e).submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }

        function updateForwardSelectedUsers() {
            var select = document.getElementById('forwardemailSelect');
            var selectedValues = Array.from(select.selectedOptions).map(option => option.value).join(',');
            document.getElementById('forward_cc_users').value = selectedValues;
        }

        function updateSelectedUsers() {
            var select = document.getElementById('replyemailSelect');
            var selectedValues = Array.from(select.selectedOptions).map(option => option.value).join(',');
            document.getElementById('cc_users').value = selectedValues;
        }
    </script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to permanently delete this!",
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
