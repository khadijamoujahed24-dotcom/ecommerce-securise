<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Content Security Policy
        $response->headers->set(
             'Content-Security-Policy',
        
             "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; frame-ancestors 'none';"
        );



        // Protection contre Clickjacking
        $response->headers->set('X-Frame-Options', 'DENY');

        // Protection MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Protection XSS (ancienne compatibilité)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}



