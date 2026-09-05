<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * RegisterRequest
 *
 * Validasi input pendaftaran akun baru.
 * Semua aturan bisnis validasi terpusat di sini.
 */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // siapapun boleh mendaftar
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'min:2', 'max:100'],
            'email'    => ['required', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'phone'    => ['nullable', 'string', 'regex:/^[0-9]{9,15}$/', 'max:20'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised(3), // cek breach database
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'          => 'Nama lengkap wajib diisi.',
            'name.min'               => 'Nama minimal 2 karakter.',
            'name.max'               => 'Nama maksimal 100 karakter.',
            'email.required'         => 'Alamat email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email ini sudah terdaftar. Silakan gunakan email lain atau masuk.',
            'phone.regex'            => 'Nomor telepon hanya boleh berisi angka (9–15 digit).',
            'password.required'      => 'Password wajib diisi.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
            'password.min'           => 'Password minimal 8 karakter.',
            'password.mixed_case'    => 'Password harus mengandung huruf besar dan kecil.',
            'password.numbers'       => 'Password harus mengandung setidaknya satu angka.',
            'password.uncompromised' => 'Password ini terlalu umum dan tidak aman. Gunakan password yang lebih unik.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'     => 'nama lengkap',
            'email'    => 'email',
            'phone'    => 'nomor telepon',
            'password' => 'password',
        ];
    }

    /**
     * Normalisasi input sebelum validasi.
     * Trim whitespace dan format nomor telepon.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'  => trim($this->name ?? ''),
            'email' => strtolower(trim($this->email ?? '')),
            'phone' => $this->phone
                ? preg_replace('/[^0-9]/', '', $this->phone) // hapus non-digit
                : null,
        ]);
    }
}