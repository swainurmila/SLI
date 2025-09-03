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
                                <li class="breadcrumb-item active text-custom-primary">Assign Address</li>
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
                            <form action="{{ route('admin.office.saveAdddispatchMode') }}" method="POST" id="book_save"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Letter No.</label>
                                        <select class="form-select form-valid" name="letter_id">
                                            <option value="">Select</option>


                                            @foreach ($office_files as $file_name)
                                                <option value="{{ $file_name->id }}">{{ $file_name->file_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="">Group Type</label>
                                        <select class="form-select form-valid" id="group_type_id">
                                            <option value="">Select</option>

                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="">Dispatch Mode</label>
                                        <div class="d-flex justify-content-around" id="mode_div">

                                        </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Your jQuery code here
    </script>

    <script>
        var counter = 0;
        $('#group_type_id').on('change', function() {
            // alert('sds');
            var group_type_id = this.value;
            $.ajax({
                type: 'post',
                url: "{{ route('admin.office.getMode') }}",
                data: {
                    group_type_id: group_type_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    $('#mode_div').empty();
                    // $.each(result.delivery_modes, function(key, value) {
                    //     $("#mode_div").append('<div class="form-check"><input class="form-check-input" type="checkbox" id="" name="dispatch_mode_id[]" value="' + value.id + '"><label class="form-check-label" for="">' + value.name + '</label></div>');
                    // });
                    $.each(result.delivery_modes, function(key, value) {
                        counter++;
                        $("#mode_div").append(
                            '<div class="form-check"><input class="form-check-input" type="checkbox" id="dispatch_mode_' +
                            counter + '" name="dispatch_mode_' + counter + '" value="' +
                            value.id +
                            '"><label class="form-check-label" for="dispatch_mode_' +
                            counter + '">' + value.name + '</label></div>');
                    });

                }
            });
        });

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

                $('#book_save').submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }
    </script>
@endsection
