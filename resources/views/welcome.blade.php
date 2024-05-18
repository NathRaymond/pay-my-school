@extends('layouts.master')

@section('body')
        <!--Content Header (Page header)-->
        <div class="content-header row align-items-center m-0">
            <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
                <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
            <div class="col-sm-8 header-title p-0">
                <div class="media">
                    <div class="header-icon text-success mr-3"><i class="typcn typcn-spiral"></i></div>
                    <div class="media-body">
                        <h1 class="font-weight-bold">Dashboard</h1>
                        <small>From now on you will start your activities.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fs-17 font-weight-600 mb-0">Pie Chart</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" class="action-item"><i class="ti-reload"></i></a>
                                    <div class="dropdown action-item" data-toggle="dropdown">
                                        <a href="#" class="action-item"><i class="ti-more-alt"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item">Refresh</a>
                                            <a href="#" class="dropdown-item">Manage Widgets</a>
                                            <a href="#" class="dropdown-item">Settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart mb-3">
                            <canvas id="doughutChart" height="310"></canvas>
                        </div>
                        <div class="chart-legend">
                            <div class="chart-legend-item">
                                <div class="chart-legend-color kelly-green"></div>
                                <p>From Google</p>
                                <p class="percentage text-muted">63.259 %</p>
                            </div>
                            <div class="chart-legend-item">
                                <div class="chart-legend-color kelly-green2"></div>
                                <p>Your Website</p>
                                <p class="percentage text-muted">25.321 %</p>
                            </div>
                            <div class="chart-legend-item">
                                <div class="chart-legend-color whisper"></div>
                                <p>Others</p>
                                <p class="percentage text-muted">11.42 %</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.body content-->

@endsection
