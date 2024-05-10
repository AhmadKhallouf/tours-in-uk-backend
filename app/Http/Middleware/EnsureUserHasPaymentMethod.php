<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class EnsureUserHasPaymentMethod
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Throw an AuthenticationException if the user is not authenticated
            throw new AuthenticationException('Unauthenticated.');
        }

        $user = Auth::user();

        if (!$user->paymentMethods()->exists()) {
            // Throw an AccessDeniedHttpException if no payment methods are found
            throw new AccessDeniedHttpException(
                'No payment method found. Please add a payment method to proceed.'
            );
        }

        return $next($request);
    }
}
