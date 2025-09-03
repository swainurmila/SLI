@extends('layouts.user_layout.header')
@section('content')
    <style>
        .btn {
            width: auto;
        }
    </style>
    @php
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    @endphp
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Student Library Card</h4>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center" id="content">
                <div class="col-lg-8">
                    <div class="card pt-4 ps-3">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3">
                                <img class="card-img img-fluid px-3" src="{{ $data->profile_photo }}" alt="Card image">
                            </div><!-- end col-->
                            <div class="col-md-9" >
                                <div class="card-body">
                                    <div class="mb-2 row">
                                        <label for="name-input" class="col-md-4 col-form-label">Name</label>
                                        <div class="col-md-8">
                                            : {{ $data->first_name }} {{ $data->last_name }}
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="regd-input" class="col-md-4 col-form-label">Regd. No.</label>
                                        <div class="col-md-8">
                                            : {{ $data->registration_no }}
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="gender-input" class="col-md-4 col-form-label">E-mail</label>
                                        <div class="col-md-8">
                                            : {{ $data->email }}
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="phone-input" class="col-md-4 col-form-label">Contact No.</label>
                                        <div class="col-md-8">
                                            : {{ $data->contact_no }}
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="address-input" class="col-md-4 col-form-label">Present Address</label>
                                        <div class="col-md-8">
                                            : {{ $data->present_address }}
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="address-input" class="col-md-4 col-form-label">Permanent Address</label>
                                        <div class="col-md-8">
                                            : {{ $data->permanent_address }}
                                        </div>
                                    </div>

                                </div><!-- end card body -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                        <div class="mb-3 row d-flex justify-content-center">
                            <?php
                            $padded_string = str_pad($data->id, 4, '0', STR_PAD_LEFT);

                            $bar_id = Auth::user()->registration_no;

                            ?>

                            {!! $generator->getBarcode($bar_id, $generator::TYPE_CODE_128) !!}
                        </div>
                        <div class="mb-3 row d-flex justify-content-center">
                            <a class="btn btn-success waves-effect waves-themed" href="{{route('library.library-carddownload')}}">Download</a>
                        </div>

                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include jsPDF -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    // window.onload = function() {
        // Function to generate and download PDF
        function generateAndDownloadPDF() {
            var element = document.getElementById('content');
            html2pdf()
                .from(element)
                .set({
                    orientation: 'landscape'
                }) // Set orientation to landscape
                .toPdf()
                .get('pdf')
                .then(function(pdf) {
                    // Generate PDF
                    pdf.save('library_card.pdf');

                    // Redirect to a specific URL after a delay
                    setTimeout(function() {
                        var redirectUrl = document.getElementById('redirect-url').value;
                        window.location.href = redirectUrl;
                    }, 1000); // Adjust the delay as needed
                });
        }
        // Automatically trigger generateAndDownloadPDF function when document is ready
        generateAndDownloadPDF();
    // }
</script>
