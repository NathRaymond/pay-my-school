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
                    <small>School Fees detail of {{ $schoolFees->first()->mySchoolClass->name?? "" }}.</small>
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
                                <h6 class="fs-17 font-weight-600 mb-0">School Fees</h6>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('admin.school-fees') }}"
                                    class="btn btn-info rounded-pill w-100p btn-sm mr-1">Go Back</a>
                                
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
                                        <th>Session</th>
                                        <th>Term</th>
                                        <th>Total Amount (N)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($schoolFees as $key=> $classFee)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $classFee->description }}</th>
                                        <th>{{ $classFee->SchoolSession->description??"" }}</th>
                                        <th>{{ $classFee->SchoolTerm->description??"" }}</th>
                                        <th class="text-right">{{ number_format($classFee->amount,2)   }}</th>
                                        <th>
                                            <a href="{{ route('delete-school-fee',$classFee->id) }}" class="btn btn-danger-soft btn-sm mr-1" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fa fa-trash"></i></a>
                                        </th>
                                    </tr>
                                        
                                    @endforeach
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
                            var name = response['data'][i].name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $(".insertSubCategory").append(option);
                        }
                        $(".insertSubCategory").prepend(
                            "<option value='' selected='selected'>Choose Sub Class</option>"
                        );
                    }
                });
            });
    
            $("#uploadSchoolFees").on('submit', async function(e) {
                e.preventDefault();                
                var form = e.target;
                var formData = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('upload-school-fee') }}",
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
