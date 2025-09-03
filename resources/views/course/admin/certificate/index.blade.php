@extends('course.layouts.admin.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b>Certificate Template</b> </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-xl-4 col-sm-6">
                                    <div class="product-box">
                                        <div class="product-img">
                                            <img src="{{ asset('assets/images/certificate_sample/avatar-5.jpg') }}" alt="" class="img-fluid">
                                        </div>
 
                                        <div class="text-center p-3">
 
                                            <h5 class="mb-1"><a href="#" class="text-reset">certificate 1</a></h5>
                                            <button type="button" class="btn btn-info waves-effect waves-light"
                                                onclick="setDefult(1)">Set </button>
 
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="col-xl-4 col-sm-6">
                                    <div class="product-box">
                                        <div class="product-img">
                                            <img src="{{ asset('assets/images/certificate_sample/cer_1.jpeg') }}"
                                                alt="" class="img-fluid">
                                        </div>

                                        <div class="text-center p-3">

                                            <h5 class="mb-1"><a href="#" class="text-reset">Certificate 1</a>
                                            </h5>

                                            @if (@$selectedCertificate->template_id == 2)
                                                <button type="button" disabled
                                                    class="btn btn-secondary waves-effect waves-light">Selected </button>
                                            @else
                                                <button type="button" class="btn btn-info waves-effect waves-light"
                                                    onclick="setCourseCertificate(2)">Choose Template </button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <div class="product-box">
                                        <div class="product-img">
                                            <img src="{{ asset('assets/images/certificate_sample/cer_2.jpeg') }}"
                                                alt="" class="img-fluid">
                                        </div>

                                        <div class="text-center p-3">

                                            <h5 class="mb-1"><a href="#" class="text-reset">Certificate 2</a>
                                            </h5>

                                            @if (@$selectedCertificate->template_id == 3)
                                                <button type="button" disabled
                                                    class="btn btn-secondary waves-effect waves-light">Selected </button>
                                            @else
                                                <button type="button" class="btn btn-info waves-effect waves-light"
                                                    onclick="setCourseCertificate(3)">Choose Template </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function setCourseCertificate(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to select this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, select it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('course.admin.certificate.assign.default') }}",
                        data: {

                            template_id: e,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            location.reload();

                        }
                    });
                }
            })
            // var userConfirmed = confirm("Are you sure that you want to set this as a defult Certificate template!");

            // if (userConfirmed) {
            //     $.ajax({
            //         type: 'post',
            //         url: "{{ route('course.admin.certificate.assign.default') }}",
            //         data: {

            //             template_id: e,
            //             _token: '{{ csrf_token() }}'
            //         },
            //         dataType: 'json',
            //         success: function(data) {
            //             location.reload();

            //         }
            //     });
            // }
        }
    </script>
@endsection
