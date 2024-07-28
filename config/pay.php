<?php

return [
    'paystack' => [
        'public_key' => env('PAYSTACK_PUBLIC_KEY', ''),
        'secret_key' => env('PAYSTACK_SECRET_KEY', ''),
        'merchant_email' => env('PAYSTACK_MERCHANT_EMAIL', ''),
        'log' => [
            'file' => storage_path('logs/paystack.log'),
            'level' => 'debug', // info, debug, error
            'type' => 'single', // single, daily
            'max_file' => 30, // default 30 days
        ],
    ],
];