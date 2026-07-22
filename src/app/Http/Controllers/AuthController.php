<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('guest', only: ['create', 'store']),
            new Middleware('auth', only: ['destroy']),
        ];
    }

    /**
     * Show the form for Login.
     */
    public function create()
    {
        return inertia('Auth/Login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
}
