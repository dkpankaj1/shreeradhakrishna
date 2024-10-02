<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BhashSmsService
{
    /**
     * Send SMS using BhashSMS API.
     *
     * @param string $phone The phone number to send the SMS to.
     * @param int $points The reward points to include in the SMS.
     * @return bool Whether the SMS was sent successfully or not.
     */
    public static function sendNewPurchaseSms($phone, $points)
    {
        try {
            $response = Http::get(config('services.bhashsms.api_url'), [
                "user" => config('services.bhashsms.user'),
                "pass" => config('services.bhashsms.pass'),
                "sender" => config('services.bhashsms.sender'),
                "phone" => $phone,
                "priority" => config('services.bhashsms.priority'),
                "stype" => config('services.bhashsms.stype'),
                "text" => "Congratulations! You have got reward points on your last filling. Your total filling reward points is - $points. Thank you for shopping from us. - SHREE RADHA KRISHNA ENERGY"
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                Log::info("SMS sent successfully to $phone");
                return true;
            } else {
                Log::error("Failed to send SMS to $phone - HTTP status code: {$response->status()}");
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Exception occurred while sending SMS to $phone: " . $e->getMessage());
            return false;
        }
    }
}
