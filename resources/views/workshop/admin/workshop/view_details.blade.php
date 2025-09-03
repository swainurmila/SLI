@extends('workshop.admin.workshop.workshop-about-layout')

@section('style')
    <style>
        table tr td.accord-table-content {
            padding: .0rem .75rem;
            border-top-width: 0.05rem;
        }

        .clickable tr {
            pointer-events: none;
        }
    </style>
@endsection
@section('workshop-about')
    <div class="tab-content text-muted mt-4 mt-md-0">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="1-tab">

            <div class="row">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <img class="img-fluid" src="{{ @$details->image }}" alt="">

                </div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <h5 class="text-danger fw-bold">Workshop Name : <span class="ms-2">{{ @$details->title }}</span>
                    </h5>
                    {{-- <h5 class="text-danger fw-bold"><span
                            class="badge rounded-pill bg-primary">{{ ucfirst(@$course->Category->name) }}</span>
                    </h5> --}}
                    {{-- <li class="rank-rating mb-0" style="margin-left:40px;">
                        <ul class="list-unstyled rating-list">
                            @for ($i = 1; $i <= $roundedAverageRating; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" height="14" width="15.75"
                                    viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#FFD43B"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                </svg>
                            @endfor
                            <li class="ps-2">Rating ( {{ count(@$totalRatings) }} )</li>
                        </ul>
                    </li> --}}
                    <div class="">

                        <span class="badge bg-warning font-size-14 mx-4"><i class="uil-star"></i> {{@$roundedAverageRating}}</span>
                        {{-- <span class="badge bg-secondary font-size-14"><i class="uil-users-alt me-2"></i>{{count(@$training->TrainingReviews)}} Reviews</span> --}}
                    </div>

                    <p>{{ @$details->description }}</p>
                    <div class="row">
                        <div class="col-md-6 border-end border-primary">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Start Date</strong>
                                    <span
                                        class="mb-0">{{ Carbon\Carbon::parse(@$details->start_date)->toFormattedDateString() }}</span>
                                </li>
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Price</strong>

                                    <span class="mb-0">
                                        {{ isset($details->price) ? '₹ ' . number_format($details->price, 2, '.', ',') : '₹ ' . number_format($details->price, 2, '.', ',') }}

                                    </span>
                                </li>
                                {{-- <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Language</strong>
                                    <span class="mb-0">
                                        <i class="flag-icon flag-icon-us"></i><span class="badge rounded-pill bg-secondary">
                                            {{ @$course->language->name }} </span>
                                    </span>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>End Date</strong>
                                    <span
                                        class="mb-0">{{ Carbon\Carbon::parse(@$details->end_date)->toFormattedDateString() }}</span>
                                </li>

                                {{-- <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Payment Type</strong>
                                    <span class="mb-0">{{ @$course->payment_type == 'free' ? 'Free' : 'Paid' }}</span>
                                </li> --}}

                                <li class="list-group-item d-flex px-0 justify-content-between">
                                    <strong>Certificate</strong>

                                    <span class="mb-0">
                                        Yes
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="2-tab">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row m-2 justify-content-end">
                        <div class="col-2">
                            <a href="{{ route('workshop.add-schedule', $details->id) }}"
                                class="btn btn-md custom-btn">Create Schedule</a>
                            {{-- <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModalSyllabus">Create Schedule</button> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="batches_datatable" class="table table-bordered datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Serial No.</th>
                                    <th scope="col">Schedule Title</th>
                                    <th>Schedule Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedule as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->schedule_title }}</td>
                                        <td>{{ $item->schedule_date }}</td>
                                        <td>
                                            {{-- <a href="{{ route('workshop.edit-schedule', ['id' => $item->id]) }}" class="btn custom-btn btn-sm" title="Edit">Edit</a> --}}
                                            <a href="{{ route('workshop.workshop-attendance', ['id' => $item->id]) }}" class="btn custom-btn btn-sm" title="Edit">Attendace</a>

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModalSchedule{{ $item->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Schedule</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="refreshPage()"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <form action="{{ route('workshop.edit-schedule') }}" method="POST"
                                                    id="course_place_save" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="workshop_id" value="{{ @$details->id }}">
                                                    <input type="hidden" name="schedule_id" value="{{ @$item->id }}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Schedule Title:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="text" id="schedule_title"
                                                                        class="form-control" name="schedule_title"
                                                                        placeholder="Schedule Title"
                                                                        value="{{ $item->schedule_title }}"
                                                                        required="required">
                                                                    @if ($errors->has('schedule_title'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('schedule_title') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Schedule Date:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="date" id="schedule_date"
                                                                        class="form-control" name="schedule_date"
                                                                        placeholder="Schedule Title"
                                                                        value="{{ $item->schedule_date }}"
                                                                        required="required">
                                                                    @if ($errors->has('schedule_date'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('schedule_date') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Start Time:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="time" id="start_time"
                                                                        class="form-control" name="start_time"
                                                                        placeholder="Schedule Title"
                                                                        value="{{ $item->start_time }}"
                                                                        required="required">
                                                                    @if ($errors->has('start_time'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('start_time') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">End Time:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="time" id="end_time"
                                                                        class="form-control" name="end_time"
                                                                        placeholder="Schedule Title"
                                                                        value="{{ $item->end_time }}"
                                                                        required="required">
                                                                    @if ($errors->has('end_time'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('end_time') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label"> Description:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <textarea name="sch_description" id="sch_description" class="form-control">{{ old('sch_description', $item->sch_description ?? '') }}</textarea>
                                                                    @if ($errors->has('sch_description'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('sch_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                                                        <button type="submit" class="btn custom-btn">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="3-tab">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row m-2 justify-content-end">
                        <div class="col-2">
                            <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add Presentations</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="batches_datatable" class="table table-bordered datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Serial No.</th>
                                    <th scope="col">Presentation Title</th>
                                    <th>Document view</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presentation as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->presentation_title }}</td>
                                        <td>
                                            @if ($item->document)
                                                <a href="{{ asset($item->document) }}" target="_blank">View Document</a>
                                            @else
                                                No Document Uploaded
                                            @endif
                                        </td>
                                        <td><a class="btn custom-btn btn-sm edit waves-effect waves-light" title="Edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModalPresentation{{ $item->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a></td>
                                    </tr>
                                    <div class="modal fade" id="editModalPresentation{{ $item->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Presentation
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="refreshPage()"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <form action="{{ route('workshop.edit-presentations') }}" method="POST"
                                                    id="course_place_save" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="workshop_id"
                                                        value="{{ @$details->id }}">
                                                    <input type="hidden" name="presentation_id"
                                                        value="{{ @$item->id }}">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Presentation Title:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <input type="text" id="edit_presentation_title"
                                                                        class="form-control" name="presentation_title"
                                                                        placeholder="Presentation Title"
                                                                        value="{{ $item->presentation_title }}"pattern="^[^\d\s][\w\s]*$"
                                                                        >

                                                                    @if ($errors->has('presentation_title'))
                                                                        <span id="pre_title_error"
                                                                            class="text-danger">{{ $errors->first('presentation_title') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="old_document"
                                                                        value="{{ $item->document }}">
                                                                    <label class="form-label">Upload File :<sup><span
                                                                                style="color: red;">*</span></sup> &nbsp;<a
                                                                            href="{{ asset($item->document) }}"
                                                                            target="_blank">View Document</a> </label>
                                                                    <input type="file" id="edit_document"
                                                                        class="form-control" name="document"
                                                                        value="{{ $item->document }}">
                                                                    @if ($errors->has('document'))
                                                                        <span id="pre_document_error"
                                                                            class="text-danger">{{ $errors->first('document') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <div class="form-group">
                                                                    <label class="form-label">Description:<sup><span
                                                                                style="color: red;">*</span></sup></label>
                                                                    <textarea name="pre_description" id="edit_pre_description" class="form-control">{{ old('pre_description', $item->pre_description ?? '') }}</textarea>
                                                                    @if ($errors->has('pre_description'))
                                                                        <span id="pre_description_error"
                                                                            class="text-danger">{{ $errors->first('pre_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal" onclick="javascript:window.location.reload()">Close</button> --}}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                                                        <button type="submit" class="btn custom-btn" onclick="return editPresentation({{ $item->id }})" >update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="4-tab">

            <div class="col-lg-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="course_rating_datatable" class="table table-bordered">
                            <thead class="table-light">
                                <tr class="">
                                    <th>Sl. No</th>
                                    <th>Student Name</th>
                                    <th>Rating</th>
                                    <th>Feedback </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                           <tbody>
                            {{-- {{dd($feedback)}} --}}
                                @foreach ($feedback as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$value->userDetails->user_name}}</td>
                                        <td>
                                            <div class="dashboard__table__star">
                                                @for ($i = 1; $i <= $value->rating; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="rgb(255, 223, 0)" stroke="rgb(255, 223, 0)"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <div class="dashboard__table__star">
                                                @for ($i = 1; $i <= $feedback->rating; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="dashboard__small__text">{{@$feedback->feedback}}</p>
                                        </td> --}}
                                        <td>{{ $value->feedback}}</td>



                                        {{-- <td> <a href="{{ route('workshop.review.destroy', [@$value->id]) }}"
                                            class="btn btn-danger btn-sm edit waves-effect waves-light"
                                            title="Delete Record" onclick="confirmDelete(this)">
                                            <i class="fa fa-trash"></i>
                                        </a></td> --}}
                                        <td>
                                            {{-- <a href="javascript:void(0);"
                                               data-url="{{ route('workshop.review.destroy', [@$value->id]) }}"
                                               class="btn btn-danger btn-sm delete-btn waves-effect waves-light"
                                               title="Delete Record"
                                               onclick="event.preventDefault(); confirmDelete({{ $item->id }});">
                                               <i class="fa fa-trash"></i>
                                            </a> --}}
                                            <a href="{{ route('workshop.review.destroy', [@$value->id]) }}"
                                                onclick="event.preventDefault(); confirmDelete({{ @$value->id }});"
                                                class="btn btn-danger btn-sm edit waves-effect waves-light"
                                                title="Delete Record">
                                                <i class="fa fa-trash"></i>
                                             </a>

                                             <!-- Add a form to handle the actual delete action -->
                                             <form id="delete-form-{{@$value->id}}"
                                                   action="{{ route('workshop.review.destroy', [@$value->id]) }}"
                                                   method="POST" style="display: none;">
                                                 @method('GET')
                                                 @csrf
                                             </form>

                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="5-tab">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="row m-2 justify-content-end">
                        <div class="col-2">
                            {{-- <button class="btn btn-md custom-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#addModal">Add Enrolled Student</button> --}}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="batches_datatable" class="table table-bordered datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>User Name</th>
                                    <th>Workshop</th>
                                    <th>Paid Amount</th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrolled_student as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->user->first_name }} {{ $value->user->last_name }}</td>
                                        <td>{{ $value->workshop->title }}</td>
                                        <td>{{ $value->transaction->amount  ?? '-'}}</td>
                                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Presentations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onClick="refreshPage()" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('workshop.create-presentations') }}" method="POST" id="add_presentation"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Title:<sup><span style="color: red;">*</span></sup></label>
                                    <input type="hidden" name="workshop_id" value="{{ @$details->id }}">
                                    <input type="text" id="presentation_title" class="form-control"
                                        name="presentation_title" placeholder="Presentation Title" value=""
                                        required="required" maxlength="30" pattern="[a-zA-Z\s]+" onkeypress="return validateKeyPress(event)" oninput="capitalizeFirstLetter(this)">
                                    @if ($errors->has('presentation_title'))
                                        <span class="text-danger">{{ $errors->first('presentation_title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Upload File:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="file" id="document" class="form-control" name="document"
                                        value="" accept="application/pdf,image/*" required="required">
                                    @if ($errors->has('document'))
                                        <span class="text-danger">{{ $errors->first('document') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label">Description:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <textarea name="pre_description" id="pre_description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                        <button type="submit" class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModalSyllabus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-l modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ route('workshop.create-schedule') }}" method="POST" id="schedule_save"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="workshop_id" value="{{ @$details->id }}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Schedule Title:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="text" id="schedule_title" class="form-control" name="schedule_title"
                                        placeholder="Schedule Title" value="" required="required"
                                        onkeypress="return /[a-z A-Z\.]/i.test(event.key)" maxlength="50">
                                    @if ($errors->has('schedule_title'))
                                        <span class="text-danger">{{ $errors->first('schedule_title') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Schedule Date:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="date" id="schedule_date" class="form-control" name="schedule_date"
                                        placeholder="Schedule Date" value="" required="required"
                                        min="{{ $details->start_date }}" max="{{ $details->end_date }}">
                                    @if ($errors->has('schedule_date'))
                                        <span class="text-danger">{{ $errors->first('schedule_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Start Time:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="time" id="start_time" class="form-control" name="start_time"
                                        placeholder="Start Time" value="" required="required">
                                    @if ($errors->has('start_time'))
                                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">End Time:<sup><span
                                                style="color: red;">*</span></sup></label>
                                    <input type="time" id="end_time" class="form-control" name="end_time"
                                        placeholder="End Time" value="" required="required">
                                    @if ($errors->has('end_time'))
                                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label">Description:<sup><span
                                            style="color: red;">*</span></sup></label>
                                <textarea name="sch_description" id="sch_description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="refreshPage()">Close</button>
                        <button type="submit" class="btn custom-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function validateTime() {
            var startTime = document.getElementById('start_time').value;
            var endTime = document.getElementById('end_time').value;

            // Check if both start and end times are provided
            if (startTime && endTime && startTime >= endTime) {
                alert('End time should be greater than start time');
                document.getElementById('end_time').value = '';
            }
        }
        document.getElementById('start_time').addEventListener('change', validateTime);
        document.getElementById('end_time').addEventListener('change', validateTime);
    </script>
    <script>
        $(document).ready(function() {


            function clearFormFields() {
                $("#schedule_save")[0].reset(); // Reset the form
                $("#schedule_save").validate().resetForm(); // Reset the validation state
            }

            function clearFormFields() {
                $("#add_presentation")[0].reset(); // Reset the form
                $("#add_presentation").validate().resetForm(); // Reset the validation state
            }


            $("#schedule_save").validate({
                rules: {
                    schedule_title: {
                        required: true,
                    },
                    schedule_date: {
                        required: true,
                    },
                    start_time: {
                        required: true,
                    },
                    end_time: {
                        required: true,
                    },

                },
                messages: {
                    schedule_title: {
                        required: "Schedule Title  Is required",
                        noSpace: "Schedule name cannot contain only spaces",
                    },
                    schedule_date: {
                        required: "Schedule Date is required",
                    },
                    start_time: {
                        required: "Start Time is required",
                    },
                    end_time: {
                        required: "End Time is required",
                    },
                },
                submitHandler: function(form) {
                    if ($("#schedule_save").valid()) {
                        form.submit();
                    }
                }
            });
            $('#addModalSyllabus').on('hidden.bs.modal', function(e) {
                clearFormFields();
            });

            $('#course_rating_datatable').DataTable();


            $('#addModal').on('hidden.bs.modal', function(e) {
                 clearFormFields();
            });

            $.validator.addMethod('filesize_max', function(value, element, param) {
                if (element.files.length > 0) {
                    var fileSize = element.files[0].size;
                    var maxSize = parseInt(param);
                    return fileSize <= maxSize;
                }
                return true;
            }, 'File size must be less than 20MB');

            $("#add_presentation").validate({
                rules: {
                    presentation_title: {
                        required: true,
                        // lettersOnly: true,
                    },
                    document: {
                        required: true,
                        filesize_max: 20971520,
                        accept: "application/pdf,*/*",
                    },
                    pre_description: {
                        required: true,
                    },
                },
                messages: {
                    presentation_title: {
                        required: "Presentation title is required",
                        // lettersOnly: "Please enter only alphabetic characters",

                    },
                    document: {
                        required: "File upload is required",
                        accept: "Please select a valid file",
                        filesize_max: "File size must be less than 20 MB"
                    },
                    pre_description: {
                        required: "Description is required",
                    }
                },
                // submitHandler: function(form) {
                //     if ($("#add_presentation").valid()) {
                //         form.submit();
                //     }
                // }
            });
            $('#document').on('change', function() {
        $(this).valid();
    });
        });
    </script>
    <script>
        function capitalizeFirstLetter(input) {
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
        }
    </script>

<script>
    function confirmDelete(element) {
        const url = element.getAttribute('data-url');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
<script>

function refreshPage() {
            window.location.reload();
        }
    function validateKeyPress(event) {
        // Prevent spaces at the beginning of the input
        if (event.key === ' ' && event.target.value.length === 0) {
            return false;
        }

        // Allow only letters and spaces
        const regex = /^[a-zA-Z\s]*$/;
        return regex.test(event.key);
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modals = document.querySelectorAll('.modal');

        modals.forEach(function(modal) {
            var form = modal.querySelector('form');
            var initialData = {};

            modal.addEventListener('shown.bs.modal', function() {
                // Save the initial data when the modal is shown
                initialData = new FormData(form);
            });

            modal.addEventListener('hidden.bs.modal', function() {
                // Reset the form to initial data when the modal is hidden
                form.reset();
                for (let [key, value] of initialData.entries()) {
                    if (form.elements[key]) {
                        if (form.elements[key].type === "checkbox" || form.elements[key].type === "radio") {
                            form.elements[key].checked = value === 'on';
                        } else if (form.elements[key].type !== "file") {
                            form.elements[key].value = value;
                        }
                    }
                }
            });
        });
    });
    </script>

<script>
    function editPresentation(id) {
        // alert(id);
        var isValid = true;
        // var maxFileSize = 20971520;

        var presentationId = document.getElementById('edit_presentation_title').value.trim();
        var presentationDocument = document.getElementById('edit_document').value.trim();
        var presentationdescription = document.getElementById('edit_pre_description').value.trim();

        // Clear previous error messages
        document.getElementById('pre_title_error').textContent = '';
        document.getElementById('pre_document_error').textContent = '';
        document.getElementById('pre_description_error').textContent = '';

        if (presentationId === '' || presentationId == null) {
            console.log(presentationId);
            document.getElementById('pre_title_error').textContent = 'Please enter presentation title';
            isValid = false;
        }
        if (presentationDocument === '' || presentationDocument == null) {
         console.log(presentationId);
            document.getElementById('pre_document_error').textContent = 'Please enter presentation title';
            isValid = false;
        }

        if (presentationDescription === '' || presentationDescription == null) {
            console.log(presentationId);
            document.getElementById('pre_description_error').textContent = 'Please enter description';
            isValid = false;
        }


        return isValid;
    }
</script>
<script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            })
        }
    </script>


@endsection
