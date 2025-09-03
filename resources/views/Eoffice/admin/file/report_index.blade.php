@extends('Eoffice.admin.layouts.page-layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Load Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active text-custom-primary">Inbox</li>
                            </ol>
                        </div>
                        {{-- <div class="page-title-right">
                            <button type="button" class="btn custom-btn waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#send-modal">Send</button>
                            <button type="button" class="btn custom-btn waves-effect waves-light ms-2"
                                data-bs-toggle="modal" data-bs-target="#reply-modal">Reply</button>
                        </div> --}}
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
                                            <th>Sent Form
                                            </th>
                                            <th>Sent To
                                            </th>
                                            <th>Sent On</th>
                                            <th>Pending At</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($office_files as $i => $file)
                                            <tr>
                                                <td>{{ ++$i }}
                                                </td>
                                                <td>
                                                    <p>{{ @$file->officeFile->file_no }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ @$file->subject }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ @$file->officeUser->first_name }}
                                                    </p>
                                                </td>
                                                <td>
                                                    

                                                    <p>{{ @$file->toUser->first_name }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>{{ @$file->created_at }}</p>
                                                </td>
                                                <td>
                                                    <p> 
                                                        <span class="badge bg-danger rounded-pill">{{ @$file->toUser->first_name." ".@$file->toUser->last_name }}</span>
                                                    </p>
                                                </td>
                                                <td>

                                                    <div style="display: flex">
                                                            {{-- <button type="button"
                                                                class="btn custom-btn waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#send-modal{{ @$file->id }}">Forward</button>
    
                                                            <button type="button"
                                                                class="btn custom-btn waves-effect waves-light ms-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#reply-modal{{ @$file->id }}">Reply</button> --}}
    
    
                                                            {{-- <form action="{{ route('admin.office.delete-file-flow', ['id' => @$file->file_id]) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="delete_form" value="Sent">
                                                                <button class="btn btn-danger btn-sm edit waves-effect waves-light" type="submit"><i class="fa fa-trash"></i></button>
                                                            </form> --}}
                                                            {{-- <a href="{{ route('admin.office.delete-file-flow', ['id' => @$file->file_id]) }}"
                                                                class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                                title="Delete Record">
                                                                <i class="fa fa-trash"></i>
                                                            </a> --}}
    
                                                            <a href="{{ route('admin.office.repot-view-file', ['id' => @$file->file_id]) }} "
                                                                type="button"
                                                                class="btn custom-btn waves-effect btn-sm waves-light ms-2">View</a>
                                                    </div>

                                                </td>
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
                                                                                id="to_user_id{{ $file->id }}"
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
                                                                            <input type="" readonly
                                                                                class="form-control form-valid{{ $file->id }} save-draft"
                                                                                name="subject"
                                                                                value="{{ $file->officeFile->letter_subject }}"
                                                                                id="subject{{ $file->id }}"
                                                                                placeholder="">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label" for="">Receipt
                                                                                No.</label>
                                                                            <input type="" readonly
                                                                                class="form-control form-valid{{ $file->id }} save-draft"
                                                                                id="receipt_no{{ $file->id }}" 
                                                                                name="receipt_no" value="{{ $file->officeFile->file_no }}" placeholder="">
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
                                                                            <select id="emailSelect{{ $file->id }}"
                                                                                name="cc_user_id[]" class="form-control"
                                                                                multiple>
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}">
                                                                                        {{ $users->first_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                                <!-- Options will be dynamically populated using JavaScript -->
                                                                            </select>
                                                                        </div>

                                                                        <input type="hidden" id="selectedEmails"
                                                                            name="selectedEmails">

                                                                        <div class="col-md-4">
                                                                            <label class="form-label" for="">Set
                                                                                Due Date</label>
                                                                            <input type="date" name="due_date"
                                                                                class="form-control form-valid{{ $file->id }} save-draft"
                                                                                id="due_date{{ $file->id }}"
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
                                                                            <label class="form-label"
                                                                                for="">Priority</label>
                                                                            <select name="priority_type"
                                                                                class="form-select form-valid{{ $file->id }} save-draft"
                                                                                id="priority_type{{ $file->id }}">
                                                                                <option value="">Select</option>
                                                                                @foreach ($priorities as $priority)
                                                                                    <option value="{{ @$priority->id }}"
                                                                                        {{ @$priority->id == @$file->officeFile->priority_type ? 'selected' : '' }}>
                                                                                        {{ @$priority->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label"
                                                                                for="">Message</label>
                                                                            
                                                                            <textarea name="remarks" class="form-control form-valid{{ $file->id }} save-draft" id="remarks{{ $file->id }}" cols="10"
                                                                                    rows="5"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-end mt-3">
                                                                        <button type="button"
                                                                            onclick="saveForm({{ $file->id }})"
                                                                            class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                                {{-- Reply --}}

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
                                                                            <input type="" class="form-control"
                                                                                readonly name=""
                                                                                value="{{ $file->officeUser->first_name }}"
                                                                                id="" placeholder="">
                                                                            <input type="hidden" name="to_user_id"
                                                                                value="{{ $file->officeUser->id }}">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Subject</label>
                                                                            <input type=""
                                                                                class="form-control form-valid-reply{{ $file->id }}"
                                                                                readonly name="subject"
                                                                                value="{{ $file->officeFile->letter_subject }}"
                                                                                id="" placeholder="">
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label"
                                                                                for="">Receipt
                                                                                No.</label>
                                                                            <input type=""
                                                                                class="form-control form-valid-reply{{ $file->id }}"
                                                                                id="" name="receipt_no" readonly
                                                                                placeholder=""
                                                                                value="{{ $file->officeFile->file_no }}">
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
                                                                            <select id="emailSelect" name="cc_user_id[]"
                                                                                class="form-control" multiple>
                                                                                @foreach ($user_data as $users)
                                                                                    <option value="{{ $users->id }}">
                                                                                        {{ $users->first_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                                <!-- Options will be dynamically populated using JavaScript -->
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label" for="">Set
                                                                                Due Date</label>
                                                                            <input type="date" name="due_date"
                                                                                class="form-control form-valid-reply{{ $file->id }}"
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
                                                                            <label class="form-label"
                                                                                for="">Priority</label>
                                                                            <select name="priority_type"
                                                                                class="form-select form-valid-reply{{ $file->id }}">
                                                                                <option>Select</option>
                                                                                @foreach ($priorities as $priority)
                                                                                    <option value="{{ @$priority->id }}"
                                                                                        {{ @$priority->id == @$file->officeFile->priority_type ? 'selected' : '' }}>
                                                                                        {{ @$priority->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label"
                                                                                for="">Message</label>
                                                                            <textarea name="remarks" class="form-control form-valid-reply{{ $file->id }}" id="remarks" cols="10"
                                                                                rows="5"></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-end mt-3">
                                                                        <button type="button"
                                                                            onclick="saveFormreply({{ $file->id }})"
                                                                            class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->

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
    {{--     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
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



        $('.save-draft').on('change',function(event) {
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
