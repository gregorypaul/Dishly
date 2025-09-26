<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            $request->session()->regenerate();

            if ($request->expectsJson()) {
                return response()->json([
                    'user' => new UserResource($user),
                    'token' => $token,
                ], 201);
            }
            return redirect()->intended(RouteServiceProvider::HOME);

            } catch (\Illuminate\Validation\ValidationException $e) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Invalid email or password.',
                        'errors' => $e->errors(),
                    ], 422);
                }

                throw $e; // fallback for non-AJAX
            }
    }

    public function create()
    {
        return view('auth.login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
