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
                                <li class="breadcrumb-item active text-custom-primary">Compose File</li>
                            </ol>
                        </div>
                        <div class="page-title-right">

                            <a href="{{ route('admin.office.createFile') }}" class="btn ms-auto custom-btn"
                                type="button">Create</a>

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
                                            <th>Sent By
                                            </th>
                                            <th>Sent On</th>
                                            <th>Due On</th>
                                            <th>Read On</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($office_files as $key => $file)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $file->file_no }}</td>
                                                <td>{{ $file->letter_subject }}</td>
                                                <td>{{ Auth::guard('officer')->user()->first_name }}
                                                </td>
                                                <td><p>{{ isset($file->created_at) ? $file->created_at->format('d-m-Y') :'N/A' }}</p></td> 
                                                <td><p>{{ isset($file->created_at) ? $file->created_at->format('d-m-Y') :'N/A' }}</p></td>
                                                <td><p>{{ isset($file->created_at) ? $file->created_at->format('d-m-Y') :'N/A' }}</p></td>
                                                <td> <a href="{{ route('admin.office.editFile', @$file->id) }}"
                                                        class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a> </td>
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
            <div class="modal fade" id="send-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Send Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Receipt No.</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Subject</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">To</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">cc</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Set Due Date</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Action</label>
                                        <select class="form-select">
                                            <option>Select</option>
                                            <option>Forward</option>
                                            <option>Approve</option>
                                            <option>Fix A Meeting</option>
                                            <option>Please Call</option>
                                            <option>Give Time</option>
                                            <option>Approved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Priority</label>
                                        <select class="form-select">
                                            <option>Select</option>
                                            <option>Ordinary</option>
                                            <option>Urgent</option>
                                            <option>Average</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Remarks</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit"
                                        class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reply Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Receipt No.</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Subject</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">To</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">cc</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Set Due Date</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Action</label>
                                        <select class="form-select">
                                            <option>Select</option>
                                            <option>Forward</option>
                                            <option>Approve</option>
                                            <option>Fix A Meeting</option>
                                            <option>Please Call</option>
                                            <option>Give Time</option>
                                            <option>Approved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Priority</label>
                                        <select class="form-select">
                                            <option>Select</option>
                                            <option>Ordinary</option>
                                            <option>Urgent</option>
                                            <option>Average</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="">Remarks</label>
                                        <input type="" class="form-control" id="" placeholder="">
                                    </div>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit"
                                        class="btn custom-btn waves-effect waves-light w-md">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div> <!-- container-fluid -->
    </div>
@endsection
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
