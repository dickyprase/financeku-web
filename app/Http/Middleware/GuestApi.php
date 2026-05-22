<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ApiClient;

class GuestApi
{
    protected ApiClient $api;

    public function __construct(ApiClient $api)
    {
        $this->api = $api;
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->api->hasToken()) {
            return redirect('/');
        }

        return $next($request);
    }
}
