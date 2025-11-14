<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from route parameter
        $locale = $request->route('locale');

        // Get supported languages from config
        $supportedLanguages = array_keys(config('brand.languages'));

        // If locale is valid, set it
        if ($locale && in_array($locale, $supportedLanguages)) {
            app()->setLocale($locale);
        } else {
            // Set default locale
            app()->setLocale(config('brand.default_language'));
        }

        return $next($request);
    }
}
