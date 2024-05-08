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
                            <h4>System Users</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Users</a></li>
                                <li class="breadcrumb-item active">All Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal"
                    data-bs-target="#myModal">Create User</button>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="overflow: auto;">
                            <div class="card-body">

                                <h4 class="card-title text-center fs-3">All Users</h4>

                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Team</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td><img src="{{$user->image}}" class="rounded-circle header-profile-user"  alt="img" ></td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roleName}}</td>
                                            <td>{{$user->team}}</td>
                                            <td>
                                                <div>
                                                    <a href="" data-user = '{{$user}}'  data-bs-toggle="modal" data-bs-target="#editMyModal" class="edit_user">
                                                        <i class="mdi mdi-account-edit-outline" style="background: green;padding: 3px;color: white;font-size: 15px;cursor: pointer;border-radius: 3px;"></i>
                                                    </a>
                                                    
                                                    <a id="sa-params" href="javascript:void(0);" onclick="confirmDelete('{{ route('user-delete', ['id' => encrypt($user->id)]) }}')">
                                                        <i class="mdi mdi-delete" style="background: red; padding: 3px; color: white; font-size: 15px; cursor: pointer; border-radius: 3px;"></i>
                                                    </a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                
                <!-- create user modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                    <form action="{{route('create-user')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" >Image</label>
                                            <input class="form-control" type="file" accept="image/*"  name="image">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">User Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Enter user name" name="name" required>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Email<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" 
                                                        placeholder="Enter email" name="email" required>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" 
                                                        placeholder="Enter password" name="password" required>
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">User role<span class="text-danger">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" name="role" required>
                                                        <option selected disabled>--------Select--------</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                        
                                                        
                                                    </select>
                                                    @error('role')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Team<span class="text-danger">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" name="team" required>
                                                        <option selected disabled>--------Select--------</option>
                                                            <option value="Business">Business</option>
                                                            <option value="Designer">Designer</option>
                                                            <option value="Developer">Developer</option>
                                                            <option value="Management">Management</option>
                                                        
                                                    </select>
                                                    @error('team')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Create User</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.modal -->

            

                <!-- edit user modal content -->
                <div id="editMyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Edit User
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{route('user-update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="user_id" name="id" >
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label" >Image</label>
                                            <input class="form-control" type="file" accept="image/*" id="user_img" name="image">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">User Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="user_name"
                                                        placeholder="Enter user name" name="name" required>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Email<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="user_email"
                                                        placeholder="Enter email" name="email" required>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">New Password </label>
                                                    <input type="password" class="form-control" id="user_pass"
                                                        placeholder="Enter password" name="password">
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">User role<span class="text-danger">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" id="user_role" name="role" required>
                                                        <option selected disabled>--------Select--------</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                        
                                                        
                                                    </select>
                                                    @error('role')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Team<span class="text-danger">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" name="team" id="user_team" required>
                                                        <option selected disabled>--------Select--------</option>
                                                            <option value="Business">Business</option>
                                                            <option value="Designer">Designer</option>
                                                            <option value="Developer">Developer</option>
                                                            <option value="Management">Management</option>
                                                        
                                                    </select>
                                                    @error('team')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update User</button>
                            </div>
                        </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.edit_user').on('click', function(e){
                var user = $(this).data('user');
                $('#user_img').val('');

                $('#user_id').val(user.id);
                $('#user_name').val(user.name);
                $('#user_email').val(user.email);
                $('#user_role').val(user.role);
                $('#user_team').val(user.team);
            });
        });
    </script>
@endpush



