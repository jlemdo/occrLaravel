<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OTPController extends Controller
{
    // Verificar si OTP está activado
    private function isOTPEnabled()
    {
        $setting = DB::table('settings')->where('key', 'otp_verification_enabled')->first();
        return $setting && $setting->value === 'true';
    }

    // Generar código OTP
    private function generateOTP()
    {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    // Enviar OTP por email
    public function sendOTP(Request $request)
    {
        // Verificar si OTP está activado
        if (!$this->isOTPEnabled()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP desactivado, verificación omitida',
                'otp_enabled' => false
            ]);
        }

        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:signup,guest_checkout,profile_update,guest_order'
        ]);

        $email = $request->email;
        $type = $request->type;
        $otp = $this->generateOTP();

        // Limpiar OTPs expirados del mismo email
        DB::table('email_verifications')
            ->where('email', $email)
            ->where('type', $type)
            ->delete();

        // Crear nuevo OTP
        DB::table('email_verifications')->insert([
            'email' => $email,
            'otp' => $otp,
            'type' => $type,
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Enviar email profesional
        try {
            $actionDescriptions = [
                'signup' => 'tu registro en OCCR Productos',
                'guest_checkout' => 'tu compra como invitado',
                'profile_update' => 'la actualización de tu perfil',
                'guest_order' => 'el acceso a tus pedidos'
            ];

            Mail::send('emails.otp-verification', [
                'otpCode' => $otp,
                'actionDescription' => $actionDescriptions[$type] ?? 'tu solicitud',
                'userType' => strpos($type, 'guest') !== false ? 'guest' : 'registered'
            ], function ($message) use ($email) {
                $message->to($email)
                        ->subject('🔐 Código de Verificación - OCCR Productos')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            \Log::info("OTP enviado exitosamente a {$email}: {$otp} (tipo: {$type})");
            
            return response()->json([
                'success' => true,
                'message' => 'Código OTP enviado al email',
                'otp_enabled' => true,
                // Solo para testing en desarrollo - remover en producción
                'debug_otp' => app()->environment('local') ? $otp : null
            ]);
        } catch (\Exception $e) {
            \Log::error("Error enviando OTP email: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error enviando email de verificación',
                'error' => app()->environment('local') ? $e->getMessage() : 'Error interno'
            ], 500);
        }
    }

    // Verificar OTP
    public function verifyOTP(Request $request)
    {
        // Verificar si OTP está activado
        if (!$this->isOTPEnabled()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP desactivado, verificación omitida',
                'otp_enabled' => false
            ]);
        }

        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'type' => 'required|in:signup,guest_checkout,profile_update,guest_order'
        ]);

        $email = $request->email;
        $otp = $request->otp;
        $type = $request->type;

        // Buscar OTP válido
        $verification = DB::table('email_verifications')
            ->where('email', $email)
            ->where('otp', $otp)
            ->where('type', $type)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Código OTP inválido o expirado'
            ], 400);
        }

        // Marcar como usado
        DB::table('email_verifications')
            ->where('id', $verification->id)
            ->update([
                'used' => true,
                'updated_at' => now()
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Email verificado correctamente',
            'otp_enabled' => true
        ]);
    }
}