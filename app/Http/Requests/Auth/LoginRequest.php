<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        Log::info('AUTH FUNCTION CALLED');

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            Log::warning('Login failed', [
                'email' => $this->input('email'),
                'ip' => $this->ip(),
                'user_agent' => $this->userAgent(),
            ]);

            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return;
        }

        event(new Lockout($this));
        RateLimiter::clear($this->throttleKey());
        RateLimiter::hit($this->throttleKey(), 60);

        $seconds = 60;

        Log::alert('Account locked due to too many login attempts', [
                'email' => $this->input('email'),
                'ip' => $this->ip(),
                'user_agent' => $this->userAgent(),
            ]);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle',[
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])
        ]);
    }




    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return strtolower($this->input('email')) . '|' . $this->ip();
    }
}

