@extends('layouts.admin_master')
@section('activeLinkAdmin', 'mm-active')

@section('headlinks')
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
    <link href="{{ asset('plugins/chosen/chosen.min.css') }}" rel="stylesheet">
    <!--Select2 [ OPTIONAL ]-->
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="main-content">
        @include('includes.admin_header')
        <?php use App\Http\Controllers\Admin\TamaUserController; ?>
        <!--Content Header (Page header)-->
        <div class="content-header row align-items-center m-0">
            <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
                <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                    <li class="breadcrumb-item active"> @can('view-user-details')
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                data-target="#exampleModal1">Add New User</button>
                        @endcan
                    </li>
                </ol>
            </nav>
            <div class="col-sm-8 header-title p-0">
                <div class="media">
                    <div class="header-icon text-success mr-3"><i class="typcn typcn-spiral"></i></div>
                    <div class="media-body">
                        <h1 class="font-weight-bold">Users</h1>
                        <small>From now on you will start your activities.</small>
                    </div>
                </div>
            </div>
        </div>
        <!--/.Content Header (Page header)-->
        <div class="body-content">
            <div class="card mb-4">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Sector</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td>{{ $user->sectorNames() }}</td>
                                        <td>


                                            <button type="button" class="btn-sm btn-success waves-effect "
                                                data-toggle="modal" data-target="#myModal1" id="edit-user"
                                                data-id="{{ $user->id }}">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </button>


                                            @can('delete-user')
                                                <button type="button" id="deleteRecord" data-id="{{ $user->id }}"
                                                    class="btn-sm btn-danger waves-effect waves-light w-sm">
                                                    <i class="mdi mdi-trash-can"></i> Delete
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" id="exampleModalLabel4">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-4">
                    <label for="" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="" class="col-sm-3 col-form-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="phone" id="" required>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="" class="col-sm-3 col-form-label">Roles</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="roles" id="role" required>
                            <option>Select Role</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label for="" class="col-sm-3 col-form-label">Sector</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-hidden-accessible" multiple=""
                            data-live-search="true" data-placeholder="Select sectors" style="width: 100%;"
                            tabindex="-1" name="sector" aria-hidden="true" required>

                            <option>Select Sector</option>
                            @foreach ($sectors as $key => $sector)
                                <option value="{{ $sector->id }}">{{ $sector->description }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>
        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frm_main" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="phone" id="" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Roles</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="roles" id="role" required>
                                        <option>Select Role</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Sector</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select2-hidden-accessible" multiple=""
                                        data-live-search="true" data-placeholder="Select sectors" style="width: 100%;"
                                        tabindex="-1" name="sector" aria-hidden="true" required>

                                        <option>Select Sector</option>
                                        @foreach ($sectors as $key => $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->description }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frm_main" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="phone" id="" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Roles</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="roles" id="role" required>
                                        <option>Select Role</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Sector</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" multiple=""
                                        data-live-search="true" data-placeholder="Select sectors" style="width: 100%;"
                                        tabindex="-1" name="sector" aria-hidden="true" required>

                                        <option>Select Sector</option>
                                        @foreach ($sectors as $key => $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->description }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                </div><!-- /.modal-content -->
                </form>

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="updateusr" method="post" action="{{ route('update_tama_user') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="id" id="userid" style="display:none">
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="roles" id="roless">
                                        <option>Select Role</option>
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 col-form-label">Sector</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select2-hidden-accessible" multiple=""
                                        data-live-search="true" data-placeholder="Select sectors" style="width: 100%;"
                                        tabindex="-1" name="sector[]" aria-hidden="true" required>

                                        <option>Select Sector</option>
                                        @foreach ($sectors as $key => $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->description }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                </div><!-- /.modal-content -->
                </form>

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!--/.main content-->
@endsection

@section('scripts')

    @include('includes.datatable')


    <script src="{{ asset('js\requestController.js') }}"></script>
    <script src="{{ asset('js\formController.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>


    <script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false
            });
        });


        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                 url: "{{ route('role_list') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response['data'][i].id;
                        var descr = response['data'][i].name;
                        var option = "<option value='" + id + "'>" + descr + "</option>";
                        $("#role").append(option);
                    }

                }
            });

            $.ajax({
                url: "{{ route('sectors_list') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }
                    for (var i = 0; i < len; i++) {
                        var id = response['data'][i].id;
                        var descr = response['data'][i].description;
                        var option = "<option value='" + id + "'>" + descr + "</option>";
                        $("#sector").append(option);
                    }

                }
            });




            $("#frm_main").on('submit', async function(e) {
                e.preventDefault();

                const serializedData = $("#frm_main").serializeArray();

                try {
                    const postRequest = await request("/admin/tama/users/create", processFormInputs(
                        serializedData), 'post');
                    console.log('postRequest.message', postRequest.message);
                    swal("Good Job", "New User has been created successfully!.", "success");
                    $('#frm_main').trigger("reset");
                    $("#frm_main .close").click();
                    window.location.reload();
                } catch (e) {
                    if ('message' in e) {
                        console.log('e.message', e.message);
                        swal("Opss", e.message, "error");
                    }
                }
            })

            /* When click edit user */
            $('body').on('click', '#edit-user', function() {

                var user_id = $(this).data('id');
                console.log(user_id)
                $.get('{{ route('user_edit') }}?id=' + user_id, function(data) {
                    $('#userid').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#roless').val(data.role);
                    $('#phone').val(data.phone);
                    $('#sectors').val(data.sector);
                    console.log(data);

                })
            });

            /* When click delete button */
            $('body').on('click', '#deleteRecord', function() {
                var user_id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                var el = this;
                // alert(user_id);
                resetAccount(el, user_id);
            });


            async function resetAccount(el, user_id) {
                const willUpdate = await swal({
                    title: "Confirm User Delete",
                    text: `Are you sure you want to delete this user?`,
                    icon: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                    buttons: ["Cancel", "Yes, Delete"]
                });
                if (willUpdate) {
                    //performReset()
                    performDelete(el, user_id);
                } else {
                    swal("User record will not be deleted  :)");
                }
            }


            function performDelete(el, user_id) {
                //alert(user_id);
                try {
                    $.get('{{ route('user_destroy') }}?id=' + user_id,
                        function(data, status) {
                            console.log(status);
                            console.table(data);
                            if (status === "success") {
                                let alert = swal("User successfully deleted!.");
                                $(el).closest("tr").remove();
                                // alert.then(() => {
                                // });
                            }
                        }
                    );
                } catch (e) {
                    let alert = swal(e.message);
                }
            }


        })
    </script>
@endsection

