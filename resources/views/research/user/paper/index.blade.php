@extends('research.layouts.main')
@section('styles')
    <style>
        .hot-news {
            display: flex;
            width: 100%;
            align-items: center;
            /* flex-flow: row wrap; */
            margin: 0px 0px;
            box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
            justify-content: space-between;
            border: 0px solid #55cb94;
            /* border-left: none; */
            /* border-right: none; */
            background-color: #000;
        }

        .left_head {
            width: 20%;
            background: #5ba903;
            padding: 8px 10px;
            text-align: center;
            color: #fff;
            text-transform: capitalize;
        }

        .right_marq {
            width: 87%;
            line-height: inherit;
        }

        .apply-now {
            /* -webkit-animation: pulse 400ms infinite alternate; */
            animation: pulse 400ms infinite alternate;
            cursor: pointer;
            padding: 2px 8px;
            width: 50px;
            border-radius: 12px;
            font-size: 12px;
            margin-left: 14px;
            /* font-weight: 600; */
            color: #fff;
            text-align: center;
            height: 19px;
            line-height: 14px;
            background-color: #a50000;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="hot-news" style="color:white; font-size: 15px; padding:0px 0px;margin-bottom:10px">
                <div class="left_head"> Paper Submission Dates <br>{{ date('Y') . '-' . date('Y') + 1 }}</div>
                <div class="right_marq">
                    @if (!$notifications->isEmpty())
                        <marquee style="margin-top: 5px" scrollamount="3"
                            onmouseout="this.setAttribute('scrollamount', 3, 0);this.start();"
                            onmouseover="this.setAttribute('scrollamount', 0, 0);this.stop();">
                            @foreach ($notifications as $key => $notification)
                                <b> &nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;

                                    <span>
                                        {{@$notification->notification_title}}
                                        ( {{@$notification->start_date  }} - {{  @$notification->end_date }} )
                                    </span><a href="{{ route('research.admin.paper.create') }}"><span class="apply-now">Submit
                                            Paper</span></a>
                                </b>
                            @endforeach
                        </marquee>
                    @else
                        <p>NO ANNOUNCEMENTS FOUND</p>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Papers</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Nav tabs -->
                                <!-- Tab panes -->
                                <div class="table-responsive">
                                    <table id="user_paper_table" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>Paper Title</th>
                                                <th>Subject Category</th>
                                                <th>Publish</th>
                                                <th>Certificate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($submittedPapers as $key => $paper)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{@$paper->paper_title}}</td>
                                                    <td>{{@$paper->subject_category}}</td>
                                                    <td>{{@$paper->is_publish == 0 ? 'No' : 'Yes'}}</td>
                                                    <td>{{@$paper->issue_certificate == 0 ? 'No' : 'Yes'}}</td>
                                                    <td>
                                                        @if (@$paper->issue_certificate == 1)
                                                            <a href="{{route('research.admin.certificate.download',@$paper->id)}}"
                                                            class="btn custom-btn btn-sm">Download Certificate</a>
                                                        @else
                                                        ---
                                                        @endif
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
    <script>
        $(document).ready(function() {
            $('#user_paper_table').DataTable();
        });
    </script>
@endsection
