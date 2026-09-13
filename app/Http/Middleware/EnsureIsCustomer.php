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
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== UserRole::Customer) {
            return redirect($request->user()->role->redirectAfterLogin())
                ->with('error', 'Halaman ini khusus untuk pelanggan.');
        }

        return $next($request);
    }
}