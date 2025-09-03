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
                                <li class="breadcrumb-item active text-custom-primary">Edit Compose File</li>
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

                            <form action="{{ route('admin.office.editFileSave', ['id' => $file_data->id]) }}" method="POST"
                                id="book_save" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Date</label>
                                        <input type="text" readonly class="form-control form-valid"
                                            value="{{ $file_data->file_date }}" id="file_date" name="file_date"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Delivery Mode</label>
                                        <select class="form-select form-valid" id="delivery_mode_id"
                                            name="delivery_mode_id">

                                            <option value="">Select</option>
                                            @foreach ($delivery_modes as $delivery_mode)
                                                <option
                                                    value="{{ $delivery_mode->id }}"@if ($delivery_mode->id == $file_data->delivery_mode_id) selected @endif>
                                                    {{ $delivery_mode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Letter Type</label>
                                        <select class="form-select form-valid" id="letter_type"
                                            value="{{ $file_data->letter_type }}" name="letter_type">
                                            <option value="">Select</option>


                                            @foreach ($letter_types as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}"
                                                    @if ($delivery_mode->id == $file_data->letter_type) selected @endif>
                                                    {{ $delivery_mode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">File Number</label>
                                        <input type="" class="form-control form-valid" id="file_no"
                                            value="{{ $file_data->file_no }}" name="file_no" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Section</label>
                                        <select class="form-select form-valid" id="section_id" name="section_id">
                                            <option value="">Select</option>
                                            @foreach ($section as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}"
                                                    @if ($delivery_mode->id == $file_data->section_id) selected @endif>
                                                    {{ $delivery_mode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">No. of Memo</label>
                                        <input type="number" class="form-control form-valid"
                                            value="{{ $file_data->memo_no }}" id="memo_no" name="memo_no" placeholder=""
                                            maxlength="25">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Enclosure</label>
                                        <select class="form-select form-valid" id="enclouser_type" name="enclouser_type">
                                            <option value="">Select</option>
                                            <option value="1" @if (1 == $file_data->enclouser_type) selected @endif>Yes
                                            </option>
                                            <option value="0" @if (0 == $file_data->enclouser_type) selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Priority</label>
                                        <select class="form-select form-valid" id="priority_type" name="priority_type">
                                            <option value="">Select</option>
                                            <option value="1" @if (1 == $file_data->priority_type) selected @endif>High
                                            </option>
                                            <option value="2" @if (2 == $file_data->priority_type) selected @endif>Medium
                                            </option>
                                            <option value="3" @if (3 == $file_data->priority_type) selected @endif>Low
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">For Public</label>
                                        <select class="form-select form-valid" id="public_type" name="public_type">
                                            <option value="">Select</option>
                                            <option value="1" @if (1 == $file_data->public_type) selected @endif>Yes
                                            </option>
                                            <option value="2" @if (2 == $file_data->public_type) selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Upload File</label>
                                        <input type="file" class="form-control mb-2" id="upload_file"
                                            name="upload_file[]" placeholder="">

                                        <a href="{{ asset('public/upload/office/upload_file/' . $file_data->upload_file) }}"
                                            target="_blank" class="btn custom-btn btn-sm edit waves-effect waves-light"
                                            title="Edit">
                                            View
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Department</label>
                                        <select class="form-select form-valid" id="department_id" name="department_id">
                                            <option value="">Select</option>
                                            @foreach ($department as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}"
                                                    @if ($delivery_mode->id == $file_data->department_id) selected @endif>
                                                    {{ $delivery_mode->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Name</label>
                                        <select class="form-select form-valid" id="to_user_id" name="to_user_id">
                                            <option value="">Select</option>
                                            @foreach ($users as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}"
                                                    @if ($delivery_mode->id == $file_data->to_user_id) selected @endif>
                                                    {{ $delivery_mode->first_name }}</option>
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
                                                <option value="{{ $delivery_mode->id }}"
                                                    @if ($delivery_mode->id == $file_data->main_category_id) selected @endif>
                                                    {{ $delivery_mode->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Sub Category</label>
                                        <select class="form-select form-valid" id="sub_category_id"
                                            name="sub_category_id">
                                            <option value="">Select</option>
                                            @foreach ($sub_catagrory as $delivery_mode)
                                                <option value="{{ $delivery_mode->id }}"
                                                    @if ($delivery_mode->id == $file_data->sub_category_id) selected @endif>
                                                    {{ $delivery_mode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Letter Subject</label>
                                        <input type="text" class="form-control form-valid" id="letter_subject"
                                            value="{{ $file_data->letter_subject }}" name="letter_subject"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="">Message</label>
                                        <textarea name="message" id="message" class="form-control form-valid" value="{{ @$file_data->message }}"
                                            cols="10" rows="5">{{ @$file_data->message }}</textarea>
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
<script>
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
</script>
