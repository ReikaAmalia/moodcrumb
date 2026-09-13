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
        // Belum login sama sekali → ke halaman login
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // Sudah login, tapi bukan admin → balikin ke dashboard dia sendiri
        if ($request->user()->role !== UserRole::Admin) {
            return redirect($request->user()->role->redirectAfterLogin())
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}