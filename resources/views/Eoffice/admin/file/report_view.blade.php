@extends('Eoffice.admin.layouts.page-layouts.main')
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
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-6">
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#mail-data" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">View Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#file-data" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">File details</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6">

                    <div class="page-title-right text-end">
                        {{-- <button type="button" class="btn custom-btn waves-effect waves-light ms-2" data-bs-toggle="modal"
                            data-bs-target="#reply-modal{{ @$replyDetail->id }}">Reply</button> --}}

                        <a href="{{ route('admin.office.inboxFile') }}" class="btn btn-dark">
                            Back </a>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="mail-data" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="addproduct-accordion" class="custom-accordion">

                                @foreach ($file_flow_datas as $key => $file_flow_data)
                                    <div class="card">
                                        <a href="#addproduct-billinginfo-collapse{{ @$file_flow_data->id }}"
                                            class="text-dark " data-bs-toggle="collapse" aria-expanded="true"
                                            aria-controls="addproduct-billinginfo-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                                @if ($file_flow_data->from_user_id == Auth::guard('officer')->user()->id)
                                                                    <i class="fas fa-arrow-up"></i>
                                                                @else
                                                                    <i class="fas fa-arrow-down"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">

                                                            {{ @$office_files->file_no }}
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">
                                                            {{ @$office_files->letter_subject }}
                                                        </p>
                                                    </div>
                                                    {{-- <div class="flex-shrink-0">
                                                        <button id="forwardButton" type="button"
                                                            class="btn custom-btn btn-sm waves-effect waves-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#send-modal{{ @$file_flow_data->id }}">Forward</button>
                                                        <i class="uil-arrow-down font-size-24"></i>
                                                    </div> --}}

                                                </div>

                                            </div>
                                        </a>

                                        <div id="addproduct-billinginfo-collapse{{ @$file_flow_data->id }}"
                                            class="collapse show" data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="d-flex">
                                                            <h5 class="font-size-16 text-custom-primary">Receipt No :
                                                                {{ $file_flow_data->officeFile->file_no }}</h5>
                                                            @if (@$file_flow_data->due_date != null)
                                                                <span class="ms-5"><span
                                                                        class="badge bg-danger rounded-pill">Due
                                                                        Date :

                                                                        {{ date('d-m-Y', strtotime(@$file_flow_data->due_date)) }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="mt-2">
                                                            <span class="font-size-14 font-weight-bold"><strong>From :
                                                                </strong></span><span
                                                                class="font-size-14 ms-4">{{ @$file_flow_data->officeUser->email }}</span>
                                                        </div>
                                                        <div class="mt-2">
                                                            <span class="font-size-14 font-weight-bold"><strong>To :
                                                                </strong></span><span
                                                                class="font-size-14 ms-4">{{ @$file_flow_data->toUser->email }}</span>
                                                        </div>
                                                        <div class="mt-2">
                                                            <span class="font-size-14 font-weight-bold"><strong>cc :
                                                                </strong></span><span class="font-size-14 ms-4">
                                                                @foreach ($file_flow_data->ccUsers() as $ccUser)
                                                                    {{ $ccUser->email }},
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                        <div class="table-responsive mt-3">



                                                            <div>
                                                                <span class="font-size-14 font-weight-bold"><strong>Priority
                                                                        :
                                                                    </strong></span><span
                                                                    class="font-size-14 ms-4">{{ @$file_flow_data->priority->name }}</span>

                                                            </div>

                                                            <div>
                                                                <span class="font-size-14 font-weight-bold"><strong>Message
                                                                        :
                                                                    </strong></span><span
                                                                    class="font-size-14 ms-4">{{ @$file_flow_data->remarks ? @$file_flow_data->remarks : @$file_flow_data->officeFile->message }}</span>

                                                            </div>

                                                            @if (@$file_flow_data->forward_message)
                                                                <div>
                                                                    <span class="font-size-14 font-weight-bold"><strong>Forward
                                                                            Message
                                                                            :
                                                                        </strong></span><span
                                                                        class="font-size-14 ms-4">{{ @$file_flow_data->forward_message }}</span>

                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        &nbsp;
                                                        {{-- <div class="table-responsive">

                                                            <button type="button"
                                                                class="btn custom-btn btn-sm waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#send-modal{{ @$file_flow_data->id }}">Forward</button>



                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="send-modal{{ $file_flow_data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Forward Form</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="{{ route('admin.office.sentFile') }}" method="POST"
                                                        id="send_file{{ $file_flow_data->id }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="">To</label>
                                                                <select
                                                                    class="form-select form-valid{{ $file_flow_data->id }}"
                                                                    id="to_user_id{{ $file_flow_data->id }}"
                                                                    name="to_user_id">

                                                                    <option value="">Select</option>
                                                                    @foreach ($user_data as $users)
                                                                        <option value="{{ $users->id }}">
                                                                            {{ $users->first_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label class="form-label" for="">Subject</label>
                                                                <input type="" readonly
                                                                    class="form-control form-valid{{ $file_flow_data->id }} save-draft"
                                                                    name="subject"
                                                                    value="{{ $office_files->letter_subject }}"
                                                                    id="subject{{ $file_flow_data->id }}" placeholder="">
                                                            </div>

                                                            <div class="col-md-4">
                                                                <label class="form-label" for="">Receipt
                                                                    No.</label>
                                                                <input type="" readonly
                                                                    class="form-control form-valid{{ $file_flow_data->id }} save-draft"
                                                                    id="receipt_no{{ $file_flow_data->id }}"
                                                                    name="receipt_no"
                                                                    value="{{ $office_files->file_no }}" placeholder="">
                                                                <input type="hidden"
                                                                    class="form-control form-valid{{ $file_flow_data->id }}"
                                                                    id="file_id{{ $file_flow_data->id }}" name="file_id"
                                                                    value="{{ $file_flow_data->file_id }}"
                                                                    placeholder="">
                                                            </div>


                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="emailSelect">CC</label>
                                                                {{-- <select id="emailSelect" name="cc_user_id[]"
                                                                    class="form-control" multiple>
                                                                    @foreach ($user_data as $users)
                                                                        <option value="{{ $users->id }}">
                                                                            {{ $users->first_name }}
                                                                        </option>
                                                                    @endforeach
                                                                    <!-- Options will be dynamically populated using JavaScript -->
                                                                </select> --}}
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
                                                                <input type="hidden" name="cc_user_id" id="forward_cc_users">
                                                            </div>

                                                            <input type="hidden" id="selectedEmails"
                                                                name="selectedEmails">

                                                            <div class="col-md-4">
                                                                <label class="form-label" for="">Set
                                                                    Due Date</label>
                                                                <input type="date" name="due_date"
                                                                    class="form-control form-valid{{ $file_flow_data->id }} save-draft"
                                                                    id="due_date{{ $file_flow_data->id }}"
                                                                    placeholder="">
                                                            </div>
                                                            {{-- <div class="col-md-4">
                                                                <label class="form-label"
                                                                    for="">Action</label>
                                                                <select name="action_type"
                                                                    id="action_type{{ $file->id }}"
                                                                    class="form-select form-valid{{ $file->id }}">
                                                                    <option value="">Select</option>
                                                                    <option value="Forward">Forward</option>
                                                                    <option value="Approve">Approve</option>
                                                                    <option value="Fix A Meeting">Fix A Meeting
                                                                    </option>
                                                                    <option value="Please Call">Please Call
                                                                    </option>
                                                                    <option value="Give Time">Give Time
                                                                    </option>
                                                                    <option value="Approved">Approved</option>
                                                                </select>
                                                            </div> --}}
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="">Priority</label>
                                                                <select name="priority_type"
                                                                    class="form-select form-valid{{ $file_flow_data->id }} save-draft"
                                                                    id="priority_type{{ $file_flow_data->id }}">
                                                                    <option value="">Select</option>
                                                                    @foreach ($priorities as $priority)
                                                                        <option value="{{ @$priority->id }}"
                                                                            {{ @$priority->id == @$file_flow_data->officeFile->priority_type ? 'selected' : '' }}>
                                                                            {{ @$priority->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="">Message</label>

                                                                <textarea name="remarks" value="{{ @$file_flow_data->remarks }}"
                                                                    class="form-control form-valid{{ $file_flow_data->id }} save-draft" id="remarks{{ $file_flow_data->id }}"
                                                                    cols="10" rows="3" readonly>{{ @$file_flow_data->remarks }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="">Forward
                                                                    Message</label>
                                                                <textarea name="forward_message"
                                                                    value="{{ @$file_flow_data->forward_message ? @$file_flow_data->forward_message : '' }}"
                                                                    class="form-control form-valid{{ $file_flow_data->id }} save-draft"
                                                                    id="forward_message{{ $file_flow_data->id }}" cols="10" rows="5">{{ @$file_flow_data->forward_message ? @$file_flow_data->forward_message : '' }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="text-end mt-3">
                                                            <button type="button"
                                                                onclick="saveForm({{ $file_flow_data->id }})"
                                                                class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                    <div class="modal fade" id="reply-modal{{ $replyDetail->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reply Form</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('admin.office.replyFile') }}" method="POST"
                                        id="replyfile{{ $replyDetail->id }}" enctype="multipart/form-data"
                                        onsubmit="updateSelectedUsers()">

                                        @csrf


                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="">To</label>

                                                <select class="form-control form-valid-reply{{ $replyDetail->id }}"
                                                    name="to_user_id" id="" required>
                                                    <option value="">Select</option>
                                                    @foreach ($replyUsers as $user)
                                                        @if ($user->id != Auth::guard('officer')->user()->id)
                                                            <option value="{{ @$user->id }}" selected>
                                                                {{ @$user->first_name . ' ' . @$user->last_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                {{-- <input type="" class="form-control" readonly name=""
                                                    value="{{ @$replyDetail->toUser->id == Auth::guard('officer')->user()->id ? @$replyDetail->officeUser->first_name : @$replyDetail->toUser->first_name }}"
                                                    id="" placeholder="">
                                                <input type="hidden" name="to_user_id"
                                                    value="{{ @$replyDetail->toUser->id == Auth::guard('officer')->user()->id ? @$replyDetail->officeUser->id : @$replyDetail->toUser->id }}"> --}}
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label" for="">Subject</label>
                                                <input type=""
                                                    class="form-control form-valid-reply{{ $replyDetail->id }}" readonly
                                                    name="subject" value="{{ $replyDetail->officeFile->letter_subject }}"
                                                    id="" placeholder="">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label" for="">Receipt
                                                    No.</label>
                                                <input type=""
                                                    class="form-control form-valid-reply{{ $replyDetail->id }}"
                                                    id="" name="receipt_no" readonly placeholder=""
                                                    value="{{ $replyDetail->officeFile->file_no }}">
                                                <input type="hidden"
                                                    class="form-control form-valid-reply{{ $replyDetail->id }}"
                                                    id="" name="file_id" value="{{ $replyDetail->file_id }}"
                                                    placeholder="">
                                            </div>


                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="emailSelect">CC</label><br>
                                                {{-- <select class="selectpicker form control" multiple data-live-search="true" name="cc_user_id[]">
                                                
                                                    @foreach ($user_data as $users)
                                                        <option value="{{ $users->id }}">
                                                            {{ $users->first_name }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                                <select id="replyemailSelect" class="selectpicker form-control" multiple
                                                    data-live-search="true" onchange="updateSelectedUsers()">
                                                    @foreach ($user_data as $users)
                                                        <option value="{{ $users->id }}">
                                                            {{ $users->first_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="cc_user_id" id="cc_users">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label" for="">Set
                                                    Due Date</label>
                                                <input type="date" name="due_date"
                                                    class="form-control form-valid-reply{{ $replyDetail->id }}"
                                                    id="" placeholder="">
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <label class="form-label"
                                                    for="">Action</label>
                                                <select name="action_type"
                                                    class="form-select form-valid-reply{{ $file->id }}">
                                                    <option value="">Select</option>
                                                    <option value="Forward">Forward</option>
                                                    <option value="Fix A Meeting">Fix A Meeting
                                                    </option>
                                                    <option value="Please Call">Please Call
                                                    </option>
                                                    <option value="Give Time">Give Time
                                                    </option>
                                                    <option value="Approved">Approved</option>
                                                </select>
                                            </div> --}}
                                            <div class="col-md-4">
                                                <label class="form-label" for="">Priority</label>
                                                <select name="priority_type"
                                                    class="form-select form-valid-reply{{ $replyDetail->id }}">
                                                    <option>Select</option>
                                                    @foreach ($priorities as $priority)
                                                        <option value="{{ @$priority->id }}"
                                                            {{ @$priority->id == @$replyDetail->officeFile->priority_type ? 'selected' : '' }}>
                                                            {{ @$priority->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="">Message</label>
                                                <textarea name="remarks" class="form-control form-valid-reply{{ $replyDetail->id }}" id="remarks" cols="10"
                                                    rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="text-end mt-3">
                                            <button type="button" onclick="saveFormreply({{ $replyDetail->id }})"
                                                class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                </div>

                <div class="tab-pane" id="file-data" role="tabpanel">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="table-responsive mt-3">
                                            <div>
                                                <p class="mb-1">Date :</p>
                                                <h5 class="font-size-16">
                                                    {{ date('d-m-Y', strtotime(@$office_files->file_date)) }}
                                                </h5>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-1">Delivery Mode :</p>
                                                <h5 class="font-size-16">{{ @$office_files->deliveryMode->name }}</h5>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-1">Letter Type :</p>
                                                <h5 class="font-size-16">{{ @$office_files->letterType->name }}</h5>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-1">File Number :</p>
                                                <h5 class="font-size-16">{{ @$office_files->file_no }}</h5>
                                            </div>

                                            <div class="mt-3">
                                                <p class="mb-1">Department :</p>
                                                <h5 class="font-size-16">{{ @$office_files->department->name }}</h5>
                                            </div>

                                            <div class="mt-3">
                                                <p class="mb-1">Sub Category :</p>
                                                <h5 class="font-size-16">{{ @$office_files->subCategory->name }}</h5>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive mt-3">
                                            <div>
                                                <p class="mb-1">Section :</p>
                                                <h5 class="font-size-16">{{ @$office_files->section->name }}</h5>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-1">No. of Memo :</p>
                                                <h5 class="font-size-16">{{ @$office_files->memo_no }}</h5>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-1">Sent From :</p>
                                                <h5 class="font-size-16">{{ @$office_files->createdUser->first_name }}
                                                </h5>
                                            </div>
                                            <div>
                                                <p class="mb-1">Enclouser :</p>
                                                <h5 class="font-size-16">{{ @$office_files->deliveryMode->name }}</h5>
                                            </div>
                                            <div>
                                                <p class="mb-1">received User Name :</p>
                                                <h5 class="font-size-16">{{ @$office_files->toUser->first_name }}</h5>
                                            </div>


                                            <div>
                                                <p class="mb-1">Main Category:</p>
                                                <h5 class="font-size-16">{{ @$office_files->mainCategory->name }}</h5>
                                            </div>


                                            <div>
                                                <p class="mb-1">Letter Subject:</p>
                                                <h5 class="font-size-16">{{ @$office_files->letter_subject }}</h5>
                                            </div>


                                            <div class="view-file-doc">
                                                <p class="mb-1">View Document:</p>

                                                @if (@$office_files->upload_file)
                                                    <?php
                                                    
                                                    $image_parth = 'public/upload/office/upload_file/' . @$office_files->upload_file;
                                                    
                                                    ?>
                                                    <a download href="{{ asset(@$image_parth) }}" target="_blank">
                                                        <i class="uil-download-alt ms-4"></i>
                                                    </a>
                                                @else
                                                    NA
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div> <!-- container-fluid -->
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('select[multiple]').multiselect();
        });
    </script>
    <script>
        function updateSelectedUsers() {
            var select = document.getElementById('replyemailSelect');
            var selectedValues = Array.from(select.selectedOptions).map(option => option.value).join(',');
            document.getElementById('cc_users').value = selectedValues;
        }
        function updateForwardSelectedUsers() {
            var select = document.getElementById('forwardemailSelect');
            var selectedValues = Array.from(select.selectedOptions).map(option => option.value).join(',');
            document.getElementById('forward_cc_users').value = selectedValues;
        }
    </script>
    <script>
        document.getElementById('forwardButton').addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

        });

        function saveForm(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid' + e).each(function() {
                if ($(this).val() == '') {
                    errcount++;
                    $(this).addClass('error-text' + e);
                    $(this).removeClass('success-text' + e);
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#send_file' + e).submit();
                // $.unblockUI();         
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
                    $(this).after('<span style="color:red">This field is required</span>');
                } else {
                    $(this).removeClass('error-text' + e);
                    $(this).addClass('success-text' + e);
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
        // function saveForm() {
        //     var errcount = 0;
        //     $(".error-span").remove();

        //     $("span").remove();



        //     $('.form-valid').each(function() {
        //         if ($(this).val() == '') {

        //             errcount++;
        //             $(this).addClass('error-text');
        //             $(this).removeClass('success-text');
        //             $(this).after('<span style="color:red">This field is required</span>');

        //             if ($('#payment_type').val() == '0') {
        //                 errcount--;
        //             }
        //         } else {
        //             $(this).removeClass('error-text');
        //             $(this).addClass('success-text');
        //         }
        //     });
        //     // alert(errcount);
        //     if (errcount == 0) {
        //         // $.blockUI({ message: '<h1> Loading...</h1>' });

        //         $('#book_save').submit();
        //         // $.unblockUI();         
        //     } else {
        //         return false;
        //     }
        // }
        // document.addEventListener("DOMContentLoaded", function() {
        //     const emailList = ['officeadmin@gmail.com', 'teamhead@gmail.com', 'hrteamhead@gmail.com',
        //         'financeofficeadmin@gmail.com', 'priyanka officeadmin@gmail.com'
        //     ];

        //     const emailInput = document.getElementById('emailInput');
        //     const emailListContainer = document.getElementById('emailList');
        //     const selectedEmailsInput = document.getElementById('selectedEmails');
        //     let selectedEmails = [];

        //     function updateSelectedEmails() {
        //         selectedEmailsInput.value = selectedEmails.join(',');
        //     }

        //     function showEmailList() {
        //         emailListContainer.innerHTML = '';
        //         const inputValue = emailInput.value.trim().toLowerCase();
        //         const filteredEmails = emailList.filter(email => email.includes(inputValue));
        //         filteredEmails.forEach(email => {
        //             const emailDiv = document.createElement('div');
        //             emailDiv.textContent = email;
        //             emailDiv.addEventListener('click', () => {
        //                 if (!selectedEmails.includes(email)) {
        //                     selectedEmails.push(email);
        //                     updateSelectedEmails();
        //                     displaySelectedEmails();
        //                 }
        //             });
        //             emailListContainer.appendChild(emailDiv);
        //         });
        //         emailListContainer.style.display = filteredEmails.length ? 'block' : 'none';
        //     }

        //     function displaySelectedEmails() {
        //         emailInput.value = '';
        //         emailListContainer.innerHTML = '';
        //         selectedEmails.forEach(email => {
        //             const selectedEmailDiv = document.createElement('div');
        //             selectedEmailDiv.textContent = email;
        //             selectedEmailDiv.classList.add('selected-email');
        //             selectedEmailDiv.addEventListener('click', () => {
        //                 selectedEmails = selectedEmails.filter(selectedEmail => selectedEmail !==
        //                     email);
        //                 updateSelectedEmails();
        //                 displaySelectedEmails();
        //             });
        //             emailListContainer.appendChild(selectedEmailDiv);
        //         });
        //     }

        //     emailInput.addEventListener('keyup', showEmailList);
        // });

        //  $(document).ready(function() {
        //     // Sample data for demonstration
        //     var emails = ["email1@example.com", "email2@example.com", "email3@example.com", "email4@example.com"];

        //     // Populate select options
        //     $.each(emails, function(index, value) {
        //         $('#emailSelect').append('<option value="' + value + '">' + value + '</option>');
        //     });

        //     // Enable Select2
        //     $('#emailSelect').select2();
        // }); 

        $('.save-draft').keyup(function(event) {
            var id = $(this).attr('id'); // Get the ID of the element where the event happened
            let num = parseInt(id.match(/\d+/)[0]);
            console.log(num); // Output: 123
            var receipt_no = $('#receipt_no' + num).val();
            // alert(emailSelect)
            var emailSelect = $('#emailSelect' + num).val();
            var subject = $('#subject' + num).val();
            var to_user_id = $('#to_user_id' + num).val();
            // alert(emailSelect)
            var due_date = $('#due_date' + num).val();
            var file_id = $('#file_id' + num).val();
            // alert(file_id);
            var action_type = $('#action_type' + num).val();
            var priority_type = $('#priority_type' + num).val();
            var remarks = $('#remarks' + num).val();
            var forward_message = $('#forward_message' + num).val();

            $.ajax({
                type: 'post',
                url: "{{ route('admin.office.saveDraft') }}",
                data: {
                    receipt_no: receipt_no,
                    emailSelect: emailSelect,
                    subject: subject,
                    to_user_id: to_user_id,
                    action_type: action_type,
                    due_date: due_date,
                    priority_type: priority_type,
                    remarks: remarks,
                    forward_message: forward_message,
                    file_id: file_id,
                    flow_id: num, // Pass the ID to the server
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                }
            });
        });



        $('.save-draft').on('change', function(event) {
            var id = $(this).attr('id'); // Get the ID of the element where the event happened
            // alert(id);
            let num = parseInt(id.match(/\d+/)[0]);
            console.log(num); // Output: 123
            var receipt_no = $('#receipt_no' + num).val();
            // alert(emailSelect)
            var emailSelect = $('#emailSelect' + num).val();
            var subject = $('#subject' + num).val();
            var to_user_id = $('#to_user_id' + num).val();
            // alert(emailSelect)
            var due_date = $('#due_date' + num).val();
            var file_id = $('#file_id' + num).val();
            // alert(file_id);
            var action_type = $('#action_type' + num).val();
            var priority_type = $('#priority_type' + num).val();
            var remarks = $('#remarks' + num).val();
            var forward_message = $('#forward_message' + num).val();
            $.ajax({
                type: 'post',
                url: "{{ route('admin.office.saveDraft') }}",
                data: {
                    receipt_no: receipt_no,
                    emailSelect: emailSelect,
                    subject: subject,
                    to_user_id: to_user_id,
                    action_type: action_type,
                    due_date: due_date,
                    priority_type: priority_type,
                    remarks: remarks,
                    forward_message: forward_message,
                    file_id: file_id,
                    flow_id: num, // Pass the ID to the server
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                }
            });
        });
    </script>
@endsection
