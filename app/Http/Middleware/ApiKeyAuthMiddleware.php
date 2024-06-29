<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestApiKey = $request->header('Api-Access-Key');
        if (!$requestApiKey || $requestApiKey !== env('API_KEY')) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        }

        return $next($request);
    }
}