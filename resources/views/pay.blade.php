<!DOCTYPE html>
<html>

<head>
    <title>Laravel Paystack Integration</title>
</head>

<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('pay') }}">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="phone_no">Phone Number:</label>
            <input type="text" id="phone_no" name="phone_no" required>
        </div>
        <div>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required>
        </div>
        <button type="submit">Pay</button>
    </form>
</body>

</html>
