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
<!--/.Content Header (Page header)-->
<div class="body-content">
    <center>
        <h3>WELCOME BACK<span class="text-success"> {{ $user->name }}!</span></h3>
    </center><br>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-device-tablet"></i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Current Session</p>
                    <h3 class="card-title fs-18 font-weight-bold">
                        <div class="dash-counts">
                            <p>{{$currentsession->description}}</p>
                        </div>
                    </h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <i class="typcn typcn-warning text-warning mr-2"></i>
                        <a href="#" class="warning-link">Get More Space...</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-home-outline"></i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Revenue</p>
                    <h3 class="card-title fs-15 font-weight-bold">
                        @if($currentsession)
                        <p>Income for Current Term: {{ $currentTermIncome }}</p>
                        <p>Income for Current Session: {{ $currentSessionIncome }}</p>
                        @else
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                No active session.
                            </div>
                        </div>
                        @endif
                    </h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <i class="typcn typcn-calendar-outline mr-2"></i>Last 24 Hours
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-info card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Outstanding</p>
                    <h3 class="card-title fs-15 font-weight-bold">
                        @if($currentsession)
                        <p>Outstanding payment for Term: {{ $currentTermOutstanding }}</p>
                        @else
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                No active session.
                            </div>
                        </div>
                        @endif
                    </h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <i class="typcn typcn-upload mr-2"></i>Just Updated
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div
                    class="card-header card-header-danger card-header-icon position-relative border-0 text-right px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-info-outline"></i>
                    </div>
                    <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Number of Students</p>
                    <h3 class="card-title fs-21 font-weight-bold">
                        <div class="dash-counts">
                            <p>{{$totalstudent}}</p>
                        </div>
                    </h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <i class="typcn typcn-social-githu mr-2b"></i>Tracked from Github
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Recent Activities</h6>
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
                    <div class=table-responsive>
                        <!--<table class="table table-sm table-nowrap card-table">-->
                        <table class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>New Session Commence</th>
                                    <th>Upcoming Events</th>
                                    <th>Extracurricular Activities</th>
                                    <th>Exams/Assessments</th>
                                    <th>Annoucements</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    
                                    </td>
                                    <td></td>
                                </tr>
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
<!--/.body content-->

@endsection