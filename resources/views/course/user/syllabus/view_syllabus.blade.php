@extends('course.user.layouts.main')
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper">
            <div class="dashboard__section__title">
                <h4>View Syllabus</h4>
            </div>
            <div class="row">



                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-secondary">
                            <tr class="">
                                <th>Sl. No</th>

                                <th>Syllabus Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($syllabus->Syllabus as $key => $val)
                              
                                <tr class="">
                                    <td>{{ ++$key }}</td>
                                    <td class="text-capitalize">{{ $val->syllabus_title }}</td>

                                    <td>
                                        <a href="{{ route('user.course.view-enrolled-class', ['id' => $val->course_id]) }}"
                                            class="btn btn-success btn-sm" title="Edit">
                                           View Class
                                        </a>
                                        <a href="{{ route('user.course.view-material', ['id' => $val->id]) }}"
                                            class="btn btn-info btn-sm" title="Edit">
                                            Study Material
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
@endsection
