@extends('course.user.layouts.main')
@section('profile-content')
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="dashboard__content__wraper">
            <div class="dashboard__section__title">
                <h4>Reviews</h4>
            </div>
            <div class="row">
                <div>

                    <div class="row">
                        <div class="col-xl-12">
                            @if(count($feedbacks) > 0 )
                                <div class="dashboard__table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Course Title</th>
                                                <th>Review</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                            @foreach ($feedbacks as $feedback)
                                                <tr>
                                                    <th>{{@$feedback->courseDetails->course_name}}</th>
                                                    <td>
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
                                                    </td>
                                                    <td>
                                                        <div class="dashboard__button__group">
                                                            <a class="dashboard__small__btn" href="{{route('user.course.review.destroy',@$feedback->id)}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 4" fill="none"
                                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" class="feather feather-trash-2">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg> Delete</a>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach

                                            
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center">No Reviews Found !</p>
                            @endif
                        </div>



                        @if ($feedbacks->hasPages())
                            <ul class="pager">
                                @if ($feedbacks->onFirstPage())
                                    <li class="disabled"><span>← Previous</span></li>
                                @else
                                    <li><a href="{{ $feedbacks->previousPageUrl() }}" rel="prev">← Previous</a></li>
                                @endif
                                @foreach ($feedbacks as $element)
                                    @if (is_string($element))
                                        <li class="disabled"><span>{{ $element }}</span></li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $feedbacks->currentPage())
                                                <li class="active my-active"><span>{{ $page }}</span></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                @if ($feedbacks->hasMorePages())
                                    <li><a href="{{ $feedbacks->nextPageUrl() }}" rel="next">Next →</a></li>
                                @else
                                    <li class="disabled"><span>Next →</span></li>
                                @endif
                            </ul>
                        @endif

                    </div>

                </div>

            </div>




        </div>
    </div>

    </div>
@endsection
