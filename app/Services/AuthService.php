<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class AuthService
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function login(string $email, string $password): array
    {
        $response = $this->api->post('/auth/login', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $data = $response->json('data');
            $this->api->setTokens(
                $data['tokens']['access_token'],
                $data['tokens']['refresh_token']
            );
            Session::put('api_user', $data['user']);
            return ['success' => true, 'user' => $data['user']];
        }

        return [
            'success' => false,
            'message' => $response->json('message', 'Login failed'),
        ];
    }

    public function register(string $name, string $email, string $password): array
    {
        $response = $this->api->post('/auth/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $data = $response->json('data');
            $this->api->setTokens(
                $data['tokens']['access_token'],
                $data['tokens']['refresh_token']
            );
            Session::put('api_user', $data['user']);
            return ['success' => true, 'user' => $data['user']];
        }

        return [
            'success' => false,
            'message' => $response->json('message', 'Registration failed'),
        ];
    }

    public function logout(): void
    {
        $this->api->clearTokens();
    }

    public function getMe(): ?array
    {
        $response = $this->api->get('/auth/me');

        if ($response->successful()) {
            $user = $response->json('data');
            Session::put('api_user', $user);
            return $user;
        }

        return null;
    }

    public function user(): ?array
    {
        return Session::get('api_user');
    }

    public function check(): bool
    {
        return $this->api->hasToken();
    }
}
