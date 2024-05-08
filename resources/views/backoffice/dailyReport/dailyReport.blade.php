@extends('backoffice.layout.app')

@section('title', 'RMS')

@section('content')


    @include('backoffice.layout.topBar')
    @include('backoffice.layout.sideBar')

    <div class="main-content">
        {{-- {{dd($logs)}} --}}
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4>Daily Report</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All Reports</a></li>
                                <li class="breadcrumb-item active">Daily Report</li>
                            </ol>
                        </div>
                    </div>
                </div>


                {{-- table start  --}}
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title fs-3 text-center mb-3">Daily Report</h4>

                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" value="Business" id="btnradio1"
                                        onclick="getEmployee('Business')" autocomplete="off" checked>
                                    <label class="btn btn-primary" for="btnradio1">Business</label>

                                    <input type="radio" class="btn-check" name="btnradio" value="Designer" id="btnradio2"
                                        onclick="getEmployee('Designer')" autocomplete="off">
                                    <label class="btn btn-primary" for="btnradio2">Designer</label>

                                    <input type="radio" class="btn-check" name="btnradio" value="Developer" id="btnradio3"
                                        onclick="getEmployee('Developer')" autocomplete="off">
                                    <label class="btn btn-primary" for="btnradio3">Developer</label>
                                </div>


                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Team</th>
                                                <th>Report</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            @foreach ($datas as $data)
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td><img src="{{$data->image}}"  alt="img" class="rounded-circle header-profile-user"></td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->team }}</td>
                                                    <td><a href="view-report/{{$data->id}}"><button
                                                                class="btn btn-primary">Report</button></a></td>
                                                    {{-- <td><a href="{{route('view-report',['id'=>encrypt($data->id)])}}"><button
                                                                class="btn btn-primary">Report</button></a></td> --}}
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
        </div>
    </div>

@endsection

@push('scripts')
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        function getEmployee(team) {
            $.ajax({
                url: 'get-employees/' + team,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#table-body').empty();
                    $.each(data, function(index, employee) {
                        var newRow = '<tr>' +
                            '<th scope="row">' + (index + 1) + '</th>' +
                            '<td><img src="' + employee.image + '"  alt="img" class="rounded-circle header-profile-user"></td>' +
                            '<td>' + employee.name + '</td>' +
                            '<td>' + employee.team + '</td>' +
                            '<td><a href="view-report/'+ employee.id +' "><button class="btn btn-primary">Report</button></a></td>'+
                            '</tr>'

                        $('#table-body').append(newRow)
                    });

                }
            });
        }
    </script>
    {{-- '<td><a href="'+"{{route( 'view-report', ['id'=>"+ employee.id + '])}}"><button class="btn btn-primary">Report</button></a></td>' --}}
@endpush
