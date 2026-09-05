<?php

namespace App\Services\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as SocialiteUser;

/**
 * AuthService
 *
 * Semua business logic terkait autentikasi:
 * - Registrasi manual
 * - Login manual (delegate ke LoginRequest)
 * - Google OAuth (find-or-create)
 * - Logout
 * - Redirect berdasarkan role
 *
 * Controller tetap tipis — hanya memanggil method di sini.
 */
class AuthService
{
    /**
     * Daftarkan pengguna baru dan langsung login.
     *
     * Business rules:
     * - Role default selalu 'customer'
     * - Password di-hash otomatis
     * - Setelah register, TIDAK auto-login → redirect ke login dengan pesan sukses
     */
    public function register(array $data): User
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role'     => UserRole::Customer->value, // selalu customer saat register
        ]);

        return $user;
    }

    /**
     * Login manual — dipanggil setelah LoginRequest::authenticate() berhasil.
     * Regenerasi session untuk keamanan (anti session-fixation).
     */
    public function loginManual(): void
    {
        request()->session()->regenerate();
    }

    /**
     * Google OAuth — find-or-create user.
     *
     * Business rules:
     * - Jika email sudah ada (akun manual), link google_id ke akun existing
     * - Jika belum ada, buat akun baru dengan role customer
     * - Password di-set null (tidak bisa login manual jika hanya OAuth)
     */
    public function findOrCreateFromGoogle(SocialiteUser $googleUser): User
    {
        // Cari berdasarkan google_id dulu
        $user = User::where('google_id', $googleUser->getId())->first();

        if ($user) {
            return $user;
        }

        // Cari berdasarkan email (akun manual yang belum link Google)
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Link google_id ke akun yang sudah ada
            $user->update(['google_id' => $googleUser->getId()]);
            return $user;
        }

        // Buat akun baru via Google
        return User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password'  => null,              // tidak bisa login manual
            'role'      => UserRole::Customer->value,
        ]);
    }

    /**
     * Login via Google — setelah user ditemukan/dibuat.
     */
    public function loginWithGoogle(User $user): void
    {
        Auth::login($user, remember: true);
        request()->session()->regenerate();
    }

    /**
     * Logout — invalidate session dan regenerate token.
     */
    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    /**
     * Tentukan URL redirect setelah login berhasil berdasarkan role user.
     */
    public function redirectAfterLogin(User $user): string
    {
        return $user->role->redirectAfterLogin();
    }
}