<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    /**
     * Enviar email de bienvenida con validación inteligente
     */
    public static function sendWelcomeEmail($user)
    {
        try {
            // ✅ VALIDACIÓN INTELIGENTE: Verificar si puede recibir emails
            if (!$user->canReceiveEmails()) {
                Log::info("Welcome email skipped for user {$user->id}: {$user->email_type_description}");
                
                // 🔄 FALLBACK: Usar CommunicationService para push notification si está disponible
                if (class_exists('\App\Services\CommunicationService')) {
                    \App\Services\CommunicationService::sendToUser(
                        $user, 
                        '🎉 ¡Bienvenido a OCCR Productos!', 
                        'Tu cuenta ha sido creada exitosamente. ¡Disfruta de nuestros productos lácteos!',
                        'welcome'
                    );
                }
                return;
            }

            Mail::send('emails.welcome', [
                'userName' => $user->name ?? $user->first_name . ' ' . $user->last_name,
            ], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('🎉 ¡Bienvenido a OCCR Productos!')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info("Welcome email sent to {$user->email} (Type: {$user->email_type})");
        } catch (\Exception $e) {
            Log::error("Error sending welcome email: " . $e->getMessage());
        }
    }

    /**
     * Enviar email de confirmación de pedido con validación inteligente
     */
    public static function sendOrderConfirmedEmail($order, $orderItems = [], $customerData = [])
    {
        try {
            $emailData = [
                'customerName' => $customerData['name'] ?? 'Cliente',
                'orderNumber' => $order['id'] ?? $order['order_id'] ?? '000',
                'orderDate' => now()->format('d/m/Y H:i'),
                'orderItems' => $orderItems,
                'total' => $order['amount_paid'] ?? $order['total'] ?? 0,
                'deliveryAddress' => $order['delivery_address'] ?? $customerData['address'] ?? 'Por confirmar',
                'deliveryDate' => $order['delivery_date'] ?? 'A confirmar',
                'deliveryTime' => $order['delivery_slot'] ?? 'A confirmar',
                'paymentMethod' => $order['payment_method'] ?? 'Tarjeta',
                'paymentStatus' => 'confirmed'
            ];

            $email = $customerData['email'] ?? $order['user_email'] ?? null;
            if (!$email) return;

            // 🔍 DETECCIÓN INTELIGENTE: Determinar si es usuario registrado o guest
            $user = \App\Models\User::where('email', $email)->first();
            
            if ($user) {
                // 👤 USUARIO REGISTRADO: Usar validación inteligente
                if (!$user->canReceiveEmails()) {
                    Log::info("Order confirmed email skipped for user {$user->id}: {$user->email_type_description}");
                    
                    // 🔄 FALLBACK: Usar CommunicationService 
                    if (class_exists('\App\Services\CommunicationService')) {
                        \App\Services\CommunicationService::sendToUser(
                            $user, 
                            "✅ Pedido #{$emailData['orderNumber']} Confirmado", 
                            "Tu pedido ha sido confirmado. Total: $" . number_format($emailData['total'], 2),
                            'order'
                        );
                    }
                    return;
                }
                Log::info("Order confirmed email sending to registered user {$user->id} ({$user->email_type})");
            } else {
                // 🕶️ USUARIO GUEST: Siempre enviar email (tienen email válido)
                Log::info("Order confirmed email sending to guest: {$email}");
            }

            Mail::send('emails.order-confirmed', $emailData, function ($message) use ($email, $emailData) {
                $message->to($email)
                        ->subject("✅ Pedido #{$emailData['orderNumber']} Confirmado - OCCR Productos")
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info("Order confirmed email sent for order #{$emailData['orderNumber']} to {$email}");
        } catch (\Exception $e) {
            Log::error("Error sending order confirmed email: " . $e->getMessage());
        }
    }

    /**
     * Enviar email de pedido entregado con validación inteligente
     */
    public static function sendOrderDeliveredEmail($order, $orderItems = [], $customerData = [])
    {
        try {
            $emailData = [
                'customerName' => $customerData['name'] ?? 'Cliente',
                'orderNumber' => $order['id'] ?? $order['order_id'] ?? '000',
                'deliveredAt' => now()->format('d/m/Y H:i'),
                'orderItems' => $orderItems,
                'receivedBy' => $customerData['name'] ?? 'Cliente',
            ];

            $email = $customerData['email'] ?? $order['user_email'] ?? null;
            if (!$email) return;

            // 🔍 DETECCIÓN INTELIGENTE: Determinar si es usuario registrado o guest
            $user = \App\Models\User::where('email', $email)->first();
            
            if ($user) {
                // 👤 USUARIO REGISTRADO: Usar validación inteligente
                if (!$user->canReceiveEmails()) {
                    Log::info("Order delivered email skipped for user {$user->id}: {$user->email_type_description}");
                    
                    // 🔄 FALLBACK: Usar CommunicationService 
                    if (class_exists('\App\Services\CommunicationService')) {
                        \App\Services\CommunicationService::sendToUser(
                            $user, 
                            "🎉 Pedido #{$emailData['orderNumber']} Entregado", 
                            "Tu pedido ha sido entregado exitosamente. ¡Esperamos que lo disfrutes!",
                            'order'
                        );
                    }
                    return;
                }
                Log::info("Order delivered email sending to registered user {$user->id} ({$user->email_type})");
            } else {
                // 🕶️ USUARIO GUEST: Siempre enviar email (tienen email válido)
                Log::info("Order delivered email sending to guest: {$email}");
            }

            Mail::send('emails.order-delivered', $emailData, function ($message) use ($email, $emailData) {
                $message->to($email)
                        ->subject("🎉 Pedido #{$emailData['orderNumber']} Entregado - OCCR Productos")
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info("Order delivered email sent for order #{$emailData['orderNumber']} to {$email}");
        } catch (\Exception $e) {
            Log::error("Error sending order delivered email: " . $e->getMessage());
        }
    }

    /**
     * Método para pruebas - enviar cualquier email
     */
    public function testEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:welcome,order-confirmed,order-delivered,oxxo-pending,password-reset'
        ]);

        $testData = [
            'customerName' => 'Juan Pérez',
            'orderNumber' => '12345',
            'total' => 299.99,
            'orderItems' => [
                ['name' => 'Leche Entera 1L', 'quantity' => 2, 'price' => 35.50],
                ['name' => 'Yogurt Natural 500g', 'quantity' => 1, 'price' => 45.00]
            ]
        ];

        try {
            switch ($request->type) {
                case 'welcome':
                    self::sendWelcomeEmail((object)['email' => $request->email, 'name' => 'Cliente Test']);
                    break;
                case 'order-confirmed':
                    self::sendOrderConfirmedEmail(['id' => '12345', 'amount_paid' => 299.99], $testData['orderItems'], ['email' => $request->email, 'name' => $testData['customerName']]);
                    break;
                case 'order-delivered':
                    self::sendOrderDeliveredEmail(['id' => '12345'], $testData['orderItems'], ['email' => $request->email, 'name' => $testData['customerName']]);
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => "Email de prueba '{$request->type}' enviado a {$request->email}"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error enviando email de prueba',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
