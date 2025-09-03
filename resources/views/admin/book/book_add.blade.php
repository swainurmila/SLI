@extends('layouts.backend.header')
<style>
    .location-add .location-div {
        width: calc(100% / 5 - 5px);
    }
</style>
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('book.index') }}"><i></i>Book Details</a>
                                </li>
                                <li class="breadcrumb-item active text-custom-primary">Add New Book</li>
                            </ol>
                        </div>

                        <a href="{{ URL::previous() }}" class="btn custom-btn btn-sm">Go to Back<i
                                class="uil-arrow-circle-left text-white font-size-18 ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><b>ADD NEW BOOK</b></h5>


                            <form action="{{ route('book.store') }}" method="POST" id="book_save"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="mb-3 row">
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="col-form-label">Category</label>
                                        <select class="form-select form-valid" id="category_id" name="category_id">
                                            <option value="">Select</option>
                                            @foreach ($category_list as $cat)
                                                <option value="{{ @$cat->id }}">{{ @$cat->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Name Of The Book</label>
                                        <input class="form-control form-valid name-validation" type="text" value=""
                                            id="name" name="name" maxlength="30">
                                    </div>

                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Author</label>
                                        <input class="form-control form-valid name-validation" type="text" value="" maxlength="30"
                                            id="author" name="author">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Publisher</label>
                                        <input class="form-control form-valid name-validation" type="text" value="" maxlength="30"
                                            id="publisher" name="publisher">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Edition</label>
                                        <input class="form-control form-valid number-name-validation" type="text" maxlength="30"
                                            value="" id="edition" name="edition">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Publish Year</label>
                                        <input class="form-control form-valid year" type="text" value=""
                                            id="publish_year" name="publish_year">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Language</label>
                                        <select class="form-select form-valid" id="language_id" name="language_id">
                                            <option value="">Select</option>
                                            @foreach ($language_list as $lan)
                                                <option value="{{ @$lan->id }}">{{ @$lan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Price</label>
                                        <input class="form-control form-valid price-validation" type="text"
                                            value="" id="price" name="price">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Status</label>
                                        <select class="form-select form-valid" id="book_status" name="book_status">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Upload File</label>
                                        <input class="form-control form-valid" type="file" id="image-input"
                                            name="book_image[]" value="" multiple>

                                        <input type="hidden" name="library_images" id="library-images">
                                        <button type="button" id="image-btn" onclick="uploadImages()">Upload Images</button>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Book Instruction</label>
                                        <input class="form-control form-valid" type="text" value=""
                                            id="book_instruction"maxlength="70" name="book_instruction">
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label for="" class="col-form-label">Book Description</label>
                                        <textarea class="form-control form-valid" id="book_description" name="book_description" maxlength="100"></textarea>
                                    </div>
                                </div>

                                <input class="form-control" type="hidden" value="0" id="total_id">
                                <div id="add_mul_loc">
                                    <h5 class="text-decoration-underline text-custom-primary">Location</h5>
                                    <div class="mb-3 row location-add" id="">
                                        <div class="location-div">
                                            <label for="" class="col-form-label">Rack No</label>
                                            <input class="form-control form-valid" type="text" value=""
                                                 id="rack_no">
                                        </div>
                                        <div class="location-div">
                                            <label for="" class="col-form-label">Column</label>
                                            <input class="form-control form-valid" type="text" value=""
                                                 id="column_no">
                                        </div>
                                        <div class="location-div">
                                            <label for="" class="col-form-label">Row</label>
                                            <input class="form-control form-valid" type="text" value=""
                                                id="row_no" >
                                        </div>
                                        <div class="location-div">
                                            <label for="" class="col-form-label">Unique Req Number</label>
                                            <input class="form-control form-valid check_res"
                                                onBlur ="ckeckreg(this.value)" type="text" value=""
                                                id="unique_req_number" >
                                        </div>
                                        <div class="location-div">
                                            <div class="mt-3 pt-4">
                                                <a class="btn btn-warning" id="add_reg">Add <span><i
                                                            class="uil-plus-circle ms-2"></i></span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                        <tr class="">
                                                            <th>Rack No</th>
                                                            <th>Column</th>
                                                            <th>Row</th>
                                                            <th>Unique Req Number</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="addmedIsssue" id="addmedIsssue">


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary" type="button">Back</a>
                                    <button type="button" onclick="saveForm()"
                                        class="btn custom-btn ms-2">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        var serial = 0;
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



        function uploadImages() {
            var formData = new FormData();
            var images = $('#image-input')[0].files; // Use jQuery to get files

            // Append each image to the form data
            for (var i = 0; i < images.length; i++) {
                formData.append('images[]', images[i]);
            }

            // Append the CSRF token for Laravel
            formData.append('_token', $('input[name="_token"]').val());

            // jQuery AJAX request
            $.ajax({
                url: '{{ route('uploadLibraryImage') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
			console.log(response);

                    if (response.success && response.data) {
                        console.log('Images uploaded:', response.data);
                        var sl = 0;
                        response.data.forEach(function(imageName) {
                            var input = $('<input>')
                                .attr('type', 'text')
                                .attr('name', 'library_images_'+ sl )
                                .val(imageName);

                            $('#library-images').append(input);

                            $('#image-input').prop('disabled', true);
                            $('#image-btn').prop('disabled',true);
                            sl++;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Upload failed: " + error);
                }
            });
        }
        function checkRegAjax(val) {
            //alert(123);
            var state_id = this.value;
            //alert(state_id);

            $.ajax({
                type: 'post',
                url: "{{ route('book.bookRegCheck') }}",
                data: {
                    unique_req_number: val,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {

                    console.log(result);
                    console.log(result.location_count);
                    if (result.location_count == 1) {
                        errcount++;
                        alert("inside")
                    }

                }
            });
            return result.location_count;

        }

        function ckeckreg(val) {

            var errcount = 0;

            $('.check_res').each(function() {
                if ($(this).val() == val) {
                    errcount++;


                }

            });
            if (errcount > 1) {
                alert("alredy exiting");
                $(this).val('')
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

                $('#book_edit' + e).submit();
                // $.unblockUI();
            } else {
                return false;
            }
        }
        $('.year').blur(function() {
            //   alert($(this).val());
            var yearInput = $(this).val();
            // $("#publish_year").val();
            var enteredYear = parseInt(yearInput, 10);

            // Get the current year
            var currentYear = new Date().getFullYear();

            // Check if the entered year is within the valid range
            if (enteredYear >= 1900 && enteredYear <= currentYear) {
                // Display a success message or take appropriate action
                console.log('Year is valid');
            } else {
                // Display an error message or take appropriate action
                alert('Please enter a valid year between 1900 and ' + currentYear);
                // $("#publish_year").val('')
                $(this).val('')
            }

        });
        $('.number-validation').blur(function() {
            var inputValue = $(this).val()
            var regex = /^[0-9]+$/;

            // Test the input against the regular expression
            if (regex.test(inputValue)) {

            } else {
                $(this).val('')
                alert('Please enter only numbers')
            }

        });

        $('.price-validation').blur(function() {
            var inputValue = $(this).val();
            // Use a regular expression to allow both integers and decimal numbers
            var regex = /^-?\d*\.?\d+$/;

            // Test the input against the regular expression
            if (regex.test(inputValue)) {
                // The input is a valid number or decimal
            } else {
                // Clear the input value
                $(this).val('');
                alert('Please enter only numbers or decimals');
            }
        });

        $("#add_reg").on("click", function() {

            // alert("fff");
            var counter = $('#total_id').val();
            var rack_no = $('#rack_no').val();
            var column_no = $('#column_no').val();
            var row_no = $('#row_no').val();

            var unique_req_number = $('#unique_req_number').val();
            var errcount = 0;

            $.ajax({
                type: 'post',
                url: "{{ route('book.bookRegCheck') }}",
                data: {
                    unique_req_number: unique_req_number,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {

                    console.log(result);
                    console.log(result.location_count);
                    if (result.location_count == 1) {
                        errcount++;
                    }

                }
            });


            // alert("result.location_count")



            $('.check_res').each(function() {
                if ($(this).val() == unique_req_number) {
                    errcount++;


                }

            });


            if (errcount > 1) {
                alert("please provide Unique Req number");
                $('#unique_req_number').val('')
                return false
            }

            if (rack_no == '' || column_no == '' || row_no == '' || unique_req_number == '') {
                alert('please fill the data')
                return false

            }


            var last_counter = parseInt(counter) + 1;
            cols = '<tr class="table-heading text-center" id="clild_id' + counter +
                '"><td><input class="form-control form-valid" type="text" value="' + rack_no +
                '" name="rack_no_' + serial + '" id="rack_no' + counter +
                '"></td><td><input class="form-control form-valid" type="text" value="' + column_no +
                '" name="column_no_' + serial + '" id="column_no' + counter +
                '"></td><td><input class="form-control form-valid" type="text" value="' + row_no +
                '" name="row_no_' + serial + '" id="row_no' + counter +
                '"></td><td><input class="form-control form-valid check_res"  type="text" value="' +
                unique_req_number + '" name="unique_req_number_' + serial + '" id="unique_req_number' + counter +
                '"></td><td><a onclick="removeDataLocation(0,' + counter +
                ')" class="btn btn-danger">Remove Location<span><i class="uil-times-circle ms-2"></i></span></a></td></tr>';
            $("#addmedIsssue").append(cols);

            $('#total_id').val(parseInt(last_counter));

            serial++;


        });

        function removeDataLocation(id, model) {
            var userConfirmation = confirm('Are you sure you want to delete?');

            if (userConfirmation) {


                $("#clild_id" + model).remove();
            }

        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('book_save');

            form.addEventListener('input', function (event) {
                const target = event.target;
                if (target.classList.contains('form-valid')) {
                    validateField(target);
                }
            });

            function validateField(field) {
                if (field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    field.nextElementSibling.textContent = 'This field is required';
                } else {
                    field.classList.remove('is-invalid');
                    field.nextElementSibling.textContent = '';
                }
            }

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(form);
                let isValid = true;

                form.querySelectorAll('.form-valid').forEach(field => {
                    if (field.value.trim() === '') {
                        field.classList.add('is-invalid');
                        field.nextElementSibling.textContent = 'This field is required';
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                        field.nextElementSibling.textContent = '';
                    }
                });

                if (isValid) {
                    form.submit();
                }
            });
        });
    </script>

@endsection
