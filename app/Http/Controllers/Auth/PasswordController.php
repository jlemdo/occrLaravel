<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\JsonResponse; 
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
     
     
     
     
     
     
     
     
     
     
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
            'show_password' => $request->password,   
        ]);

        return back()->with('success', 'password-updated');
    }
    
    //updateusepassword
    
    public function updateusepassword(Request $request): JsonResponse
    {
        /* 1️⃣ Validate data */
        $request->validate([
            'userid'            => ['required', 'integer', 'exists:users,id'],
            'current_password'  => ['required', 'string'],
            'password'          => [
                'required',
                'confirmed',                
            ],
        ]);

        /* 2️⃣ Fetch the user */
        $user = User::find($request->userid);

        /* 3️⃣ Verify the current password */
        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect.',
            ], 401);
        }

        /* 4️⃣ Update the password */
        $user->update([
            'password'      => Hash::make($request->password),  // secure hash
            'show_password' => $request->password,              // ⚠️ raw (see note below)
        ]);

        /* 5️⃣ Return success */
        return response()->json([
            'message' => 'Password updated successfully.',
            'user'    => $user->fresh(),   // optional – remove if you don’t want to expose data
        ], 200);
    }
    
    
}
