<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * LoginController
 *
 * Flow login manual:
 * 1. LoginRequest::authenticate() → coba Auth::attempt + rate limiting
 * 2. AuthService::loginManual() → regenerate session
 * 3. Redirect berdasarkan role:
 *    - admin    → /admin/dashboard
 *    - customer → /dashboard
 */
class LoginController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {}

    /**
     * Tampilkan form login.
     * GET /login
     */
    public function show(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login manual.
     * POST /login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // LoginRequest::authenticate() sudah handle Auth::attempt + rate limiting
        $request->authenticate();

        // Regenerate session (anti session-fixation attack)
        $this->authService->loginManual();

        // Redirect berdasarkan role
        $redirectUrl = $this->authService->redirectAfterLogin(auth()->user());

        return redirect()->intended($redirectUrl);
    }

    /**
     * Logout.
     * POST /logout
     */
    public function destroy(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()
            ->route('login')
            ->with('success', 'Kamu berhasil keluar. Sampai jumpa lagi! 👋');
    }
}