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
        {{-- {{dd($logs)}} --}}
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4>Employee Report</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item active">Employees Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
                @php
                    use App\Models\EmployeeReport;
                    $user_id = auth()->user()->id;

                    $data = EmployeeReport::where('user_id', $user_id)->where('is_closed', 0)->first();
                @endphp

                <?php
                    if(!$data){
                ?>
                <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal"
                    data-bs-target="#startDayModal">Day Start</button>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title text-center fs-3">Report Logs</h4>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fs-5 mt-3"><strong> Employee Name :
                                            </strong><span>{{ auth()->user()->name }}</span></p>
                                        <p class="fs-5 mt-3"><strong> Team :
                                            </strong><span>{{ auth()->user()->team }}</span></p>
                                    </div>
                                    <div>
                                        <p class="fs-5 mt-3"><strong> Date : </strong>
                                        </p>
                                        <p class="fs-5"><strong> Day Start : </strong></p>

                                    </div>
                                </div>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th data-priority="1">Start Time</th>
                                                    <th data-priority="1">End Time</th>
                                                    <th data-priority="2">Work Title</th>
                                                    <th data-priority="2">Work Details</th>
                                                    <th data-priority="1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <?php
                    }
                    else{
                ?>

                <!-- end page title -->
                <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal"
                    data-bs-target="#addLogModal">Create Log</button>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="dayEndForm" action="{{ route('day-end-report') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $daily_log->id }}" name='log_id'>
                                    <h4 class="card-title text-center fs-3">Report Logs</h4>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fs-5 mt-3"><strong> Employee Name :
                                                </strong><span>{{ auth()->user()->name }}</span></p>
                                            <p class="fs-5 mt-3"><strong> Team :
                                                </strong><span>{{ auth()->user()->team }}</span></p>
                                        </div>
                                        <div>
                                            <p class="fs-5 mt-3"><strong> Date : </strong><input type="text"
                                                    value="{{ $daily_log->date }}" readonly
                                                    style="border: none;outline:none;width: 100px;" name="date"></span>
                                            </p>
                                            <p class="fs-5"><strong> Day Start : </strong><input type="text"
                                                    value="{{ date('h:i A', strtotime($daily_log->start_time)) }}" readonly
                                                    style="border: none;outline:none;width: 100px;" name="day_start"
                                                    id="day-start"></span></p>

                                        </div>
                                    </div>


                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th data-priority="0">Start Time</th>
                                                        <th data-priority="0">End Time</th>
                                                        <th data-priority="0">Duration</th>
                                                        <th data-priority="0">Work Title</th>
                                                        <th data-priority="0">Work Details</th>
                                                        <th data-priority="0">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($logs as $log)
                                                        <tr>
                                                            <th>{{ $loop->index + 1 }}</th>
                                                            <td><input type="text" name="start_time[]"
                                                                    value="{{ date('h:i A', strtotime($log->start_time)) }}"
                                                                    readonly
                                                                    style="border: none;outline:none;background:none;width:100px">
                                                            </td>

                                                            <td><input type="text" name="end_time[]"
                                                                    value="{{ date('h:i A', strtotime($log->end_time)) }}"
                                                                    readonly
                                                                    style="border: none;outline:none;background:none;width:100px">
                                                            </td>

                                                            <td>
                                                                @php
                                                                    $start = \Carbon\Carbon::parse($log->start_time);
                                                                    $end = \Carbon\Carbon::parse($log->end_time);
                                                                    $hours = $end->diff($start)->format('%h');
                                                                    $minutes = $end->diff($start)->format('%i');
                                                                @endphp
                                                                {{ $hours }} H : {{ $minutes }} M
                                                            </td>

                                                            <td><input type="text" name="work_title[]"
                                                                    value="{{ $log->work_title }}" readonly
                                                                    style="border: none;outline:none;background:none;width:100px">
                                                            </td>

                                                            <td>
                                                                <textarea name="work_details[]" class="textareaHeight" cols="50" style="border: none;background"  readonly>{{ $log->work_details }}</textarea>

                                                                {{-- <input type="text" name="work_details[]"
                                                                    value="{{ $log->work_details }}" readonly
                                                                    style="border: none;outline:none;background:none;width:100px"> --}}

                                                            </td>

                                                            <td>
                                                                <div class="d-flex justify-content-around">
                                                                    <a href="" data-log = '{{ $log }}'
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editLogModal" class="edit_log">
                                                                        <i class="mdi mdi-account-edit-outline"
                                                                            style="background: green;padding: 3px;color: white;font-size: 15px;cursor: pointer;border-radius: 3px; "></i>
                                                                    </a>

                                                                    <a id="delete-log" href="javascript:void(0);"
                                                                        onclick="confirmDelete('{{ route('delete-log', ['id' => encrypt($log->id)]) }}')">
                                                                        <i class="mdi mdi-delete"
                                                                            style="background: red; padding: 3px; color: white; font-size: 15px; cursor: pointer; border-radius: 3px;"></i>
                                                                    </a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        {{-- @php
                                                            echo "<script>
                                                                function auto_grow() {
                                                                    console.log('start');
                                                                    var textarea = document.querySelectorAll('.textareaHeight');

                                                                    textarea.forEach(element => {
                                                                        element.style.width = '2px';
                                                                        element.style.width = (element.scrollHeight / 10) + 'px';
                                                                    });
                                                                    console.log('end');
                                                                }
                                                                auto_grow();
                                                            </script>";
                                                        @endphp --}}
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" type="button" onclick="confirmDayEnd('')">Day
                                            End</button>
                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <?php } ?>
                <!-- start day modal content -->
                <div id="startDayModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Create User
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{ route('day-start') }}" method="post">
                                        @csrf
                                        <div class="">
                                            <label for="formFile" class="form-label">Start Time <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="time" value="10:00"
                                                id="example-time-input" name="start_time">
                                            @error('start-time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Day Start</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->


                <!-- Add log modal content -->
                <div id="addLogModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Create Log
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{ route('create-log') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if ($daily_log)
                                            <input type="hidden" value="{{ $daily_log->id }}" name="log_id">
                                        @endif


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Start Time <span
                                                            class="text-danger">*</span></label>
                                                    <input type="time" class="form-control"
                                                        placeholder="Enter user name" id="log_start" name="start_time"
                                                        required>
                                                    @error('start_time')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">End Time<span
                                                            class="text-danger">*</span></label>
                                                    <input type="time" class="form-control" placeholder="Enter email"
                                                        id="log_end" name="end_time" required>
                                                    @error('end_time')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                        <div class="row mb-2">
                                            <div class="">
                                                <label class="form-label" for="formrow-email-input">Work Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter work title"
                                                    name="work_title" required>
                                                @error('work_title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="">
                                                <label class="form-label" for="formrow-email-input">Work Details<span
                                                        class="text-danger">*</span></label>
                                                <textarea id="textarea" name="work_details" class="form-control" maxlength="225" rows="5"
                                                    placeholder="Write your work details" required></textarea>
                                                @error('work_details')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> <!-- end col -->
                                        </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Create
                                    Log</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->


                <!-- Edit log modal content -->
                <div id="editLogModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Edit Log
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{ route('update-log') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="log_id" id="log_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Start Time <span
                                                            class="text-danger">*</span></label>
                                                    <input type="time" class="form-control"
                                                        placeholder="Enter user name" name="start_time" id="start-time"
                                                        required>
                                                    @error('start_time')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">End Time<span
                                                            class="text-danger">*</span></label>
                                                    <input type="time" class="form-control" placeholder="Enter email"
                                                        name="end_time" id="end-time" required>
                                                    @error('end_time')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                        <div class="row mb-2">
                                            <div class="">
                                                <label class="form-label" for="formrow-email-input">Work Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter work title"
                                                    name="work_title" id="work-title" required>
                                                @error('work_title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="">
                                                <label class="form-label" for="formrow-email-input">Work Details<span
                                                        class="text-danger">*</span></label>
                                                <textarea id="work-details" name="work_details" class="form-control" maxlength="225" rows="5"
                                                    placeholder="Write your work details" required></textarea>
                                                @error('work_details')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> <!-- end col -->
                                        </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update
                                    Log</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script>
        function confirmDayEnd() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, end the day!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('dayEndForm').submit();
                }
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.edit_log').on('click', function(e) {
                var log = $(this).data('log');
                console.log(log);

                $('#log_id').val(log.id);
                $('#start-time').val(log.start_time);
                $('#end-time').val(log.end_time);
                $('#work-title').val(log.work_title);
                $('#work-details').val(log.work_details);
            });
        });
    </script>

    <!-- *******time filtering******* -->
    <script>
        // Event listener for changes in the log start time
        $('#log_start').on('change', function(e) {
            // Get the selected log start time and format it
            var log_start = $(this).val();
            var formattedStartTime = moment(log_start, 'HH:mm').format('HH:mm');

            // Get the day start time and format it
            var day_start = $('#day-start').val();
            var formattedDayStart = moment(day_start, 'hh:mm A').format('HH:mm');

            // Get the log end time and format it
            var log_end = $('#log_end').val();
            var formattedEndTime = moment(log_end, 'HH:mm').format('HH:mm');

            // Error messages
            var day_start_error = 'Please select a time that is not before the day start time (' + day_start + ').';
            var end_time_error = 'Please select a time that is not before the start time.';

            // Validate log start time
            if (moment(formattedStartTime, 'HH:mm') < moment(formattedDayStart, 'HH:mm')) {
                // Display error message and clear log start time
                showError(day_start_error);
                $(this).val('');
            }

            // Validate log end time
            if (log_end && moment(formattedEndTime, 'HH:mm') < moment(formattedStartTime, 'HH:mm')) {
                // Display error message and clear log end time
                showError(end_time_error);
                $('#log_end').val('');
            }
        });
    </script>

    <script>
        // Event listener for changes in the log end time
        $('#log_end').on('change', function(e) {

            // Get the selected log start time and format it
            var log_start = $('#log_start').val();
            var formattedStartTime = moment(log_start, 'HH:mm').format('HH:mm');

            // Get the log end time and format it
            var log_end = $(this).val();
            var formattedEndTime = moment(log_end, 'HH:mm').format('HH:mm');

            var end_time_error = 'Please select a time that is not before the start time.';

            // Validate log start time
            if (log_start && moment(formattedEndTime, 'HH:mm') < moment(formattedStartTime, 'HH:mm')) {
                // Display error message and clear log end time
                showError(end_time_error);
                $('#log_end').val('');
            }
        })
    </script>

    <script>
        // function auto_grow(element) {
        //     element.style.height = "5px";
        //     element.style.height = (element.scrollHeight) + "px";
        // }
        function auto_grow() {
            console.log('start');
            var textarea = document.querySelectorAll('.textareaHeight');

            textarea.forEach(element => {
                element.style.height = "5px";
                element.style.height = (element.scrollHeight) + "px";
            });
            console.log('end');
        }
    </script>
@endpush
