<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');
        $supported = config('locales.supported', ['en']);

        if (! is_string($locale) || ! in_array($locale, $supported, true)) {
            abort(404);
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
