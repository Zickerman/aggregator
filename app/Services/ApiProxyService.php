<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiProxyService
{
    private $apiUrl = 'https://postback-sms.com/api/'; // можно вынести в конфиг
    private $token = '5994c91001f57eea808aff11738d752a'; // можно вынести в конфиг

    private function callApi($action, $params = [])
    {
        $params['token'] = $this->token;
        $params['action'] = $action;

        $response = Http::get($this->apiUrl, $params)->json();

        if (isset($response['code']) && $response['code'] === 'error') {
            Log::error("API returned error for: $action", ['response' => $response]);
            return [
                'code' => 'error',
                'message' => $response['message'] ?? 'Unknown error',
            ];
        }

        return $response->json();
    }

    public function getNumber($country, $service, $rentTime = null)
    {
        $params = [
            'country' => $country,
            'service' => $service,
        ];

        if ($rentTime) {
            $params['rent_time'] = $rentTime;
        }

        return $this->callApi('getNumber', $params);
    }

    public function getSms($activation)
    {
        return $this->callApi('getSms', ['activation' => $activation]);
    }

    public function cancelNumber($activation)
    {
        return $this->callApi('cancelNumber', ['activation' => $activation]);
    }

    public function getStatus($activation)
    {
        return $this->callApi('getStatus', ['activation' => $activation]);
    }
}
