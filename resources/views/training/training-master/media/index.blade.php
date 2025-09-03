@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            {{-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Training media</h4>
                    </div>
                </div>
            </div> --}}

            <div class="row m-2">
                <div class="col-10">
                    <div class="">
                        <h4 class="mb-0"> <b>TRAINING Media</b> </h4>
                    </div>
                </div>

                <div class="col-2">
                    <button class="btn ms-auto btn-md custom-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#addModal">Add Training media</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="table-secondary">
                                        <tr class="text-center">
                                            <th>Sl. No</th>
                                            <th>Media Title</th>
                                            <th>Media Type</th>
                                            <th>Media Payment Type</th>
                                            <th>Media</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $key => $item)
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->media_title }}</td>

                                                <td>{{ $item->media_type }}</td>
                                                <td>{{ $item->payment_mode }}</td>
                                                <?php
                                                
                                                $image_parth = 'public/upload/public_media_file/' . @$item->media_file;
                                                ?>

                                                <td><a href="{{ asset(@$image_parth) }}" target="_blank"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fa fa-eye"></i>
                                                    </a></td>
                                                <td>
                                                    <a href="{{ route('training-delete-media', [$item->id]) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item->id }}').submit();"
                                                        class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                        title="Delete Record">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <!-- Add a form to handle the actual delete action -->
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('training-delete-media', [$item->id]) }}"
                                                        method="POST" style="display: none;">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    <a class="btn custom-btn btn-sm edit waves-effect waves-light"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editTranModal{{ @$item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                                <div class="modal fade" id="editTranModal{{ @$item->id }}"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Training media
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('training-media-update', $item->id) }}"
                                                                method="POST" id="media_edit{{ @$item->id }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Training Catagory
                                                                                    Title:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <input type="text"
                                                                                    id="exampleInputUsername"
                                                                                    class="form-control {{$item->id}}" name="name"
                                                                                    placeholder="Training media Title"
                                                                                    value="{{ @$item->media_title }}">
                                                                                @if ($errors->has('media_title'))
                                                                                    <span
                                                                                        class="text-danger">{{ $errors->first('media_title') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12 mb-2">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Media
                                                                                    Type:<sup><span
                                                                                            style="color: red;">*</span></sup></label>
                                                                                <Select
                                                                                    class="form-control form-valid{{ $item->id }}"
                                                                                    name="media_type">
                                                                                    <option value="">Select Media Type
                                                                                    </option>
                                                                                    <option <?php if ($item->media_type == 'audio') {
                                                                                        echo 'selected';
                                                                                    } ?>
                                                                                        value="audio">Audio</option>
                                                                                    <option <?php if ($item->media_type == 'video') {
                                                                                        echo 'selected';
                                                                                    } ?>
                                                                                        value="video">Video</option>

                                                                                    <option <?php if ($item->media_type == 'ebook') {
                                                                                        echo 'selected';
                                                                                    } ?>
                                                                                        value="ebook">E-Book</option>
                                                                                </Select>
                                                                            </div>

                                                                            <div class="col-md-12 mb-2">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Media Payment
                                                                                        Type:<sup><span
                                                                                                style="color: red;">*</span></sup></label>
                                                                                    <Select
                                                                                        class="form-control form-valid{{ $item->id }}"
                                                                                        name="payment_mode">
                                                                                        <option value="">Select
                                                                                            Payment Type</option>
                                                                                        <option <?php if ($item->payment_mode == 'free') {
                                                                                            echo 'selected';
                                                                                        } ?>
                                                                                            value="free">free</option>
                                                                                        <option <?php if ($item->payment_mode == 'paid') {
                                                                                            echo 'selected';
                                                                                        } ?>
                                                                                            value="paid">paid</option>


                                                                                    </Select>
                                                                                </div>

                                                                                <div class="col-md-12 mb-2">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            class="form-label">Media:<sup><span
                                                                                                    style="color: red;">*</span></sup></label>
                                                                                        <input type="file"
                                                                                            id="media_file"
                                                                                            class="form-control form-valid"
                                                                                            name="media_file[]"
                                                                                            required="required">
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>

                                                                            <button type="button"
                                                                                onclick="saveFormedit({{ $item->id }})"
                                                                                class="btn custom-btn">Update</button>
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
                    <div class="m-4">
                        {!! $datas->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Training media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('training-media-store') }}" method="POST" id="training-media-form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="form-label">Media Title:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <input type="text" id="exampleInputEBook" class="form-control form-valid"
                                    name="media_title" placeholder="Media Title" required="required">
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label class="form-label">Media Type:<sup><span style="color: red;">*</span></sup></label>
                                <Select class="form-control form-valid" name="media_type">
                                    <option value="">Select Media Type</option>
                                    <option value="audio">Audio</option>
                                    <option value="video">Video</option>

                                    <option value="ebook">E-Book</option>
                                </Select>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Media Payment Type:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <Select class="form-control form-valid" name="payment_mode">
                                        <option value="">Select Payment Type</option>
                                        <option value="free">free</option>
                                        <option value="paid">paid</option>


                                    </Select>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label">Media:<sup><span
                                                    style="color: red;">*</span></sup></label>
                                        <input type="file" id="media_file" class="form-control form-valid"
                                            name="media_file[]" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <button type="button" onclick="saveForm()" class="btn custom-btn">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $("#training-media-form").validate({

                rules: {
                    name: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: "Training media field is required",
                    },
                },
            })
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

                $('#training-media-form').submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }

        function saveFormedit(e) {
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

                $('#media_edit' + e).submit();
                // $.unblockUI();         
            } else {
                return false;
            }
        }
    </script>
@endsection
