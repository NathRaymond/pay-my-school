<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bdtask">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Pay My School</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/dist/img/favicon.png') }}">
    <!--Global Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/typicons/src/typicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/themify-icons/themify-icons.min.css') }}" rel="stylesheet">
    <!--Third party Styles(used by this page)-->

    <!--Start Your Custom Style Now-->
    <link href="{{ asset('assets/dist/css/style.css') }}" rel="stylesheet">
    <style>
        .preloader {
            align-items: center;
            background: gray;
            display: flex;
            height: 100vh;
            justify-content: center;
            left: 0;
            position: fixed;
            top: 0;
            transition: opacity 0.3s linear;
            width: 100%;
            z-index: 9999;
            opacity: 0.4;
        }

        .text-right {
            text-align: right;
        }

        .shepherd-modal-overlay-container.shepherd-modal-is-visible path {
            pointer-events: none !important;
        }

        body {
            user-select: none;
        }

        .form-container {
            max-width: 700px !important;
        }

        .form-container .panel .divider:after,
        .form-container .panel .divider:before {
            width: 100% !important;
        }
    </style>

</head>

<body class="bg-white">
    <div class="preloader" style="display: none">
        <div class="spinner-grow text-info m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center text-center h-100vh">
        <div class="form-wrapper m-auto">
            <div class="form-container my-4">
                <div class="register-logo text-center mb-4">
                    <img src="{{ asset('assets/dist/img/logo2.png') }}" alt="">
                </div>
                <div class="panel">
                    <div class="panel-header text-center mb-3">
                        <h3 class="fs-24">Sign up for your account!</h3>
                    </div>
                    <div class="divider font-weight-bold text-uppercase text-dark d-table text-center my-3">&nbsp;</div>
                    {{-- <form id="paymentForm"> --}}
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('register.submit') }}" method="POST" onsubmit="$('.preloader').show()">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter School Name"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="p_name" class="form-control"
                                placeholder="Enter Proprietor Name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control"
                                        placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="country" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="state" required>
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id_no }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="lga" required>
                                        <option value="">Select LGA</option>
                                        @foreach ($lgas as $lga)
                                            <option value="{{ $lga->id_no }}">{{ $lga->local_govt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control" placeholder="Enter City"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="amount" required>
                                <option value="">Select Registration Fee</option>
                                @foreach ($amounts as $amount)
                                    <option value="{{ $amount->amount }}">{{ $amount->amount }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" name="c_box" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">By signing up, you agree to the <a
                                    href="#">terms of service</a></label>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Sign up</button>
                        <div class="bottom-text text-center my-3">
                            Already have an account? <a href="{{ route('login') }}" class="font-weight-500">Sign
                                in</a>
                        </div>
                    </form>
</body>

</html>
</div>
</div>
</div>
</div>
<!-- /.End of form wrapper -->
<!--Global script(used by all pages)-->
<script src="{{ asset('assets/plugins/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metisMenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/dist/js/sidebar.js') }}"></script>
<script src="{{ asset('js/sweetalert/dist/sweetalert.min.js') }}"></script>
<script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeydown = function(e) {
        if (e.keyCode == 123 || (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) || (e.ctrlKey && e
                .shiftKey && e.keyCode == 'C'.charCodeAt(0)) || (e.ctrlKey && e.shiftKey && e.keyCode == 'J'
                .charCodeAt(0)) || (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0))) {
            return false;
        }
    };
</script>
<script>
    @if ($errors->any())
        swal('Oops...', "{!! implode('', $errors->all(':message')) !!}", 'error')
    @endif

    @if (session()->has('success'))
        swal(
            'Success!',
            "{{ session()->get('message') }}",
            'success'
        )
    @endif
    @if (session()->has('message'))
        swal(
            'Success!',
            "{{ session()->get('message') }}",
            'success'
        )
    @endif
</script>
</body>

</html>
