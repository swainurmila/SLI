@extends('layouts.backend.header')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title-left">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active text-custom-primary">Price Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Price Management</h4>

                                <form action="{{ route('book.mastersettingsave') }}" method="POST" id="book_save" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">book fine after (Day's)</label>

                                        <input type="text" class="form-control form-valid number-validation" value="{{@$master->fine_days}}" id="fine_days" name="fine_days" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Fine Amount</label>
                                        <input type="text" class="form-control form-valid price-validation" value="{{@$master->fine_amount}}" id="fine_amount" name="fine_amount" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Warning Notification from(Day's)</label>
                                        <input type="text" class="form-control form-valid number-validation" id="notification_days" name="notification_days" value="{{@$master->notification_days}}" placeholder="">
                                    </div>
                                </div>
                            </div>


                            <div class="text-end">
                                <button  type="button" onclick="saveForm()" class="btn custom-btn waves-effect waves-light w-md">Submit</button>
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
</script>
@endsection
