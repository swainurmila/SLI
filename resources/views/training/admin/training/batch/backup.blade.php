@extends('training.admin.training.training-about-layout')

@section('training-about')
    <div class="card">
        <div class="card-body">
            <p>{{ @$training->description }}</p>
            <h4 class="text-primary">Batches Information</h4>
            @if (!@$training->TotalBatches->isEmpty())
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <table class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Maximum Students</th>
                                <th scope="col">Total Class</th>
                                <th scope="col">Enrolled Students</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($training->TotalBatches as $batch)
                                <tr class="">
                                    <td>{{ @$batch->start_time }}</td>
                                    <td>{{ @$batch->end_time }}</td>
                                    <td>{{ @$batch->max_student }}</td>
                                    <td>{{ @$batch->total_class }}</td>
                                    <td>
                                        <a href="{{ route('training.admin.student.list', ['batch' => @$batch->id]) }}"
                                            class="">{{ count(@$batch->trainingOrder) }}</a>
                                        
                                        </td>
                                    <td>
                                        <a href="{{ route('training.admin.batch.details', ['trainingid' => @$training->id, 'batchid' => @$batch->id]) }}"
                                            class="btn btn-sm btn-outline-dark btn-rounded px-4 my-3 my-sm-0 me-3 m-b-10"><i class="fas fa-arrow-right"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No Batches Found !</p>
            @endif

        </div>
    </div>
@endsection