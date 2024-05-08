@extends('backoffice.layout.app')

@section('title', 'RMS')

@section('content')


    @include('backoffice.layout.topBar')
    @include('backoffice.layout.sideBar')


    {{-- user list  --}}

    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4>Daily Reports</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All Reports</a></li>
                                <li class="breadcrumb-item active">Daily Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title text-center fs-3">Daily Reports</h4>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fs-5 mt-3">
                                            <strong> Employee Name :</strong>
                                            <span>
                                                {{ $user->name }}
                                            </span>
                                        </p>

                                        <p class="fs-5 ">
                                            <strong> Team :</strong>
                                            <span>
                                                {{ $user->team }}
                                            </span>
                                        </p>
                                        @php
                                            $date = null;
                                            if (
                                                isset($daily_reports) &&
                                                !empty($daily_reports) &&
                                                isset($daily_reports[0]->day_start_time)
                                            ) {
                                                $date = \Carbon\Carbon::parse($daily_reports[0]->date)->format('Y-m-d');
                                            }
                                        @endphp


                                        <p class="fs-5">
                                            <label class="form-label" for="formrow-email-input">Date : </label>
                                            <input type="date" class="form-control" name="" id="date-report"
                                                value="{{ $date }}" data-user_id="{{ $user->id }}" required>

                                        </p>

                                    </div>
                                    <div class="">
                                        <p class="fs-5 mt-3"><strong> Day Start :
                                            </strong><span id="day-start">
                                                @if (isset($daily_reports) && !empty($daily_reports) && isset($daily_reports[0]->date))
                                                    {{ \Carbon\Carbon::parse($daily_reports[0]->day_start_time)->format('h:i A') }}
                                                @endif
                                            </span>

                                        </p>
                                        <p class="fs-5">
                                            <strong> Day End :</strong>
                                            <span id="day-end">
                                                @if (isset($daily_reports) && !empty($daily_reports) && isset($daily_reports[0]->day_end_time))
                                                    {{ \Carbon\Carbon::parse($daily_reports[0]->day_end_time)->format('h:i A') }}
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap">#</th>
                                                    <th class="text-nowrap">Start Time</th>
                                                    <th class="text-nowrap">End Time</th>
                                                    <th class="text-nowrap">Total Time</th>
                                                    <th class="text-nowrap">Work Type</th>
                                                    <th class="text-nowrap">Work Title</th>
                                                    <th class="text-nowrap">Work Details</th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-body">

                                                @foreach ($daily_reports as $report)
                                                    @php
                                                        $startTime = \Carbon\Carbon::parse($report->start_time);
                                                        $endTime = \Carbon\Carbon::parse($report->end_time);

                                                        $hours = $endTime->diff($startTime)->format('%h');
                                                        $minutes = $endTime->diff($startTime)->format('%i');
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $startTime->format('h:i A') }}</td>
                                                        <td>{{ $endTime->format('h:i A') }}</td>
                                                        <td>{{ $hours }} H : {{ $minutes }} M </td>
                                                        <td style="min-width: 20rem;">{{ $report->work_type }}</td>
                                                        <td class="w-50">{{ $report->work_title }}</td>
                                                        <td class="w-50">{{ $report->work_details }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong>{{ floor($totalMinutes / 60) }}H : {{ $totalMinutes % 60 }}M</strong>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr> --}}

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#date-report').on('change', function(e) {

                var date = $(this).val();
                var user_id = $(this).data('user_id');

                $.ajax({
                    url: 'get-date-wise-report/' + date + '/' + user_id,
                    type: "get",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        $('#table-body').empty();
                        $('#day-start').empty();
                        $('#day-end').empty();
                        var start_time = "-----"
                        var end_time = "-----"

                        if (data) {
                            start_time = moment(data[0].day_start_time, 'HH:mm:ss').format(
                                'h:mm A');

                            end_time = moment(data[0].day_end_time, 'HH:mm:ss').format(
                                'h:mm A');
                        }

                        $('#day-end').append(end_time);
                        $('#day-start').append(start_time);


                        $.each(data, function(index, report) {
                            var formattedStartTime = moment(report.start_time,
                                'HH:mm:ss').format('h:mm A');
                            var formattedEndTime = moment(report.end_time,
                                'HH:mm:ss').format('h:mm A');

                            var startTime = moment(report.start_time, 'HH:mm:ss');
                            var endTime = moment(report.end_time, 'HH:mm:ss');

                            var durationInHours = endTime.diff(startTime, 'hours');
                            var durationInMinutes = endTime.diff(endTime, 'minutes') %
                                60;
                            var newRow = '<tr>' +
                                '<th scope="row">' + (index + 1) + '</th>' +
                                '<td>' + formattedStartTime + '</td>' +
                                '<td>' + formattedEndTime + '</td>' +
                                '<td>' + durationInHours + ' H ' + durationInMinutes +
                                ' M</td>' +
                                '<td>' + report.work_title + '</td>' +
                                '<td>' + report.work_details + '</td>' +
                                '</tr>';

                            $('#table-body').append(newRow);
                        });

                    }
                });
            });
        });
    </script>

<script>
    
</script>
