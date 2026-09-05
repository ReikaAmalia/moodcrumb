<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

/**
 * GoogleController
 *
 * Menangani alur Google OAuth 2.0:
 * 1. redirect() → arahkan user ke consent screen Google
 * 2. callback() → terima data dari Google, find-or-create user, login, redirect
 *
 * Membutuhkan:
 * - composer require laravel/socialite
 * - config/services.php: google client_id, client_secret, redirect
 * - .env: GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REDIRECT_URI
 */
class GoogleController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {}

    /**
     * Redirect ke Google consent screen.
     * GET /auth/google/redirect
     */
    public function redirect(): RedirectResponse
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
        $driver = Socialite::driver('google');

        return $driver->scopes(['openid', 'profile', 'email'])->redirect();
    }

    /**
     * Callback setelah Google autentikasi.
     * GET /auth/google/callback
     *
     * Flow:
     * 1. Ambil data user dari Google
     * 2. AuthService::findOrCreateFromGoogle() → cari atau buat akun
     * 3. AuthService::loginWithGoogle() → login + regenerate session
     * 4. Redirect berdasarkan role
     */
    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            // User cancel atau error dari Google
            return redirect()
                ->route('login')
                ->with('error', 'Login dengan Google dibatalkan atau gagal. Silakan coba lagi.');
        }

        // Find atau create user
        $user = $this->authService->findOrCreateFromGoogle($googleUser);

        // Login
        $this->authService->loginWithGoogle($user);

        // Redirect berdasarkan role
        $redirectUrl = $this->authService->redirectAfterLogin($user);

        return redirect($redirectUrl);
    }
}