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
                            <h4>Monthly Reports</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All Reports</a></li>
                                <li class="breadcrumb-item active">Monthly Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="overflow: auto;">

                                <h4 class="card-title text-center fs-3">Monthly Reports</h4>
                                <form action="{{ route('get-monthly-report') }}" method="post">
                                    @csrf
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-md-6 ">
                                            <label class="form-label" for="formrow-email-input">Start Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="start_date"
                                                value={{ old('start_date') }} required>
                                            @error('start_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formrow-email-input">End Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="end_date"
                                                value={{ old('end_date') }} required>
                                            @error('end_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="row justify-content-center mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label" for="formrow-email-input">Team<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Default select example" name="team"
                                                id="team" required value={{ old('team') }}>
                                                <option selected disabled class="text-center">
                                                    --------------Select--------------</option>
                                                <option value="Business">Business</option>
                                                <option value="Designer">Designer</option>
                                                <option value="Developer">Developer</option>

                                            </select>
                                            @error('team')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="formrow-email-input">Employee Name<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="employee_id" id="employee" required value={{ old('employee') }}>
                                                <option selected disabled class="text-center">
                                                    --------------Select--------------</option>

                                            </select>
                                            @error('employee')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-end mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Get
                                            Reports</button>
                                    </div>
                                </form>

                                <div style="overflow: auto;">
                                    <button class="btn btn-primary" onclick="printTable()">Print Report</button>


                                    <table id="datatable-buttons" style="overflow: auto;"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Team</th>
                                                <th>Date</th>
                                                <th>Work Time</th>
                                                <th>Daily Report</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $totalMinutes = 0;
                                                $reports = session()->get('reports');
                                            @endphp



                                            @if (isset($reports))

                                                @foreach ($reports as $report)
                                                    @php
                                                        $startTime = \Carbon\Carbon::parse($report->start_time);
                                                        $endTime = \Carbon\Carbon::parse($report->end_time);
                                                        $timeDiffInMinutes = $startTime->diffInMinutes($endTime);
                                                        $totalMinutes += $timeDiffInMinutes;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $report->user_name }}</td>
                                                        <td>{{ $report->team }}</td>
                                                        <td>{{ $report->date }}</td>
                                                        <td>{{ $startTime->diff($endTime)->format('%H:%I') }}</td>

                                                        <td><button class="btn btn-primary daily-report"
                                                                data-log_id ="{{ $report->id }}" data-bs-toggle="modal"
                                                                data-bs-target=".bs-example-modal-xl">view</button></td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>Total Working Time : </strong></td>
                                            <td><strong>{{ floor($totalMinutes / 60) }}H :
                                                    {{ $totalMinutes % 60 }}M</strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                        @endif
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


    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Daily Log Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <h4 id="employee-name" class="text-center"></h4>
                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <p><strong>Day Start Time : </strong><span id="day-start"></span></p>
                            <p><strong>Day ENd Time : </strong><span id="day-end"></span></p>
                        </div>
                        <div>
                            <p><strong>Date : </strong><span id="log-date"></span></p>

                        </div>

                    </div>
                    <div style="overflow: auto">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Work type</th>
                                    <th>Work Title</th>
                                    <th>Work Details</th>

                                </tr>
                            </thead>

                            <tbody id="table-body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#team').on('change', function(e) {
                var team = $(this).val();

                $.ajax({
                    url: 'team-employees/' + team,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#employee').empty();

                        $('#employee').append(
                            '<option selected disabled class="text-center">--------------Select--------------</option>'
                        );

                        $.each(data, function(index, employee) {
                            var newOption =
                                '<option value="' + employee.id + '">' + employee.name +
                                '</option>'

                            $('#employee').append(newOption)
                        });
                    }
                })
            });
        });
    </script>

    <script>
        $('.daily-report').on('click', function(e) {
            ;
            var log_id = $(this).data('log_id');
            console.log(log_id);

            $.ajax({
                url: 'month-daily-log/' + log_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#table-body').empty();

                    $('#employee-name').empty();

                    $('#day-start').empty();

                    $('#day-end').empty();

                    $('#log-date').empty();

                    $('#employee-name').append(data[0].user_name);

                    // formate start time 
                    var formattedTime = moment(data[0].day_start_time, 'HH:mm:ss').format('h:mm A');
                    $('#day-start').append(formattedTime);

                    // formate end time 
                    var formattedTime = moment(data[0].day_end_time, 'HH:mm:ss').format('h:mm A');
                    $('#day-end').append(formattedTime);

                    // date 
                    $('#log-date').append(data[0].date);

                    $.each(data, function(index, dailyLog) {
                        console.log(dailyLog);
                        var formattedStartTime = moment(dailyLog.start_time, 'HH:mm:ss').format(
                            'h:mm A');
                        var formattedEndTime = moment(dailyLog.end_time, 'HH:mm:ss').format(
                            'h:mm A');

                        var newRow = '<tr>' +
                            '<th scope="row">' + (index + 1) + '</th>' +
                            '<td>' + formattedStartTime + '</td>' +
                            '<td>' + formattedEndTime + '</td>' +
                            '<td>' + dailyLog.work_type_name + '</td>' +
                            '<td>' + dailyLog.work_title + '</td>' +
                            '<td>' + dailyLog.work_details + '</td>' +
                            '</tr>';

                        $('#table-body').append(newRow);
                    });

                }
            })
        });






        // Function to print the table
    function printTable() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>TRANSACTION REPORT RECEIPT</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
        printWindow.document.write('</head><body>');

        var dynamicHTML = generateHTML(); // Get additional HTML content
        var tableHTML = document.getElementById('datatable-buttons').outerHTML;

        tableHTML = tableHTML.replace(/<th[^>]*>Daily Report<\/th>/g, '');
        tableHTML = tableHTML.replace(/<td><button[^>]*>view<\/button><\/td>/g, '');
        // var replacementHTML = '<strong>New Content</strong>';
        tableHTML = tableHTML.replace(/<td>(.*?)<\/td>[^<]*<\/tr>[^<]*<\/tbody>[^<]*<\/table>/g, '');
        // console.log(tableHTML);

        // Replace the placeholder with the table HTML
        dynamicHTML = dynamicHTML.replace('<div id="stockTable"></div>', tableHTML);

        // Write combined HTML to print window document
        printWindow.document.write(dynamicHTML);

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

    function generateHTML() {
        return `
            <div class="container">
                <div id="print" xmlns:margin-top="http://www.w3.org/1999/xhtml">
                    <table width="100%">
                        <tr>
                            <td style="text-align: center;">
                                <strong><span style="font-size: 40px;">Unicorn software and Solution Ltd.</span></strong><br />
                                
                                <br /> <br />
                                <span style="color: #000; font-weight: bold; font-size: 25px;">MONTHLY REPORT FOR <span style="text-transform: uppercase;">{{session('user_name')}}</span></span>
                            </td>
                        </tr>
                    </table>
                    <div style="position: relative;  text-align: center; ">
                        <img src="{{ asset('RMS/assets/logo/unicorn-favicon.png') }}"
                                    style="max-width: 500px; max-height:600px; margin-top: 60px; position:absolute ; opacity: 0.1; margin-left: auto;margin-right: auto; left: 0; right: 0;" />
                    </div>
                    <div class="table-responsive">
                        <br>
                        <br>
                        <br>
                        <div id="stockTable"></div>
                    </div>
                </div>
            </div>
        `;
    }
    </script>



    
@endpush
