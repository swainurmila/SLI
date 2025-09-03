<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Certificate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans|Pinyon+Script|Rochester|Rosarivo|Tangerine');

    .cursive {
        font-family: 'Pinyon Script', cursive;
    }

    .cursive-2 {
        font-family: 'Tangerine', cursive;
        dispaly: inline-block;
        padding-right: 18px;
        font-size: 38px;
        font-weight: 400;
    }

    .sans {
        font-family: 'Open Sans', sans-serif;
    }

    .bold {
        font-weight: bold;
    }

    .medium {
        font-size: 20px !important;
    }

    .large {
        font-size: 26px !important;
    }

    .block {
        display: block;
    }

    .underline {
        border-bottom: 1px solid #777;
        padding: 5px;
        margin-bottom: 15px;
    }

    .margin-0 {
        margin: 0;
    }

    .padding-0 {
        padding: 0;
    }

    .pm-empty-space {
        height: 40px;
        width: 100%;
    }

    body {
        padding: 20px 0;
        background: #ccc;
    }

    .pm-certificate-container {
        position: relative;
        width: 800px;
        height: 559px;
        background: url("{{ asset('assets/images/ct2.png') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-color: #fff;
        padding: 0;
        color: #333;
        font-family: 'Open Sans', sans-serif;
        box-shadow: 0 0 5px rgba(0, 0, 0, .5);

        .pm-certificate-border {
            position: absolute;
            padding: 0;
            left: 50%;
            margin-left: -400px;
            top: 50%;
            margin-top: -42px;
            text-align: center;

            .pm-certificate-block {
                width: 650px;
                position: relative;
                left: 50%;
                margin-left: -325px;
                top: 0;
                margin-top: 0;
            }

            .pm-certificate-title {
                position: relative;
                top: 20px;

                h2 {
                    margin: 15px 0;
                    font-family: 'Rosarivo', serif;
                    font-size: 30px !important;
                }
            }

            .pm-certificate-body {
                padding: 0;


                .pm-certificate-text {
                    text-transform: uppercase;
                    margin: 10px 0;
                }

                .pm-name-text {
                    font-size: 20px;
                }
            }

            .pm-earned {
                margin: 5px 0 25px;

                .pm-earned-text {
                    font-size: 20px;
                }

                .pm-credits-text {
                    font-size: 15px;
                }
            }

            .pm-course-title {
                .pm-earned-text {
                    font-size: 20px;
                }

                .pm-credits-text {
                    font-size: 15px;
                }
            }

            .pm-certified {
                font-size: 12px;

                .underline {
                    margin-bottom: 5px;
                }
            }

            .pm-certificate-footer {
                width: 650px;
                height: 100px;
                position: relative;
                left: 50%;
                margin-left: -325px;
                bottom: -105px;
            }

        }
    }
</style>

<body>
    <div class="container" id="content">
        <div class="pm-certificate-container">
            <div class="pm-certificate-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cursive text-center">
                            <h2>CERTIFICATE<br>
                                <span class="cursive-2">of</span><span class="cursive-2 ps-4">Completion</span>
                            </h2>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8 text-center">
                                <h6 class="text-uppercase">This certify That</h6>
                                <h3 class="fw-bold large" style="color: #a50c0a;">{{ucfirst(@$user->first_name)}} {{ucfirst(@$user->last_name)}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8 text-center">
                                <p class="">He/She has successfully conducted research culminating in a paper titled "{{@$submittedPaper->paper_title}}", which has been published in {{@$submittedPaper->subject_category}} on {{\Carbon\Carbon::parse(@$submittedPaper->publish_date)->toFormattedDateString()}}.</p>
                                <h4 class="fw-bold medium" style="color: #f7a915;"></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-between mt-4">
                    <div class="col-lg-6 text-center">
                        <h6 class="sans fw-bold">Date:</h6>
                        <p class="" style="color: #4c5052;">{{\Carbon\Carbon::parse(@$submittedPaper->publish_date)->toFormattedDateString()}}
                        </p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <h6 class="sans fw-bold">Signed:</h6>
                        <p class="" style="color: #4c5052;">State Labour Institute</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="redirect-url" value="{{ URL::previous() }}">
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include jsPDF -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


<script>
    // window.onload = function() {
    //     // Function to trigger print dialog
    //     function printScreenToPDF() {
    //         window.print(); // Open print dialog
    //     }

    //     // Trigger printScreenToPDF function when document is ready
    //     printScreenToPDF();
    // }
    //     window.onload = function() {
    //     // Function to generate and download PDF
    //     function generateAndDownloadPDF() {
    //         var element = document.getElementById('content');
    //         html2pdf()
    //             .from(element)
    //             .set({ orientation: 'landscape' }) // Set orientation to landscape
    //             .save('certificate.pdf')
    //             .then(function () {
    //                 // Close the window if it was opened programmatically
    //                 if (window.opener) {
    //                     window.close();
    //                 }
    //             });
    //     }

    //     // Automatically trigger generateAndDownloadPDF function when document is ready
    //     generateAndDownloadPDF();
    // }
    // window.onload = function() {
    //     // Function to generate and download PDF
    //     function generateAndDownloadPDF() {
    //         var element = document.getElementById('content');
    //         html2pdf()
    //             .from(element)
    //             .set({
    //                 orientation: 'landscape'
    //             }) // Set orientation to landscape
    //             .toPdf()
    //             .get('pdf')
    //             .then(function(pdf) {
    //                 // Generate PDF
    //                 pdf.save('certificate.pdf');

    //                 // Close the current tab
    //                 window.close();
    //                 window.close();

    //                 // Close the tab opened by window.open()
    //                 var openerTab = window.opener;
    //                 alert(openerTab)
    //                 if (openerTab) {
    //                     alert(openerTab)
    //                     openerTab.close();
    //                 }
    //             });
    //     }

    //     // Automatically trigger generateAndDownloadPDF function when document is ready
    //     generateAndDownloadPDF();
    // }
//     window.onload = function() {
//     // Function to generate and download PDF
//     function generateAndDownloadPDF() {
//         var element = document.getElementById('content');
//         html2pdf()
//             .from(element)
//             .set({ orientation: 'landscape' }) // Set orientation to landscape
//             .toPdf()
//             .get('pdf')
//             .then(function (pdf) {
//                 // Generate PDF
//                 pdf.save('certificate.pdf');

//                 // Close the window that opened this window
//                 if (window.opener) {
//                     window.opener.close();
//                 }
//             });
//     }

//     // Automatically trigger generateAndDownloadPDF function when document is ready
//     generateAndDownloadPDF();
// }
// last main
// window.onload = function() {
//     // Function to generate and download PDF
//     function generateAndDownloadPDF() {
//         var element = document.getElementById('content');
//         html2pdf()
//             .from(element)
//             .set({ orientation: 'landscape' }) // Set orientation to landscape
//             .toPdf()
//             .get('pdf')
//             .then(function (pdf) {
//                 // Generate PDF
//                 pdf.save('certificate.pdf');

//                 // Close the current tab
//                 setTimeout(function() {
//                     window.close();
                    
//                     // Close the tab opened by window.open()
//                     var openerTab = window.opener;
//                     if (openerTab) {
//                         openerTab.close();
//                     }
//                 }, 1000); // Adjust the delay as needed
//             });
//     }

//     // Automatically trigger generateAndDownloadPDF function when document is ready
//     generateAndDownloadPDF();
// }
// Final
 window.onload = function() {
     // Function to generate and download PDF
     function generateAndDownloadPDF() {
         var element = document.getElementById('content');
         element.style.padding = '0';
         html2pdf()
             .from(element)
             .set({
                margin: [0, 0, 0, 0],
                filename: 'certificate.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                jsPDF: { unit: 'in', format: 'a5', orientation: 'landscape' }
                })
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


    // window.onload = function() {
    //     // Function to generate and download PDF
    //     function generateAndDownloadPDF() {
    //         var element = document.getElementById('content');
    //         html2pdf()
    //             .from(element)
    //             .set({ orientation: 'landscape' }) // Set orientation to landscape
    //             .toPdf()
    //             .get('pdf')
    //             .then(function (pdf) {
    //                 // Generate PDF
    //                 pdf.save('certificate.pdf');

    //                 // Close the current tab
    //                 window.close();
    //             });
    //     }

    //     // Automatically trigger generateAndDownloadPDF function when document is ready
    //     generateAndDownloadPDF();
    // }
</script>
