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
                                    <h4 class="card-title mb-4">Appointment</h4>
                                </div>
                                <div class="col-md-2">

                                    <button type="button" class="btn custom-btn waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#send-modal">Take Appointment</button>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#pen-tab" role="tab">
                                            <span class="d-none d-sm-block">Received</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#app-tab" role="tab">
                                            <span class="d-none d-sm-block">Sent </span>
                                        </a>
                                    </li>


                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content mt-4">
                                    <div class="tab-pane" id="app-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Sl. No</th>
                                                        <th>To</th>
                                                        <th>To Organization</th>
                                                        {{-- <th>Purpose</th> --}}
                                                        <th>Visiting Date.</th>
                                                        <th>Status</th>
                                                        {{-- <th>Approved Date</th>
                                                        <th>From Time</th>
                                                        <th>To Time </th> --}}
                                                        <th>MOM File </th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($request_appointment as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->TodUser->first_name }} </td>
                                                            <td>{{ @$value->department }}</td>
                                                            {{-- <td>{{ @$value->purpose }}</td>         --}}

                                                            <td>{{ $value->visiting_date }} </td>
                                                            <td>
                                                                @if ($value->status == 0 && @$value->visiting_date == \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span
                                                                        class="badge bg-warning rounded-pill">Requested</span>
                                                                @elseif($value->status == 1 && @$value->visiting_date <= \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span
                                                                        class="badge bg-success rounded-pill">Approved</span>
                                                                @elseif($value->status == 0 && @$value->visiting_date > \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span class="badge bg-info rounded-pill">Pending</span>
                                                                @elseif($value->status == 2)
                                                                    <span
                                                                        class="badge bg-danger rounded-pill">Rejected</span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-danger rounded-pill">Expired</span>
                                                                @endif
                                                            </td>

                                                            {{-- <td>{{ $value->approved_date }} </td>

                                                            <td>{{ $value->from_time }} </td>
                                                            <td>{{ $value->to_time }} </td> --}}
                                                            <td><?php
                                                            
                                                            $image_parth = 'public/upload/e_office/mom_file/' . @$value->mom_file;
                                                            
                                                            ?>
                                                                @if ($value->mom_file != '')
                                                                    <a href="{{ asset(@$image_parth) }}"
                                                                        target="_blank">file

                                                                    </a>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($value->status == 1 && $value->mom_file == '')
                                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                        title="Edit" data-bs-toggle="modal"
                                                                        data-bs-target="#submitMom{{ $value->id }}">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                @endif
                                                                <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                    title="View" data-bs-toggle="modal"
                                                                    data-bs-target="#viewAppointment{{ $value->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <!-- start appointment view modal -->
                                                            <div class="modal fade" id="viewAppointment{{ $value->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-l modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="staticBackdropLabel">Appointment Details
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-3 padding">From User
                                                                                </div>
                                                                                <div class="col-md-9 padding">: <span
                                                                                        class="text-capitalize">{{ $value->FromUser->first_name ?? '-' }}
                                                                                        {{ $value->FromUser->last_name ?? '-' }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Visiting
                                                                                    Officer</div>
                                                                                <div class="col-md-9 padding">: <span
                                                                                        class="text-capitalize">{{ $value->visiting_office ?? '-' }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Department
                                                                                </div>
                                                                                <div class="col-md-9 padding">: <span
                                                                                        class="text-capitalize">{{ $value->department ?? '-' }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Designation
                                                                                </div>
                                                                                <div class="col-md-9 padding">: <span
                                                                                        class="text-capitalize">{{ $value->officer }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Officer</div>
                                                                                <div class="col-md-9 padding">: <span
                                                                                        class="text-capitalize">{{ $value->TodUser->first_name ?? '-' }}
                                                                                        {{ $value->TodUser->last_name ?? '-' }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Purpose</div>
                                                                                <div class="col-md-9 padding">: <span
                                                                                        class="text-capitalize">{{ $value->purpose }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Visiting Date
                                                                                </div>
                                                                                <div class="col-md-9 padding">:
                                                                                    <span>{{ $value->visiting_date }}</span>
                                                                                </div>
                                                                                <div class="col-md-3 padding">Reason</div>
                                                                                <div class="col-md-9 padding">:
                                                                                    {{ $value->causes ?? '-' }}</div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- end appointment view modal -->
                                                            <div class="modal fade" id="submitMom{{ $value->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="staticBackdropLabel">MOM file</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <div class="mb-3 row">


                                                                                <form
                                                                                    action="{{ route('admin.office.momSubmit') }}"
                                                                                    method="POST"
                                                                                    id="send_file{{ $value->id }}"
                                                                                    enctype="multipart/form-data">

                                                                                    @csrf
                                                                                    <input type="hidden"
                                                                                        class="form-control form-valid-mom{{ $value->id }}"
                                                                                        id="appoitment_id{{ $value->id }}"
                                                                                        name="appoitment_id"
                                                                                        value="{{ $value->id }}"
                                                                                        placeholder="">
                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">MOM
                                                                                            file</label>
                                                                                        <input type="file"
                                                                                            class="form-control form-valid-mom{{ $value->id }}"
                                                                                            type="text" value=""
                                                                                            name="mom_file[]"
                                                                                            id="mom_file{{ $value->id }}">
                                                                                    </div>

                                                                                    <div class="col-sm-12 col-lg-4">
                                                                                        <label for=""
                                                                                            class="col-form-label">MOM
                                                                                            Description
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            class="form-control form-valid-mom{{ $value->id }}"
                                                                                            type="text" value=""
                                                                                            name="mom_description"
                                                                                            id="mom_description{{ $value->id }}">
                                                                                    </div>


                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            <button type="button"
                                                                                onclick="saveSubmit({{ @$value->id }})"
                                                                                id="saveSubmit{{ $value->id }}"
                                                                                class="btn custom-btn">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                    <div class="tab-pane active" id="pen-tab" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>

                                                        <th>Sl. No</th>
                                                        <th>Requested From</th>
                                                        <th>From Organization</th>
                                                        <th>From Designation</th>
                                                        <th>Purpose</th>
                                                        <th>Visiting Date</th>
                                                        <th>Status</th>
                                                        <th>Approved Date</th>
                                                        <th>From Time</th>
                                                        <th>To Time </th>
                                                        <th>MOM File </th>
                                                        @if (in_array(Auth::guard('officer')->user()->role, [
                                                                'Eoffice Deputy Secretary',
                                                                'Eoffice Secretary',
                                                                'Eoffice Additional Secretary',
                                                            ]))
                                                            <th>Actions</th>
                                                        @endif
                                                        {{-- @role('Eoffice Deputy Secretary|Eoffice Secretary|Eoffice Additional Secretary', 'officer')
                                                            <th>Actions</th>
                                                        @endrole --}}
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($recived_appointment as $key => $value)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $value->FromUser->first_name . ' ' . $value->FromUser->last_name }}
                                                            </td>
                                                            <td>{{ @$value->FromUser->company }}</td>
                                                            <td>{{ @$value->FromUser->designation }}</td>
                                                            <td>{{ $value->purpose }} </td>

                                                            <td>{{ $value->visiting_date }} </td>
                                                            <td>
                                                                @if ($value->status == 0 && @$value->visiting_date == \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span
                                                                        class="badge bg-warning rounded-pill">Requested</span>
                                                                @elseif($value->status == 1 && @$value->visiting_date <= \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span
                                                                        class="badge bg-success rounded-pill">Approved</span>
                                                                @elseif($value->status == 0 && @$value->visiting_date > \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    <span class="badge bg-info rounded-pill">Pending</span>
                                                                @elseif($value->status == 2)
                                                                    <span
                                                                        class="badge bg-danger rounded-pill">Rejected</span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-danger rounded-pill">Expired</span>
                                                                @endif
                                                            </td>

                                                            <td>{{ $value->approved_date }} </td>

                                                            <td>{{ $value->from_time }} </td>
                                                            <td>{{ $value->to_time }} </td>
                                                            {{-- 
                                                            @role('Eoffice Deputy Secretary|Eoffice Secretary|Eoffice
                                                                Additional Secretary',
    'officer') --}}
                                                            @if (in_array(Auth::guard('officer')->user()->role, [
                                                                    'Eoffice Deputy Secretary',
                                                                    'Eoffice Secretary',
                                                                    'Eoffice Additional Secretary',
                                                                ]))
                                                                <td><?php
                                                                
                                                                $image_parth = 'public/upload/e_office/mom_file/' . @$value->mom_file;
                                                                
                                                                ?>
                                                                    @if ($value->mom_file != '')
                                                                        <a href="{{ asset(@$image_parth) }}"
                                                                            target="_blank">file

                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($value->status == 0 && @$value->visiting_date == \Carbon\Carbon::today()->format('Y-m-d'))
                                                                    
                                                                        <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                                            title="Edit" data-bs-toggle="modal"
                                                                            data-bs-target="#editModal{{ $value->id }}">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                        </a>
                                                                    @else
                                                                        ---
                                                                    @endif
                                                                </td>
                                                                <div class="modal fade" id="editModal{{ $value->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl modal-dialog-centered"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Approve &
                                                                                    Reject
                                                                                    Form</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <div class="mb-3 row">
                                                                                    <div class="col-sm-12 col-lg-6">
                                                                                        <label>
                                                                                            <input type="radio"
                                                                                                name="book_response{{ $value->id }}"
                                                                                                onClick="block_issue(this.value,{{ $value->id }})"
                                                                                                value="1" checked>
                                                                                            Issue
                                                                                        </label>
                                                                                        <label>
                                                                                            <input type="radio"
                                                                                                name="book_response{{ $value->id }}"
                                                                                                onClick="block_issue(this.value,{{ $value->id }})"
                                                                                                value="0"> Reject
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="reject_remark_div{{ $value->id }}"
                                                                                    style="display: none;">
                                                                                    <div class="mb-3 row">
                                                                                        <div class="col-sm-12 col-lg-4">
                                                                                            <label for=""
                                                                                                class="col-form-label">Requested
                                                                                                From</label>
                                                                                            <input class="form-control"
                                                                                                type="text"
                                                                                                value="{{ $value->FromUser->first_name }}"
                                                                                                readonly id="">
                                                                                        </div>
                                                                                        <div class="col-sm-12 col-lg-4">
                                                                                            <label for=""
                                                                                                class="col-form-label">Reject
                                                                                                Remark</label>
                                                                                            <input
                                                                                                class="form-control form-valid-reject{{ $value->id }}"
                                                                                                type="text"
                                                                                                value=""
                                                                                                id="reject_remark{{ $value->id }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="issue_div{{ $value->id }}">
                                                                                    <div class="mb-3 row ">
                                                                                        <div class="col-sm-12 col-lg-4">
                                                                                            <label for=""
                                                                                                class="col-form-label">Requested
                                                                                                From</label>
                                                                                            <input class="form-control"
                                                                                                type="text"
                                                                                                value="{{ $value->FromUser->first_name }}"
                                                                                                readonly id="">
                                                                                        </div>
                                                                                        <div class="col-sm-12 col-lg-4 ">
                                                                                            <label for=""
                                                                                                class="col-form-label">Appointment
                                                                                                Date</label>
                                                                                            <input type="date"
                                                                                                class="form-control form-valid-approve{{ $value->id }}"
                                                                                                type="text"
                                                                                                min="<?php echo date('Y-m-d'); ?>"
                                                                                                value=""
                                                                                                id="approved_date{{ $value->id }}">
                                                                                        </div>

                                                                                        <div class="col-sm-12 col-lg-4">
                                                                                            <label for=""
                                                                                                class="col-form-label">Appointment
                                                                                                Form Time</label>
                                                                                            <input type="time"
                                                                                                class="form-control form-valid-approve{{ $value->id }}"
                                                                                                type="text"
                                                                                                value=""
                                                                                                id="from_time{{ $value->id }}">
                                                                                        </div>

                                                                                        <div class="col-sm-12 col-lg-4">
                                                                                            <label for=""
                                                                                                class="col-form-label">Appointment
                                                                                                End Time</label>
                                                                                            <input type="time"
                                                                                                class="form-control form-valid-approve{{ $value->id }}"
                                                                                                type="text"
                                                                                                value=""
                                                                                                id="to_time{{ $value->id }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    onclick="saveReject({{ @$value->id }})"
                                                                                    class="btn btn-danger"
                                                                                    style="display: none;"
                                                                                    id="reject_form{{ $value->id }}">Reject</button>
                                                                                <button type="button"
                                                                                    onclick="saveIssue({{ @$value->id }})"
                                                                                    id="issue_form{{ $value->id }}"
                                                                                    class="btn custom-btn">Issue</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- @endrole --}}
                                                            @endif
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
                        id="officer_save_appointment" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4 mb-2">
                                <label class="form-label" for="">Visiting Officer</label>
                                <select class="form-select form-valid" name="visiting_office" id="visiting_office"
                                    autofocus>
                                    <option value="">Select</option>
                                    <option value="department">Department</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Department</label>
                                <select class="form-select form-valid" name="department" id="department" autofocus>
                                    <option value="">Select</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ @$department->name }}">{{ @$department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Designation</label>
                                <select class="form-select form-valid" name="designation" id="designation">

                                    <option value="">Select</option>
                                    <option value="22">Secretary</option>
                                    <option value="21">Deputy Secretary</option>
                                    <option value="23">Additional Secretary</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label" for="">Officer</label>
                                <select class="form-select form-valid" name="officer" id="officer">

                                    <option value="">Select</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Purpose</label>
                                <select class="form-select form-valid" name="purpose" id="purpose">

                                    <option value="">Select</option>
                                    @foreach ($purposes as $purpose)
                                        <option value="{{ @$purpose->name }}">{{ @$purpose->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="">Visiting Date</label>
                                <input type="date" name="visiting_date" class="form-control form-valid save-draft"
                                    id="from_date" min="<?php echo date('Y-m-d'); ?>" placeholder="">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="">Appointment Reason</label>
                                <input type="" class="form-control form-valid save-draft" id="causes"
                                    name="causes" placeholder="">

                            </div>


                            {{-- <div class="col-md-4">
                                <label class="form-label" for="">Identity Type</label>

                                <select class="form-select form-valid" name="identity_type"
                                    {{ @$userIdentity ? 'disabled' : '' }} id="identity_type" autofocus>
                                    <option value="">Select</option>
                                    <option value="Aadhaar Card"
                                        {{ @$userIdentity->identity_type == 'Aadhaar Card' ? 'selected' : '' }}>Aadhaar
                                        Card</option>
                                    <option value="Pan Card"
                                        {{ @$userIdentity->identity_type == 'Pan Card' ? 'selected' : '' }}>Pan Card
                                    </option>
                                    <option value="Driving Licence"
                                        {{ @$userIdentity->identity_type == 'Driving Licence' ? 'selected' : '' }}>Driving
                                        Licence</option>
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label class="form-label" for="">Aadhaar Card Number</label>
                                <input type="text" autocomplete="off" maxlength="12" autofocus class="form-control form-valid"
                                    name="identity_number" id="identity_number"
                                    value="{{ @$userIdentity->identity_number }}" placeholder="" minlength="12">

                            </div> --}}

                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const memoNoInput = document.getElementById('identity_number');

            memoNoInput.addEventListener('input', function() {
                if (this.value.length > 12) {
                    this.value = this.value.slice(0, 12);
                }
            });
        });
    </script>
    <script>
        function block_issue(e, id) {
            var element = document.getElementById("issue_date_div" + id);

            var reject_form_element = document.getElementById("reject_form" + id);
            var issue_form_element = document.getElementById("issue_form" + id);
            // var book_reg_div_element = document.getElementById("book_reg_div"+id);

            var reject_remark_div = document.getElementById("reject_remark_div" + id);

            var issue_div = document.querySelector(".issue_div" + id);

            if (e == 0) {
                reject_remark_div.style.display = "block";

                reject_form_element.style.display = "block";

                issue_form_element.style.display = "none";
                issue_div.style.display = "none";
            } else {

                reject_form_element.style.display = "none";

                reject_remark_div.style.display = "none";

                issue_form_element.style.display = "block";

                issue_div.style.display = "block";
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


        //         } else {
        //             $(this).removeClass('error-text');
        //             $(this).addClass('success-text');
        //         }
        //     });
        //     // alert(errcount);
        //     if (errcount == 0) {
        //         // $.blockUI({ message: '<h1> Loading...</h1>' });

        //         $('#save_appointment').submit();

        //         // $.unblockUI();        
        //     } else {
        //         return false;
        //     }
        // }

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
                if (errcount == 0) {

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
                if (errcount == 0) {
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
        $("#officer_save_appointment").validate({
            rules: {
                visiting_office: {
                    required: true,
                },
                department: {
                    required: true,
                },
                designation: {
                    required: true
                },
                officer: {
                    required: true,
                },
                purpose: {
                    required: true
                },
                visiting_date: {
                    required: true
                },
                causes: {
                    required: true
                },
                identity_number: {
                    required: true,
                    number: true
                }
            },

            submitHandler: function(form) {
                if ($("#officer_save_appointment").valid()) {
                    form.submit();
                }
            }
        });









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
                    console.log(result)
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
