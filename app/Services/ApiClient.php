<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\PendingRequest;

class ApiClient
{
    protected string $baseUrl;
    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('api.base_url');
        $this->timeout = config('api.timeout');
    }

    protected function client(): PendingRequest
    {
        $client = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->acceptJson();

        $token = Session::get('api_token');
        if ($token) {
            $client = $client->withToken($token);
        }

        return $client;
    }

    public function get(string $endpoint, array $query = []): Response
    {
        return $this->client()->get($endpoint, $query);
    }

    public function post(string $endpoint, array $data = []): Response
    {
        return $this->client()->post($endpoint, $data);
    }

    public function put(string $endpoint, array $data = []): Response
    {
        return $this->client()->put($endpoint, $data);
    }

    public function delete(string $endpoint): Response
    {
        return $this->client()->delete($endpoint);
    }

    public function hasToken(): bool
    {
        return Session::has('api_token');
    }

    public function setTokens(string $accessToken, string $refreshToken): void
    {
        Session::put('api_token', $accessToken);
        Session::put('api_refresh_token', $refreshToken);
    }

    public function clearTokens(): void
    {
        Session::forget('api_token');
        Session::forget('api_refresh_token');
        Session::forget('api_user');
    }

    public function refreshToken(): bool
    {
        $refreshToken = Session::get('api_refresh_token');
        if (!$refreshToken) {
            return false;
        }

        $response = Http::baseUrl($this->baseUrl)
            ->timeout($this->timeout)
            ->acceptJson()
            ->post('/auth/refresh', [
                'refresh_token' => $refreshToken,
            ]);

        if ($response->successful()) {
            $data = $response->json('data');
            $this->setTokens($data['access_token'], $data['refresh_token']);
            return true;
        }

        $this->clearTokens();
        return false;
    }
}
