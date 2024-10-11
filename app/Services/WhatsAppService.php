<?php

namespace App\Services;
use Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $baseUrl;
    protected $user;
    protected $pass;
    protected $sender;

    public function __construct()
    {
        $this->baseUrl = 'http://bhashsms.com/api/sendmsg.php';
        $this->user = "SHREERADHABWA";
        $this->pass = "123456";
        $this->sender = "BUZWAP";
    }

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

    protected function formatMobileNumbers($mobileNumbers)
    {
        return implode(',', array_map(function ($number) {
            $number = preg_replace('/[^0-9]/', '', $number); // Remove non-numeric characters
            return substr($number, -10); // Get the last 10 digits
        }, (array) $mobileNumbers));
    }

    protected function sendRequest($query)
    {
        try {
            $url = $this->baseUrl . '?' . http_build_query($query);

            // Initialize cURL
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout for 10 seconds

            // Execute cURL request
            $response = curl_exec($ch);

            // Log the response
            if ($response === false) {
                \Log::error('cURL Error: ' . curl_error($ch));
                return ['error' => curl_error($ch)];
            }

            // Get response status and content type
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

            \Log::info('Response Status: ' . $httpStatus);

            // Close cURL session
            curl_close($ch);

            // If response is JSON, decode and return
            if (strpos($contentType, 'application/json') !== false) {
                $responseJson = json_decode($response, true);
                \Log::info('Response JSON: ', $responseJson);
                return $responseJson;
            }

            // Log and return the raw response body for non-JSON content
            \Log::info('Response Body: ' . $response);
            return $response;

        } catch (\Exception $e) {
            \Log::error('Error in sendRequest: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    public static function checkWABalance()
    {
        $balance = 0;
        try {
            $url = 'http://bhashsms.com/api/checkbalance.php';

            $response = Http::get($url, [
                "user" => "SHREERADHABWA",
                "pass" => "123456",
            ]);
            if ($response->successful()) {
                $balance = $response->body();
            }
        } catch (\Exception $e) {
            Log::error("Exception occurred while Getting SMS Balance");
        }
        return $balance;
    }
}
