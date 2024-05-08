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
                            <h4>User profile</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item active">User profile</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal"
                            data-bs-target="#updateModal">Update profile</button>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="user_profile">
                                        <img src="{{ auth()->user()->image }}" alt="img"
                                            style="width: 100px;height:auto"><br>
                                        <label for=""
                                            class="mt-3 fs-3 form-label">{{ auth()->user()->name }}</label><br>
                                        <label for="" class="fs-5 form-label">{{ auth()->user()->email }}</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="user_profile">
                                        <p class="fs-5"><i class="mdi mdi-key-variant fs-3 mt-2"
                                                style="color: #796EBD"></i> You can change your password</p>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#changePassword">Change password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>

            </div>
        </div>
    </div>



    <!-- start day modal content -->
    <div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Updadte User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('update.user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <label for="formFile" class="form-label">User image<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="file" accept="image/*" id="user_img" name="image">
                                @error('user_img')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label for="formFile" class="form-label">User name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_name" name="name"
                                    value="{{ auth()->user()->name }}">
                                @error('user_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label for="formFile" class="form-label">User email<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="user_email" name="email"
                                    value="{{ auth()->user()->email }}">
                                @error('user_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div> <!-- end row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->


    {{-- change password modal  --}}
    <div id="changePassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Change Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('update.password') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label for="formFile" class="form-label">New password<span class="text-danger">*</span></label>
                            <input class="form-control" type="password" id="" name="password"
                                value="">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label for="formFile" class="form-label">Confirm password<span class="text-danger">*</span></label>
                            <input class="form-control" type="password" id="" name="password_confirmation"
                                value="">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div> <!-- end row -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
            </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
@endsection
@push('scripts')
    <script>
        function upload() {
            var fileinput = document.getElementById("finput");
            var userImage = document.getElementById("userImage");

            if (fileinput.files && fileinput.files[0]) {
                userImage.src = URL.createObjectURL(fileinput.files[0]);
            } else {
                fetch('/user/image')
                    .then(response => response.json())
                    .then(data => userImage.src = data.url)
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
@endpush
