@extends('research.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Papers</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Nav tabs -->
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <table id="admin_paper_table" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>User Name</th>
                                                <th>Paper Title</th>
                                                <th>Subject Category</th>
                                                <th>Publish</th>
                                                <th>Certificate</th>
                                                <th>Papers</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($submittedPapers as $key => $paper)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ @$paper->user->first_name . ' ' . @$paper->user->last_name }}</td>
                                                    <td>{{ @$paper->paper_title }}</td>
                                                    <td>{{ @$paper->subject_category }}</td>
                                                    <td>{{ @$paper->is_publish == 0 ? 'No' : 'Yes' }}</td>
                                                    <td>{{ @$paper->issue_certificate == 0 ? 'No' : 'Yes' }}</td>
                                                    <td><a href="{{ route('research.admin.download-paper', ['id' => @$paper->id]) }}"
                                                            class="btn custom-btn btn-sm">Download</a></td>
                                                    <td>
                                                        <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                            title="Edit" data-bs-toggle="modal"
                                                            data-bs-target="#editTranModal{{ @$paper->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </td>
                                                    <div class="modal fade" id="editTranModal{{ @$paper->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        role="dialog" aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl modal-dialog-centered"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Paper
                                                                        Details
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                    </button>
                                                                </div>

                                                                <form
                                                                    action="{{ route('research.admin.submitted-papers.update', @$paper->id) }}"
                                                                    method="POST" id="user_edit{{ @$paper->id }}"
                                                                    enctype="multipart/form-data">
                                                                    @method('PATCH')
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-body">
                                                                        <div class="mb-3 row">
                                                                            <div class="col-sm-12 col-lg-4">
                                                                                <label for=""
                                                                                    class="col-form-label">Paper
                                                                                    Title</label>
                                                                                <input class="form-control" type="text"
                                                                                    autofocus
                                                                                    value="{{ $paper->paper_title }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-sm-12 col-lg-4">
                                                                                <label for=""
                                                                                    class="col-form-label">Subject
                                                                                    Category</label>
                                                                                <input class="form-control" type="text"
                                                                                    autofocus
                                                                                    value="{{ $paper->subject_category }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-sm-12 col-lg-4">
                                                                                <label for=""
                                                                                    class="col-form-label">Are you a</label>
                                                                                <input class="form-control" type="text"
                                                                                    autofocus
                                                                                    value="{{ $paper->are_you_a }}"
                                                                                    readonly>
                                                                            </div>

                                                                            <div class="col-sm-12 col-lg-12">
                                                                                <label for=""
                                                                                    class="col-form-label">Description</label>
                                                                                <textarea class="form-control" name="" value="{{ $paper->description }}" id="" cols="5"
                                                                                    rows="5" readonly>{{ $paper->description }}</textarea>
                                                                            </div>

                                                                            @if (@$paper->is_publish == '0')
                                                                                <div class="col-sm-12 col-lg-6">
                                                                                    <label
                                                                                        class="col-form-label">Publish<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-select"
                                                                                        name="publish" required
                                                                                        id="publish_dropdown_{{ $paper->id }}">
                                                                                        {{-- <option>Select</option> --}}
                                                                                        <option value="0"
                                                                                            {{ @$paper->is_publish == '0' ? 'selected' : '' }}>
                                                                                            No</option>
                                                                                        <option value="1"
                                                                                            {{ @$paper->is_publish == '1' ? 'selected' : '' }}>
                                                                                            Yes</option>
                                                                                    </select>
                                                                                </div>
                                                                            @endif

                                                                            @if (@$paper->issue_certificate == '0')
                                                                                <div class="col-sm-12 col-lg-6">
                                                                                    <label
                                                                                        class="col-form-label">Certificate<span
                                                                                            class="text-danger">*</span></label>
                                                                                    <select class="form-select"
                                                                                        name="issue_certificate" required
                                                                                        id="certificate_dropdown_{{ $paper->id }}">
                                                                                        {{-- <option>Select</option> --}}
                                                                                        <option value="0"
                                                                                            {{ @$paper->issue_certificate == '0' ? 'selected' : '' }}>
                                                                                            No</option>
                                                                                        <option value="1"
                                                                                            {{ @$paper->issue_certificate == '1' ? 'selected' : '' }}>
                                                                                            Yes</option>
                                                                                    </select>
                                                                                </div>
                                                                            @endif


                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        @if (@$paper->is_publish == '0' || @$paper->issue_certificate == '0')
                                                                            <button type="submit"
                                                                                class="btn custom-btn">Update</button>
                                                                        @endif
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#admin_paper_table').DataTable();
        });
    </script>
@endsection
