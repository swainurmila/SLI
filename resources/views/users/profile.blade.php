@extends('layouts.user_layout.header')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">User Profile</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update-user-profile') }}"  id="profile_save" enctype="multipart/form-data"
                            onsubmit="">
                            @csrf
                            <div class="mb-2 row">
                                <div class="col-sm-12 col-lg-6">
                                    <label class="form-label" for="">First Name</label>
                                    <input type="text" class="form-control form-valid-save" name="first_name" id="first_name"
                                        placeholder="First Name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)" value="{{$data->first_name}}">
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label class="form-label" for="">Last Name</label>
                                    <input type="text" class="form-control form-valid-save" name="last_name" id="last_name"
                                        placeholder="Last Name" onkeypress="return /[a-z A-Z\.]/i.test(event.key)" value="{{$data->last_name}}">
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-12 col-lg-6">
                                    <label class="form-label" for="">Contact No</label>
                                    <input type="text" class="form-control form-valid-save" name="contact_no" id="contact_no"
                                        placeholder="Contact No" maxlength="10" value="{{$data->contact_no}}" readonly>
                                    <small class="errorTxt3" id="mobile-error" style="color: red"></small>
                                    @if ($errors->has('contact_no'))
                                        <div class="error">{{ $errors->first('contact_no') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label class="form-label" for="">Email</label>
                                    <input type="mail" class="form-control form-valid-save" name="email" id="email"
                                        placeholder="Email" value="{{$data->email}}" readonly>
                                    <small class="errorTxt3" id="email-error" style="color: red"></small>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-2 row">


                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="">Present Address</label>
                                    <textarea name="present_address" id="present_add" class="form-control form-valid-save">{{$data->present_address}}</textarea>
                                    @if ($errors->has('present_address'))
                                        <div class="error">{{ $errors->first('present_address') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="">Permanent Address</label>
                                    <textarea name="permanent_address" id="permanent_add" class="form-control form-valid-save">{{$data->permanent_address}}</textarea>
                                    @if ($errors->has('permanent_address'))
                                        <div class="error">{{ $errors->first('permanent_address') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-12 col-lg-6">
                                    <label class="form-label" for="">Upload Photo</label>
                                    <input type="file" class="form-control" name="profile_photo"
                                        id="profile_photo" placeholder="">
                                    @if ($errors->has('profile_photo'))
                                        <div class="error">{{ $errors->first('profile_photo') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <img src="{{$data->profile_photo}}" style="height: 100px;width: 100px;">
                                </div>

                            </div>

                            <div class="float-end">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="hidden" name="profile_photo_old" value="{{$data->profile_photo}}">
                                <a href="{{ url()->previous() }}" type="button" class="btn btn-danger waves-effect waves-light">Back</a>
                                <button type="button" onclick="saveForm()" class="btn btn-info waves-effect waves-light">Update</button>
                            </div>
                            <!-- end table-responsive -->
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection
<script>
    function saveForm() {
            var errcount = 0;
            $(".error-span").remove();
// alert("dd");
            $("span").remove();
            $('.form-valid-save').each(function() {
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

                $('#profile_save').submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }
    </script>
