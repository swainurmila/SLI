@extends('Eoffice.admin.layouts.page-layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-md-3">
                    <div class="card">
                        <img src="https://e1.pxfuel.com/desktop-wallpaper/205/768/desktop-wallpaper-virat-kohli-happy-with-rcb-s-buys-in-ipl-auction-says-looking-virat-kohli-rcb-thumbnail.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="welcome-admn">
                                <span id="leftmenu_lblName">MR JOHN DOE</span>
                                <div class="moble"> MOB: <span id="leftmenu_lblMobile">1234567891</span></div>
                                <a href="../DailyPass/ViewReport.aspx" class="btn btn-light mt-1 btn-sm">Edit Profile</a>
                            </div>
        
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <h4 class="card-title mb-4">Apply One Day Appointment</h4>
                            </div>

                            <form action="{{ route('admin.office.appointment.saveRequestAppointment') }}" method="POST"
                                id="e_office_appointment_save" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Visiting Office</label>
                                            <select class="form-select form-valid" name="visiting_office"
                                                id="visiting_office" autofocus>
                                                <option value="">Select</option>
                                                <option value="department">Department</option>
                                                {{-- <option value="office">Office</option> --}}
                                            </select>
                                            {{-- <input type="text" class="form-control form-valid" autocomplete="off" name="name"
                                                id="name" placeholder="" autofocus> --}}
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Department</label>
                                            <select class="form-select form-valid" name="department" id="department"
                                                autofocus>
                                                <option value="">Select</option>
                                                <option value="Labour & Employee's State Insurance">Labour & Employee's
                                                    State
                                                    Insurance</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="">Designation</label>
                                        <select class="form-select form-valid" name="designation" id="designation"
                                            autofocus>
                                            <option value="">Select</option>
                                            <option value="22">Secretary</option>
                                            <option value="21">Deputy Secretary</option>
                                            <option value="23">Additional Secretary</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="">Officer</label>
                                        <select class="form-select form-valid" name="officer" id="officer" autofocus>
                                            <option value="">Select</option>
                                        </select>
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label" for="">Purpose</label>
                                        <select class="form-select form-valid" name="purpose" id="purpose" autofocus>
                                            <option value="">Select</option>
                                            <option value="Grievance">Grievance</option>
                                            <option value="Official">Official</option>
                                            <option value="Other">Other</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Repair & Maintenance">Repair & Maintenance</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="">Visiting Date</label>
                                        <input type="date" autocomplete="off" autofocus class="form-control form-valid"
                                            name="visiting_date" id="visiting_date" placeholder=""
                                            min="<?php echo date('Y-m-d'); ?>">
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <label class="form-label" for="">Identity Type</label>
                                        <input type="hidden" name="identity_type"
                                            value="{{ @$userIdentity->identity_type }}">

                                        <select class="form-select form-valid" name="identity_type"
                                            {{ @$userIdentity ? 'disabled' : '' }} id="identity_type" autofocus>
                                            <option value="">Select</option>
                                            <option value="Aadhaar Card"
                                                {{ @$userIdentity->identity_type == 'Aadhaar Card' ? 'selected' : '' }}>
                                                Aadhaar Card</option>
                                            <option value="Pan Card"
                                                {{ @$userIdentity->identity_type == 'Pan Card' ? 'selected' : '' }}>Pan Card
                                            </option>
                                            <option value="Driving Licence"
                                                {{ @$userIdentity->identity_type == 'Driving Licence' ? 'selected' : '' }}>
                                                Driving Licence</option>
                                        </select>

                                    </div> --}}
                                    <div class="col-md-6">
                                        <label class="form-label" for="">Aadhaar Card Number</label>
                                        <input type="number" autocomplete="off" autofocus class="form-control form-valid"
                                            name="identity_number" value="{{ @$userIdentity->identity_number }}"
                                            {{ @$userIdentity->identity_number ? 'readonly' : '' }} id="identity_number"
                                            placeholder="">

                                    </div>


                                </div>



                                <div class="text-end mt-4">
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                    <button type="submit" id="submit_button" class="btn custom-btn">Submit</button>
                                </div>


                            </form>
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
        $("#e_office_appointment_save").validate({
            rules: {
                visiting_office: {
                    required: true,
                },
                department: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                officer: {
                    required:true,
                },
                purpose: {
                    required: true,
                },
                visiting_date: {
                    required: true,
                }
                


            },
            submitHandler: function(form) {
                form.submit();
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
