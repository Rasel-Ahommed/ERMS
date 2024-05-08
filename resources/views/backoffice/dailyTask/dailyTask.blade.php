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
                            <h4>Today work plan</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All Reports</a></li>
                                <li class="breadcrumb-item active">Daily Reports</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row mt-4">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        @if (!$plans)
                            <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal"
                            data-bs-target="#addLogModal">Add Plan</button>
                        @endif
                        @if ($plans)
                            <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal"
                            data-bs-target="#editLogModal" id="edit_plan" data-log="{{$plans}}">Edit Plan</button>
                        @endif
                        
                    </div>
                    <div class="col-lg-2"></div>
                </div>
                
                
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <blockquote class="card-blockquote mb-0">
                                    <h3 class="text-center mb-3">Today Work Plan</h3>
                                    <h5>Date : {{ \Carbon\Carbon::now()->format('d-M-Y') }}</h5>
                                    <div class="text-white font-size-15 mt-0 mb-0">
                                        @if ($plans)
                                            {!!$plans->plan_dtls!!}
                                        @endif
                                        
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>



                {{-- today plan modal  --}}
                <!-- Add plan modal content -->
                <div id="addLogModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Create Work Plan
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{route('add.today.plan')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                       

                                        <div class="row">
                                            <div class="">
                                                <label class="form-label" for="formrow-email-input">Work Plan<span
                                                        class="text-danger">*</span></label>
                                                <textarea id="workDetails" name="today_plan" class="form-control" maxlength="225" rows="5"
                                                    placeholder="Write your work details" required></textarea>
                                                @error('today_plan')
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
                                    Plan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal -->




                <!-- edit plan modal content -->
                <div id="editLogModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">Update Work Plan
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="{{route('update.today.plan')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                       
                                        <input type="hidden" id="id" name="id">
                                        <div class="row">
                                            <div class="">
                                                <label class="form-label" for="formrow-email-input">Work Plan<span
                                                        class="text-danger">*</span></label>
                                               
                                            </div> <!-- end col -->
                                                <textarea id="editText" name="update_plan" class="form-control" maxlength="225" rows="5"
                                                    placeholder="Write your work details" required>
                                                </textarea>
                                                @error('update_plan')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror          </div>
                                </div> <!-- end row -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update
                                    Plan</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        CKEDITOR.replace('workDetails');
        CKEDITOR.replace('editText');
    </script>

    <script>
        $('#edit_plan').on('click',function(){
            let data = $(this).data('log');
            $('#id').val('');

            let id = $('#id').val(data.id);
            CKEDITOR.instances['editText'].setData(data.plan_dtls);
        })
    </script>
@endpush