<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center mt-5">
        <div class="alert alert-success">
            <h1 class="display-4">Payment Successful!</h1>
            <p class="lead">Thank you for your payment. Your registration has been completed successfully.</p>
        </div>
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</body>
</html>
