<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Apakah request ini diizinkan?
     * Karena ini form login, selalu izinkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi form login.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Coba autentikasi user dengan kredensial dari form.
     *
     * @throws ValidationException jika gagal login
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Coba login dengan email dan password
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // Jika gagal, tambahkan hit ke rate limiter
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'), // "Email atau password salah"
            ]);
        }

        // Jika berhasil login, bersihkan rate limit
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Pastikan user tidak kena rate limit (brute force protection).
     *
     * @throws ValidationException jika terlalu banyak percobaan
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Kunci identifikasi untuk rate limiter.
     * Kombinasi email + IP address user.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
