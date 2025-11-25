<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Define public routes that bypass all checks
        $publicRoutes = [
            'login',
            'logout',
            'password.request',  // Forgot password
            'password.reset',    // Password reset
            'verification.notice' // Email verification
        ];

        // 2. Check if current route is public (by name or path)
        $currentRoute = $request->route()?->getName();
        if (in_array($currentRoute, $publicRoutes)) {
            return $next($request);
        }

        // 3. Handle unauthenticated users
        if (!Auth::check()) {
            // Store intended URL for post-login redirect
            session()->put('url.intended', $request->fullUrl());
            return redirect()->route('login')->with('error', 'Veuillez vous connecter');
        }

        $user = Auth::user();

        // 4. Registration exceptions (allow access to these routes even with incomplete profile)
        $registrationRoutes = [
            'registration.form',
            'registration.submit',
            'verification.verify', // Email verification
            'verification.send'
        ];

        if (in_array($currentRoute, $registrationRoutes)) {
            return $next($request);
        }

        // 5. Check profile completeness (using fonction as indicator)
        if (empty($user->fonction)) {
            // Store intended URL for post-registration redirect
            session()->put('url.intended', $request->fullUrl());
            return redirect()->route('registration.form')
                   ->with('warning', 'Veuillez compléter votre profil pour continuer');
        }

        // 6. All checks passed - proceed with request
        return $next($request);
    }
}


