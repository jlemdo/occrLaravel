<?php

namespace App\Http\Controllers;
use App\Mail\NewBookingEmail;
use App\Models\Aboutus;
use App\Models\Award;
use App\Models\History;
use App\Models\Leads;
use App\Models\Osprojects;
use App\Models\Projectimages;
use App\Models\Pvisits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Socialite;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Http;


//use Google_Client;


class WebSiteController extends Controller
{

    public function index(){
        $title = 'Home';
        return view('auth.login', compact('title'));
    }

    public function shoaib(){
        $title = 'Home';
        //return view('welcome',compact('title'));
        return view('auth.shoaib', compact('title'));
    }

    public function signAuth(){
        $title = 'Signature Authentication';
        return view('signauthpage', compact('title'));
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
Log::info('I am called. id is'. json_encode($googleUser));
            // Separar nombre completo en first_name y last_name
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
            
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'password' => bcrypt(Str::random(24)), // dummy password
                    'email_verified_at' => now(),
                    'is_active' => 'active',
                    'usertype' => 'customer',
                    'provider' => 'google'
                ]
            );

            Auth::login($user);

            return redirect('/dashboard')->with('success', 'Logged in with Google!');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Login failed, try again.');
        }
    }
    
   public function googleLogin(Request $request)
{
    $request->validate([
        'id_token' => 'required|string',
    ]);

    $idToken = $request->id_token;

    // Verify token with Google's public endpoint
    $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
        'id_token' => $idToken
    ]);

    if ($response->successful()) {
        $payload = $response->json();

        // Optional: Check if token is from your app
        if ($payload['aud'] !== config('services.google.client_id')) {
            return response()->json(['error' => 'Invalid token audience'], 403);
        }

        $email = $payload['email'];
        $name = $payload['name'];

        // Separar nombre completo en first_name y last_name
        $nameParts = explode(' ', $name, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
        
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'password' => bcrypt(Str::random(24)),
                'email_verified_at' => now(),
                'is_active' => 'active',
                'usertype' => 'customer',
                'provider' => 'google'
            ]
        );

        $token = $user->createToken('mobile-login')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    } else {
        return response()->json(['error' => 'Invalid ID token'], 401);
    }
}

   public function appleLogin(Request $request)
   {
       $request->validate([
           'identity_token' => 'required|string',
           'user_id' => 'required|string',
           'email' => 'nullable|email',
           'first_name' => 'nullable|string',
           'last_name' => 'nullable|string',
           'has_real_email' => 'boolean',
           'has_real_name' => 'boolean',
       ]);

       $identityToken = $request->identity_token;
       $appleUserId = $request->user_id;
       $email = $request->email;
       $firstName = $request->first_name;
       $lastName = $request->last_name;
       $hasRealEmail = $request->has_real_email ?? false;
       $hasRealName = $request->has_real_name ?? false;

       // 🔐 Detectar si Apple está ocultando el email
       $isPrivateEmail = $email && (
           str_contains($email, 'privaterelay@icloud.com') ||
           str_contains($email, '@privaterelay.appleid.com')
       );

       try {
           // TODO: Para producción - Validar JWT token con Apple's public keys
           // $isValidToken = $this->validateAppleJWT($identityToken);
           // if (!$isValidToken) {
           //     return response()->json(['error' => 'Invalid Apple token'], 401);
           // }

           // Check if user already exists by Apple ID
           $user = User::where('apple_id', $appleUserId)->first();

           if (!$user && $email) {
               // Check if user exists by email
               $user = User::where('email', $email)->first();
               if ($user) {
                   // Link Apple ID to existing account
                   $user->update(['apple_id' => $appleUserId]);
               }
           }

           if (!$user) {
               // ✅ ESTRATEGIA MEJORADA: Usar datos reales cuando estén disponibles
               
               // 📧 Email: Usar real si existe, generar fallback solo si es necesario
               $finalEmail = $email;
               $emailType = 'real';
               
               if (!$hasRealEmail) {
                   // Apple no proporcionó email - generar uno interno limpio
                   $finalEmail = substr(md5($appleUserId), 0, 8) . '@interno.app';
                   $emailType = 'generated';
               } elseif ($email && (str_contains($email, 'privaterelay') || str_contains($email, 'icloud.com'))) {
                   $emailType = 'proxy';
               }
               
               // 👤 Nombre: Usar nombres reales si existen, fallback claro y profesional
               $finalFirstName = $hasRealName && $firstName ? $firstName : 'Usuario';
               $finalLastName = $hasRealName && $lastName ? $lastName : '';
               
               // Create new user with proper flags
               $user = User::create([
                   'apple_id' => $appleUserId,
                   'email' => $finalEmail,
                   'first_name' => $finalFirstName,
                   'last_name' => $finalLastName,
                   'password' => bcrypt(Str::random(24)),
                   'email_verified_at' => $hasRealEmail ? now() : null, // Solo verificar emails reales
                   'is_active' => 'active',
                   'usertype' => 'customer',
                   'provider' => 'apple',
                   'has_real_email' => $hasRealEmail,
                   'email_type' => $emailType,
                   'can_receive_emails' => $hasRealEmail && $emailType !== 'generated'
               ]);
               
               Log::info('Apple Sign-In: User created', [
                   'apple_id' => $appleUserId,
                   'email_type' => $emailType,
                   'has_real_email' => $hasRealEmail,
                   'has_real_name' => $hasRealName,
                   'first_name' => $finalFirstName,
                   'last_name' => $finalLastName,
                   'can_receive_emails' => $hasRealEmail,
                   'final_email' => $finalEmail
               ]);
           }

           $token = $user->createToken('mobile-login')->plainTextToken;

           return response()->json([
               'message' => 'Login successful',
               'token' => $token,
               'user' => $user,
           ]);
       } catch (Exception $e) {
           Log::error('Apple Sign-In error: ' . $e->getMessage());
           return response()->json(['error' => 'Apple Sign-In failed, try again.'], 401);
       }
   }

   // TODO: Implementar para producción
   public function appleWebhook(Request $request)
   {
       // Handle server-to-server notifications from Apple
       // Events: email_disabled, email_enabled, consent_withdrawn, account_delete
       
       Log::info('Apple webhook received:', $request->all());
       
       // Verify the JWT signature
       // Update user status based on event type
       
       return response()->json(['status' => 'received']);
   }

   
   /**
    * 🧪 TESTING: Endpoint para verificar comunicación de usuarios Apple
    */
   public function testAppleCommunication(Request $request)
   {
       $request->validate([
           'user_id' => 'required|integer|exists:users,id'
       ]);

       $user = User::find($request->user_id);
       
       if (!$user) {
           return response()->json(['error' => 'Usuario no encontrado'], 404);
       }

       // Importar el servicio
       $communicationStatus = \App\Services\CommunicationService::getUserCommunicationStatus($user);
       
       return response()->json([
           'user_info' => [
               'id' => $user->id,
               'email' => $user->email,
               'first_name' => $user->first_name,
               'provider' => $user->provider,
               'apple_id' => $user->apple_id
           ],
           'communication_status' => $communicationStatus,
           'email_details' => [
               'has_real_email' => $user->has_real_email,
               'email_type' => $user->email_type,
               'can_receive_emails' => $user->can_receive_emails,
               'email_verified_at' => $user->email_verified_at
           ],
           'notification_details' => [
               'fcm_token' => $user->fcm_token ? 'Present (' . substr($user->fcm_token, 0, 20) . '...)' : 'Not set',
               'can_receive_push' => $user->canReceivePushNotifications()
           ]
       ]);
   }
}
