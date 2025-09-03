{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <img class="img-fluid"
                src="{{ asset('public/upload/training/training_image/' . @$training->TrainingImage->file_name) }}"
                alt="">
            <div class="card-body">
                <h4 class="mb-0">{{ @$training->name }}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card overflow-hidden">
            <div class="card-header">
                <h2 class="card-title">About Training</h2>
            </div>
            <div class="card-body pb-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Duration</strong>
                        <span
                            class="mb-0">{{ @$training->training_duration . '' . @$training->training_duration_type }}</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Instructor</strong>
                        <span class="mb-0">Jimmy Morris</span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Language</strong>
                        <span class="mb-0">
                            <i class="flag-icon flag-icon-us"></i><span
                                class="badge rounded-pill bg-secondary">
                                {{ @$training->language->name }} </span>
                        </span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Payment Type</strong>
                        <span
                            class="mb-0">{{ @$training->payment_type == '0' ? 'Free' : 'Paid' }}</span>
                    </li>


                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Price</strong>

                        <span class="mb-0">
                            @if ($training->payment_type == '0')
                                Free
                            @else
                                ₹ {{ number_format(@$training->price, 2, '.', ',') }}
                            @endif

                        </span>
                    </li>
                    <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Certificate</strong>

                        <span class="mb-0">
                            @if ($training->training_type == '0')
                                Yes
                            @else
                                No
                            @endif

                        </span>
                    </li>
                </ul>
            </div>
            <div class="card-footer pt-0 pb-0 text-center">
                <div class="row">
                    <div class="col-6 pt-3 pb-3 border-end">
                        <h3 class="mb-1 text-primary">{{ count(@$training->TotalEnrollOrders) }}</h3>
                        <span>Enrolled Students</span>
                    </div>
                    <div class="col-6 pt-3 pb-3">
                        <h3 class="mb-1 text-primary">{{ count(@$training->TotalBatches) }}</h3>
                        <span>Batches</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}



        {{-- <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link mb-2 active" id="1-tab" data-bs-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Details</a>
            <a class="nav-link mb-2" id="2-tab" data-bs-toggle="pill" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false" tabindex="-1">Batches List</a>
            <a class="nav-link mb-2" id="3-tab" data-bs-toggle="pill" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false" tabindex="-1">Batches Dates</a>
            <a class="nav-link" id="4-tab" data-bs-toggle="pill" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false" tabindex="-1">Ratings</a>
        </div> --}}
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-2 active" id="1-tab" data-bs-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Details</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-2" id="2-tab" data-bs-toggle="pill" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false" tabindex="-1">Batches List</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-2" id="3-tab" data-bs-toggle="pill" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false" tabindex="-1">Batches Dates</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="4-tab" data-bs-toggle="pill" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false" tabindex="-1">Ratings</a>
            </li>
        </ul>