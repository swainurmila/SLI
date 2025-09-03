@extends('Eoffice.admin.layouts.page-layouts.main')

@section('styles')
    <style>
        .fc-event-title {
            color: blue;
        }

        .fc-event {
            background-color: yellow;
        }

        .fc-event-start {
            border-left-color: green;
        }

        .fc-event-end {
            border-right-color: red;
        }

        .fc-event-past {
            opacity: 0.5;
        }

        .fc-daygrid-event {
            background-color: orange;
        }

        .fc-daygrid-dot-event {
            background-color: lavender;
        }
    </style>
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active text-custom-primary">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">

                {{-- @if (Auth::guard('officer')->user()->role_id != 5 && Auth::guard('officer')->user()->login_for != 'appointment')
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                                </div>
                                <div>
                                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $total_file }}</span></h4>
                                    <p class="text-muted mb-0">Total File</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <div
                    class="col-md-6  {{ Auth::guard('officer')->user()->role_id != 5 && Auth::guard('officer')->user()->login_for != 'appointment' ? 'col-xl-3' : 'col-xl-3' }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span
                                        data-plugin="counterup">{{ count(@$approved_appointment) }}</span></h4>
                                <p class="text-muted mb-0">Appointment Approved</p>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col-->

                <div
                    class="col-md-6 {{ Auth::guard('officer')->user()->role_id != 5 && Auth::guard('officer')->user()->login_for != 'appointment' ? 'col-xl-3' : 'col-xl-3' }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span
                                        data-plugin="counterup">{{ count(@$pending_appointment) }}</span></h4>
                                <p class="text-muted mb-0">Appointment Pending</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div
                    class="col-md-6 {{ Auth::guard('officer')->user()->role_id != 5 && Auth::guard('officer')->user()->login_for != 'appointment' ? 'col-xl-3' : 'col-xl-3' }}">

                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="growth-chart" data-colors='["--bs-warning"]'></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span
                                        data-plugin="counterup">{{@$rejected_appointment}}</span></h4>
                                <p class="text-muted mb-0">Appointment Rejected</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div
                    class="col-md-6 {{ Auth::guard('officer')->user()->role_id != 5 && Auth::guard('officer')->user()->login_for != 'appointment' ? 'col-xl-3' : 'col-xl-3' }}">

                    <div class="card">
                        <div class="card-body">
                            <div class="float-end mt-2">
                                <div id="growth-chart" data-colors='["--bs-warning"]'></div>
                            </div>
                            <div>
                                <h4 class="mb-1 mt-1"><span
                                        data-plugin="counterup">{{ count(@$expired_appointment) }}</span></h4>
                                <p class="text-muted mb-0">Appointment Expired</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->

            @if (!auth()->guard('officer')->user()->hasRole('Eoffice Admin'))
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Appointment</h4>

                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif




            <!-- Bootstrap Modal -->
            <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="eventDetails">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    {{-- </div> --}}
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                customButtons: {
                    currentMonthButton: {
                        text: 'Current Month',
                        click: function() {
                            calendar
                                .today(); // This will navigate to the current date, same as 'today' button
                        }
                    }
                },
                buttonText: {
                    today: 'Current Month'
                },
                eventContent: function(info) {
                    return {
                        html: '<strong>' + info.event.title + '</strong>'
                    };
                },

                eventDidMount: function(info) {
                    // Set background color of the event element
                    info.el.style.backgroundColor = info.event.backgroundColor;
                    info.el.style.color = info.event.textColor;
                },
                eventClick: function(info) {
                    // Prevent the default browser action
                    info.jsEvent.preventDefault();


                    var eventDetails = info.event.extendedProps.details;



                    var startDate = new Date(info.event.start);
                    var formattedStartDate = startDate.toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    var approvedFormDate = eventDetails.approved_date;
                    var eventDetails = info.event.extendedProps.details;
                    var requestedName = eventDetails.requested_form;
                    var requestedTo = eventDetails.user_name;
                    var purpose = eventDetails.purpose;
                    var meeting_start_time = eventDetails.start_time ;
                    // Set the title and details in the modal
                    document.getElementById('eventDetailsModalLabel').textContent = info.event.title;
                    document.getElementById('eventDetails').innerHTML = 'Requested Name: ' +
                        requestedName + '<br>' +
                        'Requested To: ' + requestedTo + '<br>' +
                        'Purpose: ' + purpose + '<br>' +
                        'Meeting Date: ' + formattedStartDate + '<br>' +
                        'Visiting Date: '+ approvedFormDate + '<br>' +
                        'Meeting Start Time: ' + meeting_start_time + '<br>';

                    // Show the modal
                    var myModal = new bootstrap.Modal(document.getElementById('eventDetailsModal'), {
                        keyboard: true
                    });
                    myModal.show();
                }
            });
            calendar.render();
        });
    </script>
@endsection
