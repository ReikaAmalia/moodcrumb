<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsCustomer
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! $request->user()
            || $request->user()->role !== UserRole::Customer
        ) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}