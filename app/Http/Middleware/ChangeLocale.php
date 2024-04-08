<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = $request->header('accept-language');
        if ($language) {
            App::setLocale($language);
        }
        return $next($request);
    }
}
