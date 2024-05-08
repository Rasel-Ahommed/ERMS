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
                            <h4>Daily Plan Reports</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">My Reports</a></li>
                                <li class="breadcrumb-item active">Daily Plan Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="overflow: auto;">

                                <h4 class="card-title text-center fs-3">My Daily Plan Report List</h4>
                                <form action="{{ route('get-my-plan-report') }}" method="post">
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

                                    <div class="text-end mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Get
                                            Reports</button>
                                    </div>
                                </form>
                                
                                @php
                                    $my_plan_reports = session()->get('my_plan_reports');
                                @endphp

                                <div style="overflow: auto;">
                                   
                                    <table id="datatable-buttons" style="overflow: auto;"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Team</th>
                                                <th>Date</th>
                                                <th>Work Plan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if (isset($my_plan_reports))
                                            @foreach ($my_plan_reports as $my_plan_report)  
                                                <tr>
                                                    <td class="text-end">{{$loop->index+1}}</td>
                                                    <td>{{$my_plan_report->user_name}}</td>
                                                    <td>{{$my_plan_report->team}}</td>
                                                    <td>{{$my_plan_report->date}}</td>
                                                    <td>{!!$my_plan_report->plan_dtls!!}</td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    {{-- <script>
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
    </script> --}}

    {{-- <script>
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
    </script> --}}
@endpush
