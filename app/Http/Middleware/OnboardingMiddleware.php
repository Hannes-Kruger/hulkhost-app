<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnboardingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return $next($request);
        }

        $team = auth()->user()->currentTeam;

        if ($team->skipped_onboarding || $team->sage_id) {

            if ($request->routeIs('onboarding')) {
                return redirect()->route('dashboard');
            }

            return $next($request);
        }

        if (! $request->routeIs('onboarding')) {
            return redirect()->route('onboarding');
        }

        return $next($request);
    }
}
