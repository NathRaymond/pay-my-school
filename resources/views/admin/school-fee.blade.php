@extends('layouts.master')


@section('body')
    <!--Content Header (Page header)-->
    <div class="content-header row align-items-center m-0">
        <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
            <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">School Fees</li>
            </ol>
        </nav>
        <div class="col-sm-8 header-title p-0">
            <div class="media">
                <div class="header-icon text-success mr-3"><i class="typcn typcn-spiral"></i></div>
                <div class="media-body">
                    <h1 class="font-weight-bold">School Fees</h1>
                    <small>From now on you will start your activities.</small>
                </div>
            </div>
        </div>
    </div>
    <div class="body-content">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="font-weight-600">Select Class</label>
                                    <select class="form-control">
                                        <option>Select Option</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                <h6 class="fs-17 font-weight-600 mb-0">Student Fees</h6>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('download.student.excel') }}"
                                    class="btn btn-success rounded-pill w-100p btn-sm mr-1">Download Template</a>
                                <button type="button" class="btn btn-success rounded-pill w-100p btn-sm mr-1"
                                    data-toggle="modal" data-target="#exampleModal1">Upload School Fees</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table display table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Description</th>
                                        <th>Class</th>
                                        <th>Sub Class</th>
                                        <th>Term</th>
                                        <th>Session</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel4" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-600" id="exampleModalLabel4">Upload Student Record
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="addNewVendor" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="user_type" value="Vendor">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="font-weight-600">Select Class</label>
                                            <select class="form-control">
                                                <option>Select Option</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" required class="font-weight-600">Select Sub
                                                Class</label>
                                            <select class="form-control">
                                                <option>Select Option</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="font-weight-600">Choose File</label>
                                            <input type="file" class="form-control" required name="file"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save changes</button>
                                    </div>
                                </form>
                            </div>
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
