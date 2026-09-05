<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * RegisterController
 *
 * Sangat tipis:
 * - show() → return view
 * - store() → validate (FormRequest) → delegate ke AuthService → redirect ke LOGIN
 *
 * Setelah register berhasil: TIDAK auto-login, langsung ke halaman login
 * dengan pesan sukses. User harus login manual.
 */
class RegisterController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {}

    /**
     * Tampilkan form registrasi.
     * GET /register
     */
    public function show(): View
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi.
     * POST /register
     *
     * Flow:
     * 1. RegisterRequest validasi input
     * 2. AuthService::register() buat user baru
     * 3. Redirect ke /login dengan pesan sukses
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->authService->register($request->validated());

        return redirect()
            ->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan masuk dengan email dan password kamu. 🍪');
    }
}