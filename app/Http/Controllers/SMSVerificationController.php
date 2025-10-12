<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\SMSService;

class SMSVerificationController extends Controller
{
    private $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Verificar si la verificación por SMS está habilitada
     */
    private function isSMSEnabled()
    {
        $setting = DB::table('settings')->where('key', 'sms_verification_enabled')->first();
        return $setting && $setting->value === 'true';
    }

    /**
     * Generar código OTP de 6 dígitos
     */
    private function generateOTP()
    {
        return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Enviar código OTP por SMS
     *
     * POST /api/sms/send
     * Body: { "phone": "+521234567890", "type": "signup" }
     */
    public function sendOTP(Request $request)
    {
        // Verificar si SMS está habilitado
        if (!$this->isSMSEnabled()) {
            return response()->json([
                'success' => true,
                'message' => 'Verificación SMS desactivada',
                'sms_enabled' => false
            ]);
        }

        $request->validate([
            'phone' => 'required|string|min:10|max:20',
            'type' => 'required|in:signup,guest_checkout,profile_update,password_reset,guest_order'
        ]);

        $phone = $request->phone;
        $type = $request->type;

        // Formatear número a E.164 si es mexicano
        $formattedPhone = SMSService::formatMexicanPhone($phone);

        // Validar formato E.164
        if (!preg_match('/^\+[1-9]\d{1,14}$/', $formattedPhone)) {
            return response()->json([
                'success' => false,
                'message' => 'Formato de teléfono inválido. Usa formato internacional (+521234567890)'
            ], 400);
        }

        // Generar OTP
        $otp = $this->generateOTP();

        // Limpiar OTPs previos del mismo teléfono y tipo
        DB::table('phone_verifications')
            ->where('phone', $formattedPhone)
            ->where('type', $type)
            ->delete();

        // Enviar SMS
        $smsResult = $this->smsService->sendOTP($formattedPhone, $otp);

        if (!$smsResult['success']) {
            \Log::error('Error enviando SMS', [
                'phone' => $formattedPhone,
                'error' => $smsResult['error']
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error enviando SMS de verificación',
                'error' => app()->environment('local') ? $smsResult['error'] : 'Error interno'
            ], 500);
        }

        // Guardar OTP en base de datos
        DB::table('phone_verifications')->insert([
            'phone' => $formattedPhone,
            'otp' => $otp,
            'type' => $type,
            'expires_at' => Carbon::now()->addMinutes(10),
            'used' => false,
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip(),
            'sns_message_id' => $smsResult['message_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \Log::info('OTP SMS enviado exitosamente', [
            'phone' => $formattedPhone,
            'type' => $type,
            'message_id' => $smsResult['message_id']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Código de verificación enviado por SMS',
            'sms_enabled' => true,
            'phone' => $formattedPhone,
            // Solo para testing en desarrollo - REMOVER EN PRODUCCIÓN
            'debug_otp' => app()->environment('local') ? $otp : null
        ]);
    }

    /**
     * Verificar código OTP por SMS
     *
     * POST /api/sms/verify
     * Body: { "phone": "+521234567890", "otp": "123456", "type": "signup" }
     */
    public function verifyOTP(Request $request)
    {
        // Verificar si SMS está habilitado
        if (!$this->isSMSEnabled()) {
            return response()->json([
                'success' => true,
                'message' => 'Verificación SMS desactivada',
                'sms_enabled' => false
            ]);
        }

        $request->validate([
            'phone' => 'required|string|min:10|max:20',
            'otp' => 'required|string|size:6',
            'type' => 'required|in:signup,guest_checkout,profile_update,password_reset,guest_order'
        ]);

        $phone = $request->phone;
        $otp = $request->otp;
        $type = $request->type;

        // Formatear número a E.164
        $formattedPhone = SMSService::formatMexicanPhone($phone);

        // Buscar OTP válido
        $verification = DB::table('phone_verifications')
            ->where('phone', $formattedPhone)
            ->where('otp', $otp)
            ->where('type', $type)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) {
            \Log::warning('OTP inválido o expirado', [
                'phone' => $formattedPhone,
                'type' => $type
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Código OTP inválido o expirado'
            ], 400);
        }

        // Marcar OTP como usado
        DB::table('phone_verifications')
            ->where('id', $verification->id)
            ->update([
                'used' => true,
                'updated_at' => now()
            ]);

        \Log::info('Teléfono verificado exitosamente', [
            'phone' => $formattedPhone,
            'type' => $type
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Teléfono verificado correctamente',
            'sms_enabled' => true
        ]);
    }

    /**
     * Reenviar código OTP
     *
     * POST /api/sms/resend
     * Body: { "phone": "+521234567890", "type": "signup" }
     */
    public function resendOTP(Request $request)
    {
        // Verificar límite de reintentos (máximo 3 en 1 hora)
        $formattedPhone = SMSService::formatMexicanPhone($request->phone);

        $recentAttempts = DB::table('phone_verifications')
            ->where('phone', $formattedPhone)
            ->where('created_at', '>', Carbon::now()->subHour())
            ->count();

        if ($recentAttempts >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Has alcanzado el límite de intentos. Intenta nuevamente en 1 hora.'
            ], 429);
        }

        // Reutilizar el método sendOTP
        return $this->sendOTP($request);
    }

    /**
     * Verificar estado del servicio SMS
     *
     * GET /api/sms/status
     */
    public function checkStatus()
    {
        $isEnabled = $this->isSMSEnabled();
        $smsServiceReady = $this->smsService->isEnabled();

        return response()->json([
            'sms_verification_enabled' => $isEnabled,
            'aws_sns_configured' => $smsServiceReady,
            'ready' => $isEnabled && $smsServiceReady
        ]);
    }
}
