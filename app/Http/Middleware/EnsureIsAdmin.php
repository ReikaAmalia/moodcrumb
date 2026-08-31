<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! $request->user()
            || $request->user()->role !== UserRole::Admin
        ) {
            return redirect()->route('customer.home');
        }

        return $next($request);
    }
}