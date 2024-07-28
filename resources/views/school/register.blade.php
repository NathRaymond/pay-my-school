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
    {{-- <script src="https://js.paystack.co/v1/inline.js"></script> --}}
    <style>
        body {
            /* user-select: none; */
        }

        .form-container {
            max-width: 700px !important;
        }

        .form-container .panel .divider:after,
        .form-container .panel .divider:before {
            width: 100% !important;
        }
    </style>
    {{-- <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.onkeydown = function (e) {
            if (e.keyCode == 123 || (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) || (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) || (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) || (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0))) {
                return false;
            }
        };
    </script> --}}
</head>

<body class="bg-white">
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
                    <form id="paymentForm">
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
                                        <option>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="state" required>
                                        <option>Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="lga" required>
                                        <option>Select LGA</option>
                                        @foreach ($lgas as $lga)
                                            <option value="{{ $lga->id }}">{{ $lga->local_govt }}</option>
                                        @endforeach
                                    </select>
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
                            <label class="form-label">Amount</label>
                            <input type="text" name="amount" class="form-control" placeholder="Enter Amount"
                                required min="0" step="any" id="amount" value="10000" readonly>
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
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');

        paymentForm.addEventListener('submit', payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();

            let handler = PaystackPop.setup({
                key: '{{ env('PAYSTACK_PUBLIC_KEY') }}',
                email: document.getElementById('email').value,
                amount: document.getElementById('amount').value * 100,
                currency: 'NGN',
                ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response) {
                    let reference = response.reference;

                    // Collect form data
                    let formData = new FormData(paymentForm);
                    formData.append('reference', reference);

                    // Verify the transaction on the server
                    fetch('{{ route('payment.verify') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Payment successful and verified!');
                            } else {
                                alert('Payment verification failed: ' + data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                },
                onClose: function() {
                    alert('Payment was not completed.');
                }
            });

            handler.openIframe();
        }
    </script>

    {{-- Amount Input Validation Script --}}
    <script>
        document.getElementById('amount-input').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except .
            if (!isNaN(value) && value.length > 0) {
                value = formatNumber(value);
            }
            e.target.value = value;
        });

        function formatNumber(value) {
            const parts = value.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }
    </script>


</body>

</html>
