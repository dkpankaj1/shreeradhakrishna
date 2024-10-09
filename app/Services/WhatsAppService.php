<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $baseUrl;
    protected $user;
    protected $pass;
    protected $sender;

    public function __construct()
    {
        $this->baseUrl = 'http://bhashsms.com/api/sendmsg.php';
        $this->user = env('WA_API_USER', 'SHREERADHABWA'); // Add this to .env
        $this->pass = env('WA_API_PASS', '********'); // Add this to .env
        $this->sender = env('WA_API_SENDER', 'BUZWAP'); // Add this to .env
    }

    /**
     * Send normal text message.
     */
    public function sendNormalText($mobileNumbers, $templateName)
    {
        $query = [
            'user' => $this->user,
            'pass' => $this->pass,
            'sender' => $this->sender,
            'phone' => $this->formatMobileNumbers($mobileNumbers),
            'text' => $templateName,
            'priority' => 'wa',
            'stype' => 'normal',
        ];

        return $this->sendRequest($query);
    }

    /**
     * Send text message with variables/parameters.
     */
    public function sendTextWithParams($mobileNumbers, $templateName, $params)
    {
        $query = [
            'user' => $this->user,
            'pass' => $this->pass,
            'sender' => $this->sender,
            'phone' => $this->formatMobileNumbers($mobileNumbers),
            'text' => $templateName,
            'priority' => 'wa',
            'stype' => 'normal',
            'Params' => implode(',', $params),
        ];

        return $this->sendRequest($query);
    }

    /**
     * Send text message with variables and an image/video.
     */
    public function sendMediaMessage($mobileNumbers, $templateName, $params, $mediaType, $mediaUrl)
    {
        $query = [
            'user' => $this->user,
            'pass' => $this->pass,
            'sender' => $this->sender,
            'phone' => $this->formatMobileNumbers($mobileNumbers),
            'text' => $templateName,
            'priority' => 'wa',
            'stype' => 'normal',
            'Params' => implode(',', $params),
            'htype' => $mediaType,
            'url' => $mediaUrl,
        ];

        return $this->sendRequest($query);
    }

    /**
     * Send normal text message after customer replies.
     */
    public function sendReplyText($mobileNumbers, $text)
    {
        $query = [
            'user' => $this->user,
            'pass' => $this->pass,
            'sender' => $this->sender,
            'phone' => $this->formatMobileNumbers($mobileNumbers),
            'text' => $text,
            'priority' => 'wa',
            'stype' => 'normal',
            'htype' => 'normal',
        ];
        return $this->sendRequest($query);
    }

    /**
     * Send OTP message.
     */
    public function sendOtpMessage($mobileNumbers, $templateName, $otp)
    {
        $query = [
            'user' => $this->user,
            'pass' => $this->pass,
            'sender' => $this->sender,
            'phone' => $this->formatMobileNumbers($mobileNumbers),
            'text' => $templateName,
            'priority' => 'wa',
            'stype' => 'auth',
            'Params' => $otp,
        ];

        return $this->sendRequest($query);
    }

    /**
     * Helper function to format mobile numbers by removing '91' and ensuring 10 digits.
     */
    protected function formatMobileNumbers($mobileNumbers)
    {
        return implode(',', array_map(function ($number) {
            // Remove country code '91' if present, and any other non-digit characters
            $number = preg_replace('/[^0-9]/', '', $number); // Remove non-numeric characters
            return substr($number, -10); // Get the last 10 digits
        }, (array) $mobileNumbers));
    }

    /**
     * Helper function to send request to the API using the Http facade.
     */
    protected function sendRequest($query)
    {
        try {
            $response = Http::get($this->baseUrl, $query);
            return $response->json(); // Assumes the response is JSON, adjust if necessary
        } catch (\Exception $e) {
            // Handle the exception or log the error
            return ['error' => $e->getMessage()];
        }
    }
}
