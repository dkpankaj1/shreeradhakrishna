<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class CunnektApiService
{
    protected $baseUrl = 'https://app2.cunnekt.com/v1/sendnotification';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = "77475bd992f729a9fdd84b236090886a5a8dd222";
    }

    /**
     * Send a simple notification
     *
     * @param string $mobile
     * @param string $templateId
     * @return array
     * @throws RequestException
     */
    public function sendSimpleNotification(string $mobile, string $templateId): array
    {
        $payload = [
            'mobile' => $mobile,
            'templateid' => $templateId,
            "overridebot" => "yes/no"
        ];

        return $this->makeRequest($payload);
    }

    /**
     * Send a notification with template components
     *
     * @param string $mobile
     * @param string $templateId
     * @param array $templateComponents
     * @return array
     * @throws RequestException
     */
    public function sendTemplateNotification(string $mobile, string $templateId, array $templateComponents): array
    {
        $payload = [
            'mobile' => $mobile,
            'templateid' => $templateId,
            'template' => [
                'components' => [$templateComponents]
            ]
        ];

        return $this->makeRequest($payload);
    }

    /**
     * Make the API request
     *
     * @param array $payload
     * @return array
     * @throws RequestException
     */
    protected function makeRequest(array $payload): array
    {


        $response = Http::withHeaders([
            'API-KEY' => $this->apiKey
        ])->timeout(30)
            ->withOptions([
                'max_redirects' => 10,
                'http_version' => '1.1'
            ])
            ->post($this->baseUrl, $payload);

        if ($response->failed()) {
            throw new RequestException($response);
        }
        // dd($response->json());
        return $response->json();
    }
}