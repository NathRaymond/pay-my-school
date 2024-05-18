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
<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Recent Orders</h6>
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
                        <table id="datatable-buttons" class="table display table-bordered table-striped table-hover bg-white m-0 card-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Street Address</th>
                                    <th>% Share</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="avatar-group">
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Melissa Ayre">
                                                <img src="assets/dist/img/avatar-1.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Karen Robinson">
                                                <img src="assets/dist/img/avatar-2.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Miyah Myles">
                                                <img src="assets/dist/img/avatar-3.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Daniela Dewitt">
                                                <img src="assets/dist/img/avatar-4.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                        </div>
                                    </td>
                                    <td>Naeem Khan</td>
                                    <td>123 456 7890</td>
                                    <td>294-318 Duis Ave</td>
                                    <td>
                                        <div class="sparkline1"></div>
                                    </td>
                                    <td>Noakhali</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-group">
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Miyah Myles">
                                                <img src="assets/dist/img/avatar-3.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Daniela Dewitt">
                                                <img src="assets/dist/img/avatar-2.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                        </div>
                                    </td>
                                    <td>Tuhin Sarkar</td>
                                    <td>123 456 7890</td>
                                    <td>680-1097 Mi Rd.</td>
                                    <td>
                                        <div class="sparkline2"></div>
                                    </td>
                                    <td>Lavoir</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-group">
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Karen Robinson">
                                                <img src="assets/dist/img/avatar-2.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Miyah Myles">
                                                <img src="assets/dist/img/avatar-3.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Daniela Dewitt">
                                                <img src="assets/dist/img/avatar-4.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                        </div>
                                    </td>
                                    <td>Tanjil Ahmed</td>
                                    <td>456 789 1230</td>
                                    <td>Ap #289-8161 In Avenue</td>
                                    <td>
                                        <div class="sparkline3"></div>
                                    </td>
                                    <td>Dhaka</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-group">
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Melissa Ayre">
                                                <img src="assets/dist/img/avatar-1.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Karen Robinson">
                                                <img src="assets/dist/img/avatar-2.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Daniela Dewitt">
                                                <img src="assets/dist/img/avatar-4.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                        </div>
                                    </td>
                                    <td>Sourav</td>
                                    <td>789 123 4560</td>
                                    <td>226-4861 Augue. St.</td>
                                    <td>
                                        <div class="sparkline4"></div>
                                    </td>
                                    <td>Rongpur</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-group">
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Melissa Ayre">
                                                <img src="assets/dist/img/avatar-1.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Karen Robinson">
                                                <img src="assets/dist/img/avatar-2.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Miyah Myles">
                                                <img src="assets/dist/img/avatar-3.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Daniela Dewitt">
                                                <img src="assets/dist/img/avatar-4.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                        </div>
                                    </td>
                                    <td>Jahangir Alam</td>
                                    <td>(01662) 59083</td>
                                    <td>3219 Elit Avenue</td>
                                    <td>
                                        <div class="sparkline5"></div>
                                    </td>
                                    <td>Chittagong</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-group">
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Melissa Ayre">
                                                <img src="assets/dist/img/avatar-1.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Karen Robinson">
                                                <img src="assets/dist/img/avatar-2.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                            <a href="user_profile.html" class="avatar avatar-xs" data-toggle="tooltip" title="Daniela Dewitt">
                                                <img src="assets/dist/img/avatar-5.jpg" class="avatar-img rounded-circle" alt="...">
                                            </a>
                                        </div>
                                    </td>
                                    <td>Brielle Williamson</td>
                                    <td>123 456 7890</td>
                                    <td>Dhaka-1229, Bangladesh</td>
                                    <td>
                                        <div class="sparkline6"></div>
                                    </td>
                                    <td>Barisal</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/.body content-->

@endsection


@section('script')

@include('layouts.datatable-scripts')

@endsection
