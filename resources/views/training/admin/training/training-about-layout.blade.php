@extends('training.admin.layouts.page-layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">About Training</h4>

                        <div class="page-title-right">
                            <a href="{{ URL::previous() }}" class="btn btn-md btn-dark">
                                Back</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <h4 class="card-title">{{ @$training->name }}</h4>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <span class="card-title-desc">Total Batches<span class="badge rounded-pill bg-primary ms-3 px-2">{{ count(@$training->TotalBatches) }}</span></span>
                            <span class="card-title-desc ms-5">Enrolled Students<span class="badge rounded-pill bg-success ms-3 px-2">{{ count(@$training->TotalEnrollOrders) }}</span></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            @include('training.admin.training.about')
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
                            @yield('training-about')
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
