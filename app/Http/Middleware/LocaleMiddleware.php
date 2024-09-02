<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        //$locale = $request->header('Accept-Language', 'en');
        $locale = $request->lang ? $request->lang : 'en';
        App()->setLocale($locale);

        return $next($request);
    }
}
