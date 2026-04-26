<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $duration = '3600')
    {
        // Only cache GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        // Generate cache key based on URL and user
        $cacheKey = 'response_' . md5($request->fullUrl() . '_' . ($request->user()?->id ?? 'guest'));

        // Check if response is cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Get response
        $response = $next($request);

        // Cache successful responses
        if ($response->getStatusCode() === 200) {
            Cache::put($cacheKey, $response, $duration);
        }

        return $response;
    }
}
