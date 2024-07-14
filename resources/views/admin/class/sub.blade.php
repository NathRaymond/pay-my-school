@extends('layouts.master')


@section('body')
<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sub Classes</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-spiral"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold">Sub Classes</h1>
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
                            <h6 class="fs-17 font-weight-600 mb-0">Sub Class Records</h6>
                        </div>
                        <div class="text-right">
                            {{--  <a href="{{ route('download.student.excel') }}" class="btn btn-success rounded-pill w-100p btn-sm mr-1" >Download Student Template</a>  --}}
                            <button type="button" class="btn btn-success rounded-pill w-100p btn-sm mr-1" data-toggle="modal" data-target="#exampleModal1">Add New Sub Class</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Class</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($classes->whereNotNull('class_id') as $class)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $class->sub->name ?? "" }}</th>
                                        <th>{{ $class->name }}</th>
                                        <th>{{ $class->created_at }}</th>
                                        <td>
                                            <a href="#" class="btn btn-success-soft btn-sm mr-1"><i class="far fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger-soft btn-sm"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-600" id="exampleModalLabel4">Add New Sub Class</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="addNewSubClass" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="font-weight-600">Select Class</label>
                                    <select class="form-control" name="class_id" required>
                                        <option>Select Class</option>
                                        @foreach ($classes->whereNull('class_id') as $main)
                                        <option value="{{ $main->id }}">{{ $main->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="font-weight-600">Description</label>
                                    <input type="text" class="form-control" required name="name" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="enter class description e.g primary one">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save Data</button>
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(".categoryChange").on("change", function(e) {
            $(".insertSubCategory").empty()
            var id = $(this).val();
            $.ajax({
                url: '{{ route('get.sub.classes') }}?id=' + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var len = 0;
                    len = response['data'].length;

                    for (var i = 0; i < len; i++) {
                        var id = response['data'][i].id;
                        var name = response['data'][i].description;
                        var option = "<option value='" + id + "'>" + name + "</option>";
                        $(".insertSubCategory").append(option);
                    }
                    $(".insertSubCategory").prepend(
                        "<option value='' selected='selected'>Choose Sub Category</option>"
                    );
                }
            });
        });

        $("#addNewSubClass").on('submit', async function(e) {
            e.preventDefault();
            {{--  preLoader.show();  --}}
            var form = e.target;
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.create.sub.class') }}",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    new swal("Good Job", response.message, "success");
                    // preLoader.hide();
                    // $('#productForm').trigger("reset");
                    window.location.reload()
                },
                error: function(data) {
                    // console.log(data)
                    //  preLoader.hide();
                    new swal("Opss", data.responseJSON.message, "error");
                }
            })
        });
    })
</script>
@endsection
