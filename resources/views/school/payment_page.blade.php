<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            user-select: none;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-bottom: 1.5rem;
        }

        .btn-pay {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-pay:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Proceed with Payment</h2>
        <form id="paymentForm">
            @csrf
            <input type="hidden" id="email" value="{{ $school->email }}">
            <input type="hidden" id="amount" value="{{ $school->amount }}">
            <input type="hidden" id="school_id" value="{{ $school->id }}">
            <button type="button" class="btn-pay" onclick="payWithPaystack()">Pay Now</button>
        </form>
    </div>

    <script>
        function payWithPaystack() {
            let handler = PaystackPop.setup({
                key: '{{ env('PAYSTACK_PUBLIC_KEY') }}',
                email: document.getElementById('email').value,
                amount: document.getElementById('amount').value * 100,
                currency: 'NGN',
                ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response) {
                    let reference = response.reference;
                    let school_id = document.getElementById('school_id').value;

                    // Verify the transaction on the server
                    fetch('{{ route('payment.verify') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                reference: reference,
                                school_id: school_id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Payment successful and verified!');
                                window.location.href = data.redirect_url;
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
</body>

</html>
