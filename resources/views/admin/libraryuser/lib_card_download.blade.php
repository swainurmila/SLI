<!doctype html>
<html lang="en" id="content">

    <head>
        <meta charset="utf-8" />
        <title>Student | e-Library</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="e-Library" name="description" />
        <!-- Bootstrap Css -->
        <link href="{{ asset('asset/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    </head>
    <style>
        .lib-card {
            position: relative;
            object-fit: cover;
            object-position: center;
            background-image: url("{{ asset('asset/images/lib-card-nw.png') }}");
        }

    </style>
    <body>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card lib-card">
                        <div class="card-body content-section-card p-4">
                            <div class="p-2">
                                <div class="user-thumb text-center mb-5">
                                    <img src="{{ $data->profile_photo }}" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                </div>
                                <form action="index.html" class="">
                                    <div class="mb-2">
                                        <label class="form-label fw-bold text-dark" for="">Full Name :</label>
                                        <span class="ms-3">{{ $data->first_name }} {{ $data->last_name }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold text-dark" for="">Regestration No. :</label>
                                        <span class="ms-3">{{ $data->registration_no }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold text-dark" for="">Email :</label>
                                        <span class="ms-3">{{ $data->email }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-bold text-dark" for="">Contact :</label>
                                        <span class="ms-3">{{ $data->contact_no }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-dark" for="">Address :</label>
                                        <span class="ms-3">{{ $data->present_address }}</span>
                                    </div>
                                    <div class="text-center mb-3">
                                        {!! $barcode !!}
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <input type="hidden" id="redirect-url" value="{{ URL::previous() }}">
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include jsPDF -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script>
    window.onload = function() {
     // Function to generate and download PDF
     function generateAndDownloadPDF() {
         var element = document.getElementById('content');
         html2pdf()
             .from(element)
             .set({ orientation: 'landscape' }) // Set orientation to landscape
             .toPdf()
             .get('pdf')
             .then(function (pdf) { 
                 // Generate PDF
                 pdf.save('certificate.pdf');

                 // Redirect to a specific URL after a delay
                 setTimeout(function() {
                     var redirectUrl = document.getElementById('redirect-url').value;
                     window.location.href = redirectUrl;
                 }, 1000); // Adjust the delay as needed
             });
   }
    // Automatically trigger generateAndDownloadPDF function when document is ready
     generateAndDownloadPDF();
}
    </script>
