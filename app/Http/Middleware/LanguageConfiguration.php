<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageConfiguration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentLocale = \App::currentLocale();

        if ($request->input('locale')) {
            $currentLocale = $request->input('locale');
        } else if ($user = \Auth::user()) {
            $currentLocale = $user->preferred_locale;
        }

        \App::setLocale($currentLocale);

        return $next($request);
    }
}
