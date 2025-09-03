@extends('training.admin.layouts.page-layouts.main')

@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="">Trainings</h4>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                        {{-- <a href="{{route('training.admin.export.list')}}" class="btn btn-warning">Export All</a>
                        <a href="{{ route('training.createTraining') }}" class="btn ms-3 custom-btn">Add
                        Training<span><i class="ms-2 uil-plus-circle"></i></span></a> --}}
                    </div>
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
                                            <th>Training Name</th>
                                            <th>Payment Type</th>
                                            <th>Training Duration</th>
                                            <th>Price</th>
                                             
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainings as $key => $item)
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if($item->payment_type == 0)

                                                    <span class="badge text-bg-success">Free</span>
                                                    @else
                                                    <span class="badge text-bg-dark">Paid</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->training_duration ." ".$item->training_duration_type }}</td>
                                                <td>{{number_format(@$item->price, 2, '.', ',')}}</td>
                                                 
                                                
                                                <td>
                                                    
                                                    <a href="{{ route('training.editTraining', ['id' => $item->id]) }}" class="btn btn-outline-info btn-sm edit" title="EditTraining"><i class="uil-edit-alt"></i></a>

                                                    <a href="{{ route('training.admin.about', ['id' => $item->id]) }}" class="btn custom-btn btn-sm" title="About-Training">More<i class="uil-info-circle ms-2"></i></a>
                                                    <button title="View" class="btn btn-outline-warning btn-sm"
                                                        data-bs-target="#exampleModalToggle-{{ @$item->id }}"
                                                        data-bs-toggle="modal"><i class="fa fa-eye"></i></button>
                                                        
                                                    @php
                                                    $batches = App\Models\Training\TrBatch::with('trainingOrder')
                                                        ->where('training_id', @$item->id)
                                                        ->get();

                                                @endphp


                                                <div class="modal modal-lg fade" id="exampleModalToggle-{{ @$item->id }}"
                                                    aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="exampleModalToggleLabel2">{{ @$item->name }} -
                                                                    Batches List</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">

                                                                    <table class="table table-centered table-nowrap mb-0">
                                                                        <thead class="table-secondary">
                                                                            <tr>
                                                                                <th>Sl. No</th>
                                                                                <th>Batch Name</th>
                                                                                <th>Start Time</th>
                                                                                <th>End Time</th>
                                                                                <th>Max Students</th>
                                                                                <th>Total Class</th>
                                                                                <th class="text-center">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="table-group-divider">
                                                                            @foreach ($batches as $batchkey => $batch)

                                                                                @php
                                                                                    $class_count = App\Models\Training\TrTrainingClass::where('batch_id',@$batch->id)->count();
                                                                                @endphp

                                                                                <tr>
                                                                                    <td class="text-center">
                                                                                        {{ ++$batchkey }}</td>
                                                                                    <td class="text-center">
                                                                                        {{ $batch->batch_name }}</td>
                                                                                    <td class="text-center">
                                                                                        {{ $batch->start_time }}</td>
                                                                                    <td class="text-center">
                                                                                        {{ $batch->end_time }}</td>
                                                                                    <td class="text-center">
                                                                                        {{ $batch->max_student }}</td>
                                                                                        <td class="text-center">
                                                                                            {{ $batch->total_class }}</td>
                                                                                    <td class="text-center">
                                                                                        

                                                                                        @if (count(@$batch->trainingOrder) > 0)
                                                                                            <a href="{{ route('training.admin.student.list', ['batch' => @$batch->id]) }}"
                                                                                                class="btn btn-sm custom-btn position-relative">
                                                                                                Show Enroll Students
                                                                                                <span
                                                                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                                                    {{ count(@$batch->trainingOrder) > 10 ? '10+' : count(@$batch->trainingOrder) }}</span>

                                                                                            </a>
                                                                                        @else
                                                                                            <span class="text-center">No
                                                                                                Enrollment
                                                                                                Found</span>
                                                                                        @endif

                                                                                        {{-- <a href="{{ route('training.admin.class.list', ['id' => @$batch->id]) }}"
                                                                                            class="btn btn-sm custom-btn  position-relative">
                                                                                            Class
                                                                                            <span
                                                                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{@$class_count}}</span>

                                                                                        </a> --}}

                                                                                        <a href="{{ route('training.admin.batch.details', ['trainingid' => @$item->id,'batchid'=>@$batch->id]) }}"
                                                                                            class="btn btn-sm custom-btn  position-relative">
                                                                                            Batch Details

                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>


                                                            </div>
                                                            {{-- <div class="modal-footer">
                                                                <button class="btn btn-primary"
                                                                    data-bs-target="#exampleModalToggle-{{ @$item->id }}"
                                                                    data-bs-toggle="modal">Close</button>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                             
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>


                    </div>

                    <div class="m-4">
                        {!! $trainings->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>



            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
