<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Nombre maximal de tentatives avant verrouillage.
     */
    protected int $maxAttempts = 3;

    /**
     * Durée du verrouillage en secondes.
     */
    protected int $decaySeconds = 60;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            Log::warning('Login failed', [
                'email' => $this->input('email'),
                'ip' => $this->ip(),
                'user_agent' => $this->userAgent(),
            ]);

            // Incrémente le compteur et démarre / prolonge la fenêtre de verrouillage
            $attempts = RateLimiter::hit($this->throttleKey(), $this->decaySeconds);

            // Au moment exact où le seuil est atteint, on affiche 60 secondes fixes
            if ($attempts >= $this->maxAttempts) {
                event(new Lockout($this));

                Log::alert('Account locked due to too many login attempts', [
                    'email' => $this->input('email'),
                    'ip' => $this->ip(),
                    'user_agent' => $this->userAgent(),
                    'seconds_remaining' => $this->decaySeconds,
                ]);

                throw ValidationException::withMessages([
                    'email' => "Trop de tentatives de connexion. Réessayez dans {$this->decaySeconds} secondes.",
                ]);
            }

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => "Trop de tentatives de connexion. Réessayez dans {$seconds} secondes.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(
            $this->string('email')->lower().'|'.$this->ip()
        );
    }
}