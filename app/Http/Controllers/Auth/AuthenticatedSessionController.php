<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request)
{
    try {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user is active
            if (!$user->isActive()) {
                Auth::logout();
                return response()->json(['status' => 'error', 'message' => 'Account not active. Contact Admin'], 422);
            }

            if ($user->is_active !== 'active') {
                Auth::logout();
                return response()->json(['status' => 'error', 'message' => 'Account is not active. Contact Admin'], 422);
            }

            $request->session()->regenerate();

            return redirect()->to('/dashboard')->with('success', 'Logged In Successfully');
        } else {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    } catch (ValidationException $e) {
        return response()->json(['status' => 'error', 'errors' => $e->errors()], 422);
    }
}


public function apiLogin(Request $request)
{
    // Validate request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();

    // Check if the user is active
    if (!$user->isActive() || $user->is_active !== 'active') {
        Auth::logout();
        return response()->json(['status' => 'error', 'message' => 'Account is not active. Contact Admin'], 403);
    }

    // Create API token
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => 'success',
        'message' => 'Login successful',
        'user' => $user,
        'token' => $token
    ], 200);
}




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
