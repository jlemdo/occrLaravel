<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Exception;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    private $messaging;

    public function __construct()
    {
        try {
            // 🔧 FIX: Usar config() en lugar de env() para que funcione con config:cache
            // Verificar que las variables de entorno estén configuradas
            if (!config('firebase.project_id') || !config('firebase.private_key')) {
                Log::warning('Firebase credentials not configured, push notifications will be disabled');
                $this->messaging = null;
                return;
            }

            // Inicializar Firebase con credenciales del config
            $firebase = (new Factory())
                ->withServiceAccount([
                    'type' => 'service_account',
                    'project_id' => config('firebase.project_id'),
                    'private_key_id' => config('firebase.private_key_id'),
                    'private_key' => str_replace('\\n', "\n", config('firebase.private_key') ?? ''),
                    'client_email' => config('firebase.client_email'),
                    'client_id' => config('firebase.client_id'),
                    'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                    'token_uri' => 'https://oauth2.googleapis.com/token',
                ]);

            $this->messaging = $firebase->createMessaging();
            Log::info('Firebase messaging service initialized successfully');
        } catch (Exception $e) {
            Log::error('Firebase initialization failed: ' . $e->getMessage());
            $this->messaging = null;
        }
    }

    /**
     * 🔒 VALIDAR que el token pertenece al usuario correcto
     */
    private function validateTokenForUser($fcmToken, $userId = null, $guestId = null)
    {
        try {
            if ($guestId) {
                // Verificar guest
                $guest = \App\Models\GuestAddress::where('id', $guestId)
                    ->where('fcm_token', $fcmToken)
                    ->whereNotNull('session_id')
                    ->first();
                return $guest ? true : false;
            } else if ($userId) {
                // Verificar usuario registrado
                $user = \App\Models\User::where('id', $userId)
                    ->where('fcm_token', $fcmToken)
                    ->whereNotNull('session_id')
                    ->first();
                return $user ? true : false;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Token validation error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Enviar notificación push a un dispositivo específico
     */
    public function sendToDevice($fcmToken, $title, $body, $data = [])
    {
        try {
            if (!$this->messaging) {
                Log::error('Firebase messaging not initialized');
                return false;
            }

            $notification = Notification::create($title, $body);

            $message = CloudMessage::withTarget('token', $fcmToken)
                ->withNotification($notification)
                ->withData($data);

            $result = $this->messaging->send($message);

            Log::info('Push notification sent successfully', [
                'token' => substr($fcmToken, 0, 20) . '...',
                'title' => $title,
                'result' => $result
            ]);

            return true;
        } catch (Exception $e) {
            Log::error('Failed to send push notification: ' . $e->getMessage(), [
                'token' => substr($fcmToken, 0, 20) . '...',
                'title' => $title,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Enviar notificación push a múltiples dispositivos
     */
    public function sendToMultipleDevices($fcmTokens, $title, $body, $data = [])
    {
        $results = [];
        foreach ($fcmTokens as $token) {
            $results[] = $this->sendToDevice($token, $title, $body, $data);
        }
        return $results;
    }

    /**
     * Enviar notificación push a un tópico
     */
    public function sendToTopic($topic, $title, $body, $data = [])
    {
        try {
            if (!$this->messaging) {
                Log::error('Firebase messaging not initialized');
                return false;
            }

            $notification = Notification::create($title, $body);

            $message = CloudMessage::withTarget('topic', $topic)
                ->withNotification($notification)
                ->withData($data);

            $result = $this->messaging->send($message);

            Log::info('Topic notification sent successfully', [
                'topic' => $topic,
                'title' => $title,
                'result' => $result
            ]);

            return true;
        } catch (Exception $e) {
            Log::error('Failed to send topic notification: ' . $e->getMessage(), [
                'topic' => $topic,
                'title' => $title,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * 🔪 CIRUGÍA: Helper mejorado para notificaciones con tipos específicos
     */
    public function sendOrderNotification($fcmToken, $orderNumber, $status, $message = null, $internalOrderId = null)
    {
        // 🔧 Mapeo de tipos backend → frontend específicos
        $statusMapping = [
            'confirmed' => 'order_confirmed',
            'preparing' => 'order_preparing',
            'ready' => 'order_ready',
            'on_the_way' => 'order_on_way',
            'delivered' => 'order_delivered',
            'cancelled' => 'order_cancelled',
        ];

        // 🎯 USAR NÚMERO DE ORDEN FORMATEADO PARA MOSTRAR AL USUARIO
        $title = "Pedido #$orderNumber";
        $body = $message ?: "Actualización de tu pedido #$orderNumber";

        // 🎯 Usar tipo específico que el frontend espera
        $frontendType = $statusMapping[$status] ?? 'order_status_update';

        $data = [
            'type' => $frontendType,
            'order_id' => (string)($internalOrderId ?: $orderNumber), // ID interno para navegación
            'order_number' => (string)$orderNumber, // Número formateado para mostrar
            'order_status' => $status
        ];

        return $this->sendToDevice($fcmToken, $title, $body, $data);
    }

    /**
     * 💬 NUEVO: Enviar notificación de chat entre driver y customer
     */
    public function sendChatNotification($fcmToken, $orderNumber, $senderName, $message, $senderType, $internalOrderId = null)
    {
        try {
            // 🎯 Título basado en quién envía el mensaje
            $title = $senderType === 'driver'
                ? "Mensaje de tu repartidor"
                : "Nuevo mensaje - Pedido #$orderNumber";

            // 🎯 Body con nombre del remitente y preview del mensaje
            $messagePreview = strlen($message) > 80 ? substr($message, 0, 80) . '...' : $message;
            $body = "$senderName: $messagePreview";

            // 🎯 Data para navegación automática al chat
            $data = [
                'type' => 'chat_message',
                'order_id' => (string)($internalOrderId ?: $orderNumber),
                'order_number' => (string)$orderNumber,
                'sender_type' => $senderType,
                'sender_name' => $senderName,
                'message_preview' => $messagePreview,
                'timestamp' => now()->toISOString()
            ];

            Log::info('Sending chat notification', [
                'order_number' => $orderNumber,
                'sender_type' => $senderType,
                'sender_name' => $senderName,
                'token_preview' => substr($fcmToken, 0, 20) . '...'
            ]);

            return $this->sendToDevice($fcmToken, $title, $body, $data);

        } catch (\Exception $e) {
            Log::error('Failed to send chat notification', [
                'order_number' => $orderNumber,
                'sender_type' => $senderType,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * 🔒 NUEVO: Enviar notificación CON VALIDACIÓN de usuario
     */
    public function sendToValidatedUser($userId, $title, $body, $data = [], $userType = 'user')
    {
        try {
            // Obtener usuario y su token
            if ($userType === 'guest') {
                $user = \App\Models\GuestAddress::find($userId);
            } else {
                $user = \App\Models\User::find($userId);
            }

            if (!$user || !$user->fcm_token || !$user->session_id) {
                Log::warning('User has no valid FCM token or session', [
                    'user_id' => $userId,
                    'user_type' => $userType,
                    'has_token' => !empty($user->fcm_token ?? null),
                    'has_session' => !empty($user->session_id ?? null)
                ]);
                return false;
            }

            // Validar que el token pertenece al usuario
            $isValid = $this->validateTokenForUser(
                $user->fcm_token,
                $userType === 'guest' ? null : $userId,
                $userType === 'guest' ? $userId : null
            );

            if (!$isValid) {
                Log::warning('Token validation failed - notification not sent', [
                    'user_id' => $userId,
                    'user_type' => $userType,
                    'token_preview' => substr($user->fcm_token, 0, 20) . '...'
                ]);
                return false;
            }

            // Agregar session_id a los datos
            $data['session_id'] = $user->session_id;

            // Enviar notificación
            return $this->sendToDevice($user->fcm_token, $title, $body, $data);

        } catch (\Exception $e) {
            Log::error('Failed to send validated notification', [
                'user_id' => $userId,
                'user_type' => $userType,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
