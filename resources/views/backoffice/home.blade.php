@extends('backoffice.layout.app')

@section('title', 'RMS')

@section('content')


@include('backoffice.layout.topBar')
@include('backoffice.layout.sideBar')
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
                                    <h4>Dashboard</h4>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">RMS</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                            <div>
                                <h1 style="font-family: system-ui">Welcome back {{auth()->user()->name}}</h1>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="state-information d-none d-sm-block">
                                    <div class="state-graph">
                                        <div id="header-chart-1" data-colors='["--bs-primary"]'></div>
                                        <div class="info">Balance $ 2,317</div>
                                    </div>
                                    <div class="state-graph">
                                        <div id="header-chart-2" data-colors='["--bs-info"]'></div>
                                        <div class="info">Item Sold 1230</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card mini-stat bg-primary">
                                    <div class="card-body mini-stat-img">
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-cube-outline float-end"></i>
                                        </div>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mb-3 font-size-16 text-white">Orders</h6>
                                            <h2 class="mb-4 text-white">1,587</h2>
                                            <span class="badge bg-info"> +11% </span> <span class="ms-2">From previous
                                                period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card mini-stat bg-primary">
                                    <div class="card-body mini-stat-img">
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-buffer float-end"></i>
                                        </div>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mb-3 font-size-16 text-white">Revenue</h6>
                                            <h2 class="mb-4 text-white">$46,782</h2>
                                            <span class="badge bg-danger"> -29% </span> <span class="ms-2">From previous
                                                period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card mini-stat bg-primary">
                                    <div class="card-body mini-stat-img">
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-tag-text-outline float-end"></i>
                                        </div>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mb-3 font-size-16 text-white">Average Price</h6>
                                            <h2 class="mb-4 text-white">$15.9</h2>
                                            <span class="badge bg-warning"> 0% </span> <span class="ms-2">From previous
                                                period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card mini-stat bg-primary">
                                    <div class="card-body mini-stat-img">
                                        <div class="mini-stat-icon">
                                            <i class="mdi mdi-briefcase-check float-end"></i>
                                        </div>
                                        <div class="text-white">
                                            <h6 class="text-uppercase mb-3 font-size-16 text-white">Product Sold</h6>
                                            <h2 class="mb-4 text-white">1890</h2>
                                            <span class="badge bg-info"> +89% </span> <span class="ms-2">From previous
                                                period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">

                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Monthly Earnings</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-6">
                                                <h5 class="font-size-20">$56241</h5>
                                                <p class="text-muted">Marketplace</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-20">$23651</h5>
                                                <p class="text-muted">Total Income</p>
                                            </div>
                                        </div>

                                        <div id="morris-donut-example"
                                            data-colors='["#f0f1f4","--bs-primary","--bs-info"]'
                                            class="morris-charts morris-charts-height" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Email Sent</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="font-size-20">$ 89425</h5>
                                                <p class="text-muted">Marketplace</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="font-size-20">$ 56210</h5>
                                                <p class="text-muted">Total Income</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="font-size-20">$ 8974</h5>
                                                <p class="text-muted">Last Month</p>
                                            </div>
                                        </div>

                                        <div id="morris-area-example" data-colors='["#f0f1f4","--bs-primary","--bs-info"]'
                                            class="morris-charts morris-charts-height" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Monthly Earnings</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-6">
                                                <h5 class="font-size-20">$ 2548</h5>
                                                <p class="text-muted">Marketplace</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-20">$ 6985</h5>
                                                <p class="text-muted">Total Income</p>
                                            </div>
                                        </div>

                                        <div id="morris-bar-stacked" data-colors='["--bs-info","#f0f1f4"]'
                                            class="morris-charts morris-charts-height" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}
                        <!-- end row -->



                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

 
@endsection
