@extends('Eoffice.admin.layouts.page-layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active text-custom-primary">Create File</li>
                            </ol>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    <a href="{{route('admin.office.index')}}" class="btn btn-dark text-white"> 
                                        Back </a>
                                </li>
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

                            <form action="{{ route('admin.office.createFilesave') }}" method="POST" id="book_save"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Date</label>
                                        <input type="text" readonly class="form-control form-valid"
                                            value="<?php echo date('Y-m-d'); ?>" id="file_date" name="file_date" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Delivery Mode</label>
                                        <select class="form-select form-valid" id="delivery_mode_id"
                                            name="delivery_mode_id">
                                            <option value="">Select</option>
                                            @foreach ($delivery_modes as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}">{{ $delivery_mode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Letter Type</label>
                                        <select class="form-select form-valid" id="letter_type" name="letter_type">
                                            <option value="">Select</option>
                                            @foreach ($letter_types as $letter_type)
                                                <option value="{{ $letter_type->id }}">{{ $letter_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">File Number</label>
                                        <input type="text" class="form-control form-valid number-name-validation"
                                            id="file_no" name="file_no" placeholder="" maxlength="20">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Section</label>
                                        <select class="form-select form-valid" id="section_id" name="section_id">
                                            <option value="">Select</option>
                                            @foreach ($section as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}">{{ $delivery_mode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">No. of Memo</label>
                                        <input type="number" class="form-control form-valid number-name-validation"
                                            id="memo_no" name="memo_no" onkeypress="return /[0-9]/.test(event.key)" placeholder="" maxlength="25">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Enclousure</label>
                                        <select class="form-select form-valid" id="enclouser_type" name="enclouser_type">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Priority</label>
                                        <select class="form-select form-valid" id="priority_type" name="priority_type">
                                            <option value="">Select</option>
                                            @foreach ($priorities as $priority)
                                                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">For Public</label>
                                        <select class="form-select form-valid" id="public_type" name="public_type">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Upload File</label>
                                        <input type="file" class="form-control form-valid" id="upload_file"
                                            name="upload_file[]" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Department</label>
                                        <select class="form-select form-valid" id="department_id" name="department_id">
                                            <option value="">Select</option>
                                            @foreach ($department as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}">{{ $delivery_mode->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Name</label>
                                        <select class="form-select form-valid" id="to_user_id" name="to_user_id">
                                            <option value="">Select</option>
                                            @foreach ($users as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}">{{ $delivery_mode->first_name }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label class="form-label" for="">Main Category</label>
                                        <select class="form-select form-valid" id="main_category_id"
                                            name="main_category_id">
                                            <option value="">Select</option>
                                            @foreach ($main_catagrory as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}">{{ $delivery_mode->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="">Sub Category</label>
                                        <select class="form-select form-valid" id="sub_category_id"
                                            name="sub_category_id">
                                            <option value="">Select</option>
                                            @foreach ($sub_catagrory as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}">{{ $delivery_mode->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Letter Subject</label>
                                        <input type="text" class="form-control form-valid number-name-validation"
                                            id="letter_subject" name="letter_subject" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="">Message</label>
                                        <textarea name="message" id="message" class="form-control form-valid" cols="10" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="button" onclick="saveForm()"
                                        class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                </div>
                            </form>
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
    function saveForm() {
        if ($("#book_save").valid()) {
            $("#book_save").submit();
        }
    }

    $(document).ready(function() {
        $("#book_save").validate({
            rules: {
                delivery_mode_id: {
                    required: true
                },
                letter_type: {
                    required: true
                },
                file_no: {
                    required: true,
                    maxlength: 20
                },
                section_id: {
                    required: true
                },
                memo_no: {
                    required: true,
                    number: true,
                    maxlength: 25
                },
                enclouser_type: {
                    required: true
                },
                priority_type: {
                    required: true
                },
                public_type: {
                    required: true
                },
                'upload_file[]': {
                    required: true
                },
                department_id: {
                    required: true
                },
                to_user_id: {
                    required: true
                },
                main_category_id: {
                    required: true
                },
                sub_category_id: {
                    required: true
                },
                letter_subject: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                delivery_mode_id: {
                    required: "Please select a delivery mode"
                },
                letter_type: {
                    required: "Please select a letter type"
                },
                file_no: {
                    required: "Please enter a file number",
                    maxlength: "File number cannot be more than 20 characters"
                },
                section_id: {
                    required: "Please select a section"
                },
                memo_no: {
                    required: "Please enter the number of memos",
                    number: "Please enter a valid number",
                    maxlength: "Memo number cannot be more than 25 characters"
                },
                enclouser_type: {
                    required: "Please select an enclouser type"
                },
                priority_type: {
                    required: "Please select a priority type"
                },
                public_type: {
                    required: "Please select if it is for public"
                },
                'upload_file[]':  {
                    required: "Please upload a file"
                },
                department_id: {
                    required: "Please select a department"
                },
                to_user_id: {
                    required: "Please select a name"
                },
                main_category_id: {
                    required: "Please select a main category"
                },
                sub_category_id: {
                    required: "Please select a sub category"
                },
                letter_subject: {
                    required: "Please enter a letter subject"
                },
                message: {
                    required: "Please enter a message"
                }
            }
        });
    });
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const memoNoInput = document.getElementById('memo_no');

            memoNoInput.addEventListener('input', function() {
                if (this.value.length > 25) {
                    this.value = this.value.slice(0, 25);
                }
            });
        });
    </script>

    {{-- <script>
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

                    if ($('#payment_type').val() == '0') {
                        errcount--;
                    }
                } else {
                    $(this).removeClass('error-text');
                    $(this).addClass('success-text');
                }
            });
            // alert(errcount);
            if (errcount == 0) {
                // $.blockUI({ message: '<h1> Loading...</h1>' });

                $('#book_save').submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }
    </script> --}}
@endsection
