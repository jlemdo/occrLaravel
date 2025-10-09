<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;  

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     * 
     * 
     */
     
     
    public function store(Request $request): RedirectResponse
    {
		//dd('here');
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
    
    //forgetpasswordlink - MOBILE APP VERSION
     public function forgetPasswordLink(Request $request): JsonResponse
    {
        // 1️⃣ Validate input
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // 2️⃣ Find user by email
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json([
                'message' => 'Email address not found.',
            ], 404);
        }

        // 3️⃣ Generate temporary password (6 digits, easy to type)
        $tempPassword = sprintf('%06d', rand(100000, 999999));
        
        // 4️⃣ Update user password
        $user->password = \Hash::make($tempPassword);
        $user->save();
        
        // 5️⃣ Send email with temporary password using beautiful template
        try {
            \Mail::send('emails.temporary-password', [
                'user' => $user,
                'temporaryPassword' => $tempPassword
            ], function($message) use ($user) {
                $message->to($user->email)
                       ->subject('🔑 Nueva contraseña temporal - OCCR Productos');
            });
            
            return response()->json([
                'message' => 'Nueva contraseña enviada a tu correo. Revisa tu bandeja de entrada.',
                'success' => true
            ], 200);
            
        } catch (\Exception $e) {
            // Si falla el email, revertir el cambio de contraseña
            $user->password = $user->getOriginal('password');
            $user->save();
            
            return response()->json([
                'message' => 'Error enviando email. Intenta de nuevo.',
                'success' => false
            ], 500);
        }
    }
    
}
