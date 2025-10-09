<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CommunicationService
{
    /**
     * Enviar comunicación a un usuario usando la mejor estrategia disponible
     */
    public static function sendToUser(User $user, $subject, $message, $type = 'general')
    {
        $sent = false;
        $methods = [];

        // Estrategia 1: Email (si es posible)
        if ($user->canReceiveEmails()) {
            try {
                // Aquí iría la lógica de envío de email
                // Mail::to($user->email)->send(new YourEmailClass($subject, $message));
                $methods[] = 'email';
                $sent = true;
                
                Log::info('Email sent successfully', [
                    'user_id' => $user->id,
                    'email_type' => $user->email_type,
                    'subject' => $subject
                ]);
            } catch (\Exception $e) {
                Log::error('Email send failed', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Estrategia 2: Push Notification (si es posible)
        if ($user->canReceivePushNotifications()) {
            try {
                self::sendPushNotification($user, $subject, $message, $type);
                $methods[] = 'push';
                $sent = true;
                
                Log::info('Push notification sent successfully', [
                    'user_id' => $user->id,
                    'fcm_token' => substr($user->fcm_token, 0, 20) . '...',
                    'subject' => $subject
                ]);
            } catch (\Exception $e) {
                Log::error('Push notification send failed', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Log resultado
        Log::info('Communication attempt completed', [
            'user_id' => $user->id,
            'communication_strategy' => $user->communication_strategy,
            'methods_attempted' => $methods,
            'sent' => $sent,
            'can_receive_emails' => $user->canReceiveEmails(),
            'can_receive_push' => $user->canReceivePushNotifications()
        ]);

        return [
            'sent' => $sent,
            'methods' => $methods,
            'strategy' => $user->communication_strategy
        ];
    }

    /**
     * Enviar notificación push usando FCM
     */
    private static function sendPushNotification(User $user, $title, $body, $type = 'general')
    {
        if (empty($user->fcm_token)) {
            throw new \Exception('No FCM token available');
        }

        // Configuración de la notificación
        $notification = [
            'title' => $title,
            'body' => $body,
            'sound' => 'default',
        ];

        $data = [
            'type' => $type,
            'user_id' => $user->id,
            'timestamp' => now()->toISOString()
        ];

        // Aquí iría la lógica real de FCM
        // Para ahora, simulamos el envío exitoso
        return true;
    }

    /**
     * Verificar la comunicabilidad de un usuario
     */
    public static function getUserCommunicationStatus(User $user)
    {
        return [
            'can_receive_emails' => $user->canReceiveEmails(),
            'can_receive_push' => $user->canReceivePushNotifications(),
            'strategy' => $user->communication_strategy,
            'email_type' => $user->email_type,
            'email_description' => $user->email_type_description,
            'has_fcm_token' => !empty($user->fcm_token),
            'recommendations' => self::getRecommendations($user)
        ];
    }

    /**
     * Obtener recomendaciones para mejorar la comunicación
     */
    private static function getRecommendations(User $user)
    {
        $recommendations = [];

        if (!$user->canReceiveEmails() && $user->email_type === 'generated') {
            $recommendations[] = 'Usuario con Apple ID sin email - depende únicamente de notificaciones push';
        }

        if (!$user->canReceivePushNotifications()) {
            $recommendations[] = 'Falta FCM token - solicitar permisos de notificación en la app';
        }

        if ($user->communication_strategy === 'none') {
            $recommendations[] = 'Sin métodos de comunicación disponibles - usuario incomunicable';
        }

        return $recommendations;
    }

    /**
     * Enviar notificación de pedido (ejemplo de uso específico)
     */
    public static function sendOrderNotification(User $user, $orderData)
    {
        $subject = "Actualización de tu pedido #{$orderData['order_id']}";
        $message = "Actualización disponible sobre tu pedido.";
        
        if (isset($orderData['estimated_delivery'])) {
            $message .= " Entrega estimada: {$orderData['estimated_delivery']}.";
        }

        return self::sendToUser($user, $subject, $message, 'order');
    }
}