@extends('Eoffice.admin.layouts.page-layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->

            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4 class="card-title mb-4">All Appointments</h4>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Nav tabs -->
                                <!-- Tab panes -->
                                <div class="tab-content mt-4">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>To
                                                    </th>
                                                    <th>To Organization</th>
                                                    <th>Purpose</th>
                                                    <th>Visiting Date.</th>
                                                    <th>Status
                                                    </th>
                                                    <th>Approved Date</th>
                                                    <th>From Time</th>
                                                    <th>To Time </th>

                                                    <th>MOM File </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($request_appointment as $key => $value)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>
                                                            @if (@$value->TodUser)
                                                                {{ @$value->TodUser->first_name . ' ' . @$value->TodUser->last_name }}
                                                            @else
                                                                NA
                                                            @endif
                                                        </td>
                                                        <td>{{ @$value->department }}</td>
                                                        <td>{{ @$value->purpose }}</td>
                                                        <td>{{ @$value->visiting_date }} </td>
                                                        <td>
                                                            <p>
                                                                
                                                                @if(@$value->status == 1 && (@$value->visiting_date <= \Carbon\Carbon::today()->format('Y-m-d') || @$value->visiting_date >= \Carbon\Carbon::today()->format('Y-m-d')))
                                                                    <span class="badge bg-success rounded-pill">Approved</span>
                                                                @elseif(@$value->status == 0 && @$value->visiting_date >= \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span class="badge bg-info rounded-pill">Pending</span>
                                                                @elseif (@$value->status == 2)
                                                                <span class="badge bg-danger rounded-pill">Rejected</span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-danger rounded-pill">Expired</span>
                                                                @endif
                                                            </p>
                                                        </td>

                                                        <td>{{ @$value->approved_date }} </td>

                                                        <td>{{ @$value->from_time }} </td>
                                                        <td>{{ @$value->to_time }} </td>
                                                        <td><?php
                                                        
                                                        $image_parth = 'public/upload/e_office/mom_file/' . @$value->mom_file;
                                                        
                                                        ?>
                                                            @if (@$value->mom_file != '')
                                                                <a href="{{ asset(@$image_parth) }}" target="_blank">file

                                                                </a>
                                                            @endif
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
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="send-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Take Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin.office.appointment.saveRequestAppointment') }}" method="POST"
                        id="save_appointment" enctype="multipart/form-data">

                        @csrf


                        <div class="row mb-3">


                            <div class="col-md-4">
                                <label class="form-label" for="">Visiting Office</label>
                                <select class="form-select form-valid" name="visiting_office" id="visiting_office"
                                    autofocus>
                                    <option value="">Select</option>
                                    <option value="department">Department</option>
                                    {{-- <option value="office">Office</option> --}}
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Department</label>
                                <select class="form-select form-valid" name="department" id="department" autofocus>
                                    <option value="">Select</option>
                                    <option value="Labour & Employee's State Insurance">Labour & Employee's
                                        State
                                        Insurance</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Designation</label>
                                <select class="form-select form-valid" name="designation" id="designation">

                                    <option value="">Select</option>
                                    <option value="2">Secretary</option>
                                    <option value="3">Deputy Secretary</option>
                                    <option value="4">Additional Secretary</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Officer</label>
                                <select class="form-select form-valid" name="officer" id="officer">

                                    <option value="">Select</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Purpose</label>
                                <select class="form-select form-valid" name="purpose" id="purpose">

                                    <option value="">Select</option>
                                    <option value="Grievance">Grievance</option>
                                    <option value="Official">Official</option>
                                    <option value="Other">Other</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Repair & Maintenance">Repair & Maintenance</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Visiting Date</label>
                                <input type="date" name="visiting_date" class="form-control form-valid save-draft"
                                    id="from_date" min="<?php echo date('Y-m-d'); ?>" placeholder="">
                            </div>

                            {{-- <div class="col-md-4">
                                <label class="form-label" for="">To Date</label>
                                <input type="date" name="to_date" class="form-control form-valid save-draft"
                                    id="to_date" min="<?php echo date('Y-m-d'); ?>" placeholder="">
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label" for="">Causes Appointment</label>
                                <input type="" class="form-control form-valid save-draft" id="causes"
                                    name="causes" placeholder="">

                            </div>


                            <div class="col-md-4">
                                <label class="form-label" for="">Identity Type</label>
                                <select class="form-select form-valid" name="identity_type" id="identity_type" autofocus>
                                    <option value="">Select</option>
                                    <option value="aadhaar" selected>Aadhaar Card No.</option>
                                    {{-- <option value="Week">Week</option> --}}
                                    {{-- <option value="Month">Month</option> --}}
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Identity Number</label>
                                <input type="number" autocomplete="off" autofocus class="form-control form-valid"
                                    name="identity_number" id="identity_number" placeholder="">
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button type="button" onclick="saveForm()"
                                class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        function block_issue(e, id) {
            var element = document.getElementById("issue_date_div" + id);

            var reject_form_element = document.getElementById("reject_form" + id);
            var issue_form_element = document.getElementById("issue_form" + id);
            // var book_reg_div_element = document.getElementById("book_reg_div"+id);

            var reject_remark_div = document.getElementById("reject_remark_div" + id);



            if (e == 0) {
                reject_remark_div.style.display = "block";

                reject_form_element.style.display = "block";

                issue_form_element.style.display = "none";
            } else {

                reject_form_element.style.display = "none";

                reject_remark_div.style.display = "none";

                issue_form_element.style.display = "block";
            }

        }

        function saveForm() {
            var errcount = 0;
            $(".error-span").remove();

            $("span").remove();



            $('.form-valid').each(function() {
                if ($(this).val() == '') {

                    errcount++;
                    $(this).addClass('error-text');
                    $(this).removeClass('success-text');
                    $(this).after('<span style="color:red">This field is required</span>');


                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#save_appointment').submit();

                // $.unblockUI();        
            } else {
                return false;
            }
        }

        function saveIssue(e) {

            var userConfirmed = confirm("You sure want to approve this Request!");

            if (userConfirmed) {

                var errcount = 0;
                $(".error-span" + e).remove();

                $("span" + e).remove();
                $('.form-valid-approve' + e).each(function() {
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

                    // $('#book_edit' + e).submit();

                    $.ajax({
                        type: 'post',
                        url: "{{ route('admin.office.appointment.saveapproveAppointment') }}",
                        data: {

                            approved_date: $('#approved_date' + e).val(),
                            from_time: $('#from_time' + e).val(),
                            to_time: $('#to_time' + e).val(),
                            id: e,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            location.reload();

                        }
                    });
                    // $.unblockUI();        
                } else {
                    return false;
                }
            }
        }

        function saveReject(e) {

            var userConfirmed = confirm("You sure want to Reject this Request!");

            if (userConfirmed) {

                var errcount = 0;
                $(".error-span" + e).remove();

                $("span" + e).remove();
                $('.form-valid-reject' + e).each(function() {
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

                    // $('#book_edit' + e).submit();

                    $.ajax({
                        type: 'post',
                        url: "{{ route('admin.office.appointment.rejectAppoitment') }}",
                        data: {

                            reject_remark: $('#reject_remark' + e).val(),

                            id: e,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            location.reload();

                        }
                    });
                    // $.unblockUI();        
                } else {
                    // return false;
                }
            }
        }

        function saveSubmit(e) {
            var errcount = 0;
            $(".error-span" + e).remove();

            $("span" + e).remove();
            $('.form-valid-mom' + e).each(function() {
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
    </script>
@endsection

@section('script')
    <script>
        $('#designation').on('change', function() {

            var role_id = this.value;

            $.ajax({
                url: "{{ route('admin.office.getauthority') }}",
                type: "get",
                data: {
                    role_id: role_id,
                },
                dataType: 'json',
                success: function(result) {
                    $('#officer').empty();
                    $("#officer").append('<option>' + 'Select' + '</option>');
                    $.each(result.users, function(key, value) {
                        $("#officer").append('<option value="' + value.id +
                            '">' + value.first_name + value.last_name + '</option>');
                    });
                }
            });
        })
    </script>
@endsection
