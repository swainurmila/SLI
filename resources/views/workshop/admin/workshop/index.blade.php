@extends('workshop.layouts.backend.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row m-2">
                <div class="col-12">
                    <div class="">
                        <h4 class="mb-0"> <b>WORKSHOP LIST</b> </h4>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="text-end">
                    <a href="{{ route('workshop.create')}}" class="btn custom-btn w-xs btn-xs waves-effect waves-light">Add
                        Workshop<span><i class="ms-2 uil-plus-circle"></i></span></a>

                </div>
            </div>
            <!-- end page title -->
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap datatable"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>Sl. No</th>
                                                <th>Workshop Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key=>$item)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td>{{$item->start_date}}</td>
                                                    <td>{{$item->end_date}}</td>
                                                    <td><a href="{{route("workshop.edit", $item->id)}}" class="btn btn-outline-info btn-sm edit" title="EditTraining"><i class="uil-edit-alt"></i></a>
                                                        <a href="{{route("workshop-view", $item->id)}}" class="btn custom-btn btn-sm" title="About-Training">More<i class="uil-info-circle ms-2"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

@endsection
