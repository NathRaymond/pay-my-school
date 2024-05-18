<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TermiiService
{
    protected $apiKey;
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiKey = env('TERMII_API_KEY');
        $this->apiBaseUrl = env('TERMII_BASE_URL');
    }

    public function sendSms($recipient, $message)
    {
        $client = new Client();
        // dd("here");
        try {
            // dd($this->apiKey, $this->apiBaseUrl);

            $response = $client->request('POST', $this->apiBaseUrl, [
                'form_params' => [
                    'to' => $recipient,
                    'from' => 'Ogirs', // Replace with your desired sender ID or phone number
                    'sms' => $message,
                    'type' => 'plain',
                    'channel' => 'generic',
                    'api_key' => $this->apiKey,
                ],
            ]);

            // dd($response);
            $resp = json_decode($response->getBody(), true);
            return $resp;

            // $statusCode = $response->getStatusCode();
            // return $statusCode === 200;
        } catch (GuzzleException $e) {
            // dd($e->getMessage());
            // Handle any exceptions or errors
            return $e->getMessage();
        }
    }
}
