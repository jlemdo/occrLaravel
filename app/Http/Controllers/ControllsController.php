<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Defaultsystemimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use UnexpectedValueException;

use App\Models\Roofs;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Designs;
use App\Models\Driversdelivery;
use App\Models\Faq;
use App\Models\Financings;
use App\Models\Inverters;
use App\Models\Modules;
use App\Models\Ordedetail;
use App\Models\Proposalbattery;
use App\Models\Stockweb;
use App\Models\Ucompany;
use App\Models\DeliveryDay;
use App\Models\DeliveryTimeSlot;
use App\Models\DeliveryConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use App\Models\System;
use DocuSign\eSign\Model\CertifiedDelivery;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Models\Activity as ModelsActivity;

class ControllsController extends Controller
{

    //         public function createPaymentIntent(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
    //     $amount = $request->amount;
    //     $currency = $request->currency;

    //     // 🔧 FIX CRÍTICO: Usar el order_id real que viene del frontend
    //     $orderId = $request->order_id; // El frontend debe enviar el ID real de la orden creada

    //     // Si no viene order_id, generar uno temporal único
    //     if (!$orderId) {
    //         $orderId = 'temp_' . time() . '_' . rand(1000, 9999);
    //     }

    //     Log::info("💳 CREANDO PAYMENT INTENT", [
    //         'order_id' => $orderId,
    //         'amount' => $amount,
    //         'from_frontend' => !!$request->order_id
    //     ]);

    //     $paymentIntent = PaymentIntent::create([
    //         'amount' => $amount,
    //         'currency' => $currency,
    //         'metadata' => [
    //             'order_id' => $orderId,
    //         ]
    //     ]);

    //     return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    // }

    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $request->amount;
        $currency = $request->currency;

        // 🔧 FIX CRÍTICO: Usar el order_id real que viene del frontend
        $orderId = $request->order_id; // El frontend debe enviar el ID real de la orden creada

        // Si no viene order_id, generar uno temporal único
        if (!$orderId) {
            $orderId = 'temp_' . time() . '_' . rand(1000, 9999);
        }

        Log::info("💳 CREANDO PAYMENT INTENT", [
            'order_id' => $orderId,
            'amount' => $amount,
            'from_frontend' => !!$request->order_id
        ]);

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,

            // 👇 Lista de métodos que quieres aceptar
            'payment_method_types' => ['card', 'oxxo'],

            'metadata' => [
                'order_id' => $orderId,
            ],

            // 👇 Configuración específica SOLO para OXXO
            'payment_method_options' => [
                'oxxo' => [
                    'expires_after_days' => 1
                ]
            ]
        ]);

        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }

    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->server('HTTP_STRIPE_SIGNATURE');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        Log::info("🔥 WEBHOOK LLAMADO", [
            'has_payload' => !empty($payload),
            'has_signature' => !empty($sigHeader),
            'has_endpoint_secret' => !empty($endpointSecret),
            'payload_size' => strlen($payload)
        ]);

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );

            Log::info("✅ WEBHOOK EVENT CONSTRUIDO", [
                'event_type' => $event->type,
                'event_id' => $event->id ?? 'no_id'
            ]);
        } catch (UnexpectedValueException $e) {
            Log::error("❌ WEBHOOK PAYLOAD INVÁLIDO", ['error' => $e->getMessage()]);
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error("❌ WEBHOOK SIGNATURE INVÁLIDA", ['error' => $e->getMessage()]);
            return response('Invalid signature', 400);
        }

        // Handle successful payment
        if ($event->type === 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object;

            $amount = $paymentIntent->amount; // amount in cents
            $orderId = $paymentIntent->metadata->order_id;

            Log::info("💰 PROCESANDO PAGO EXITOSO", [
                'order_id' => $orderId,
                'amount_cents' => $amount,
                'amount_dollars' => $amount / 100,
                'payment_intent_id' => $paymentIntent->id
            ]);

            // Check if order exists before updating - SOLO BÚSQUEDA EXACTA
            $existingOrder = Order::where('id', $orderId)->first();

            // 🔧 SOLO UNA ALTERNATIVA: Si no encuentra por ID, buscar por order_number
            if (!$existingOrder) {
                $existingOrder = Order::where('order_number', $orderId)->first();
                if ($existingOrder) {
                    Log::info("🔍 ENCONTRADA POR ORDER_NUMBER", [
                        'order_id_buscado' => $orderId,
                        'order_id_real' => $existingOrder->id
                    ]);
                }
            }

            if ($existingOrder) {
                Log::info("📦 ORDEN ENCONTRADA", [
                    'order_id' => $orderId,
                    'current_status' => $existingOrder->status,
                    'current_amount' => $existingOrder->amount_paid
                ]);

                // 🚨 FIX CRÍTICO: Convertir de temporal a orden real (solo actualizar pago)
                try {
                    // SOLO cambiar estado si es temporal, sino solo actualizar pago
                    if ($existingOrder->status === 'Processing Payment') {
                        $existingOrder->status = 'Open';  // INGLÉS - la app espera esto
                        $existingOrder->status_spanish = 'Abierto';  // ESPAÑOL para admin
                    }
                    // CRÍTICO: Marcar pago como exitoso
                    $existingOrder->payment_status = 'paid';
                    $existingOrder->amount_paid = strval($amount / 100);
                    $existingOrder->payment_id = $paymentIntent->id;
                    $updated = $existingOrder->save();
                } catch (\Exception $e) {
                    Log::error("❌ ERROR SQL AL ACTUALIZAR", [
                        'order_id' => $orderId,
                        'sql_error' => $e->getMessage()
                    ]);
                    $updated = false;
                }

                if ($updated) {
                    Log::info("🎉 ORDEN ACTUALIZADA EXITOSAMENTE", [
                        'order_id' => $orderId,
                        'new_status' => $existingOrder->status,
                        'amount_paid' => $amount / 100
                    ]);

                    // 🔪 CIRUGÍA: Enviar notificación de pago confirmado
                    // 🎉 NOTIFICACIÓN UNIFICADA: Pedido confirmado y pagado
                    $user = \App\Models\User::find($existingOrder->userid);
                    if ($user && !empty($user->fcm_token)) {
                        $firebaseService = new \App\Services\FirebaseNotificationService();
                        $firebaseService->sendToDevice(
                            $user->fcm_token,
                            "🎉 ¡Pedido confirmado y pagado!",
                            "Tu pedido #{$orderId} ha sido confirmado. Pago de $" . number_format($amount / 100, 2) . " procesado exitosamente.",
                            [
                                'type' => 'order_confirmed_and_paid',
                                'order_id' => (string)$orderId,
                                'amount' => $amount / 100
                            ]
                        );
                        Log::info("🎉 Notificación pedido confirmado y pagado enviada", ['order_id' => $orderId]);
                    }
                    // 🎉 Guest notification unificada
                    elseif (!$user && !empty($existingOrder->user_email)) {
                        $guestAddress = \App\Models\GuestAddress::where('guest_email', $existingOrder->user_email)->first();
                        if ($guestAddress && !empty($guestAddress->fcm_token)) {
                            $firebaseService = new \App\Services\FirebaseNotificationService();
                            $firebaseService->sendToDevice(
                                $guestAddress->fcm_token,
                                "🎉 ¡Pedido confirmado y pagado!",
                                "Tu pedido #{$orderId} ha sido confirmado. Pago de $" . number_format($amount / 100, 2) . " procesado exitosamente.",
                                [
                                    'type' => 'order_confirmed_and_paid',
                                    'order_id' => (string)$orderId,
                                    'amount' => $amount / 100
                                ]
                            );
                            Log::info("🎉 Notificación pedido confirmado y pagado Guest enviada", ['order_id' => $orderId]);
                        }
                    }
                } else {
                    Log::error("❌ ERROR AL ACTUALIZAR ORDEN", ['order_id' => $orderId]);
                }
            } else {
                // 🔍 DEBUGGING AVANZADO: Ver qué órdenes SÍ existen
                $recentOrders = Order::orderBy('id', 'desc')->limit(3)->get(['id', 'order_number', 'status', 'created_at']);
                $processingOrders = Order::where('status', 'Processing Payment')->orderBy('id', 'desc')->limit(3)->get(['id', 'order_number', 'user_email', 'created_at']);

                Log::error("❌ ORDEN NO ENCONTRADA - DEBUGGING COMPLETO", [
                    'order_id_buscado' => $orderId,
                    'payment_intent_id' => $paymentIntent->id,
                    'ultimas_ordenes' => $recentOrders->toArray(),
                    'ordenes_procesando_pago' => $processingOrders->toArray(),
                    'amount' => $amount / 100
                ]);
            }
        } elseif ($event->type === 'payment_intent.payment_failed') {
            $paymentIntent = $event->data->object;
            $orderId = $paymentIntent->metadata->order_id;

            Log::info("💔 PROCESANDO PAGO FALLIDO", [
                'order_id' => $orderId,
                'payment_intent_id' => $paymentIntent->id
            ]);

            // Actualizar orden con estado de pago fallido
            $existingOrder = Order::where('id', $orderId)->first();
            if ($existingOrder) {
                // Para pagos fallidos, mantener el estado actual del pedido
                Order::where('id', $orderId)->update([
                    'payment_id' => $paymentIntent->id
                ]);

                Log::info("💔 ORDEN MARCADA COMO PAGO FALLIDO", ['order_id' => $orderId]);

                // 🔔 Notificación de pago fallido
                $user = \App\Models\User::find($existingOrder->userid);
                if ($user && !empty($user->fcm_token)) {
                    $firebaseService = new \App\Services\FirebaseNotificationService();
                    $firebaseService->sendToDevice(
                        $user->fcm_token,
                        "💳 Problema con el pago",
                        "El pago de tu pedido #{$orderId} no pudo procesarse. Por favor intenta de nuevo.",
                        [
                            'type' => 'payment_failed',
                            'order_id' => (string)$orderId
                        ]
                    );
                } elseif (!$user && !empty($existingOrder->user_email)) {
                    $guestAddress = \App\Models\GuestAddress::where('guest_email', $existingOrder->user_email)->first();
                    if ($guestAddress && !empty($guestAddress->fcm_token)) {
                        $firebaseService = new \App\Services\FirebaseNotificationService();
                        $firebaseService->sendToDevice(
                            $guestAddress->fcm_token,
                            "💳 Problema con el pago",
                            "El pago de tu pedido #{$orderId} no pudo procesarse. Por favor intenta de nuevo.",
                            [
                                'type' => 'payment_failed',
                                'order_id' => (string)$orderId
                            ]
                        );
                    }
                }
            }

            // 📋 Handle OXXO payment pending (requires_action)
        } elseif ($event->type === 'payment_intent.requires_action') {
            $paymentIntent = $event->data->object;
            $orderId = $paymentIntent->metadata->order_id;

            Log::info("⏳ PROCESANDO PAGO PENDIENTE OXXO", [
                'order_id' => $orderId,
                'payment_intent_id' => $paymentIntent->id
            ]);

            // Actualizar orden con estado pendiente
            $existingOrder = Order::where('id', $orderId)->first();
            if (!$existingOrder) {
                $existingOrder = Order::where('order_number', $orderId)->first();
            }

            if ($existingOrder) {
                // 🚨 FIX CRÍTICO: Convertir de temporal a orden real (OXXO pendiente)
                if ($existingOrder->status === 'Processing Payment') {
                    $existingOrder->status = 'Open';  // INGLÉS - la app espera esto
                    $existingOrder->status_spanish = 'Abierto';  // ESPAÑOL para admin
                }
                // OXXO: mantener payment_status = 'pending' hasta que se pague en tienda
                $existingOrder->payment_id = $paymentIntent->id;
                $existingOrder->save();

                Log::info("📋 ORDEN ABIERTA CON PAGO PENDIENTE OXXO", ['order_id' => $orderId]);

                // 📋 NOTIFICACIÓN UNIFICADA: Pedido confirmado, pago pendiente
                $user = \App\Models\User::find($existingOrder->userid);
                if ($user && !empty($user->fcm_token)) {
                    $firebaseService = new \App\Services\FirebaseNotificationService();
                    $firebaseService->sendToDevice(
                        $user->fcm_token,
                        "📋 ¡Pedido confirmado! Pago pendiente",
                        "Tu pedido #{$orderId} ha sido confirmado. Ve a OXXO a completar tu pago para que sea preparado.",
                        [
                            'type' => 'order_confirmed_payment_pending',
                            'order_id' => (string)$orderId
                        ]
                    );
                    Log::info("📋 Notificación pedido confirmado pago pendiente enviada", ['order_id' => $orderId]);
                }
                // 📋 Guest notification pago pendiente
                elseif (!$user && !empty($existingOrder->user_email)) {
                    $guestAddress = \App\Models\GuestAddress::where('guest_email', $existingOrder->user_email)->first();
                    if ($guestAddress && !empty($guestAddress->fcm_token)) {
                        $firebaseService = new \App\Services\FirebaseNotificationService();
                        $firebaseService->sendToDevice(
                            $guestAddress->fcm_token,
                            "📋 ¡Pedido confirmado! Pago pendiente",
                            "Tu pedido #{$orderId} ha sido confirmado. Ve a OXXO a completar tu pago para que sea preparado.",
                            [
                                'type' => 'order_confirmed_payment_pending',
                                'order_id' => (string)$orderId
                            ]
                        );
                        Log::info("📋 Notificación pedido confirmado pago pendiente Guest enviada", ['order_id' => $orderId]);
                    }
                }
            }
        } else {
            Log::info("ℹ️ WEBHOOK EVENT NO PROCESADO", ['event_type' => $event->type]);
        }

        Log::info("✅ WEBHOOK RESPONSE ENVIADA");
        return response('Webhook handled', 200);
    }

    public function testWebhookLogs()
    {
        // Test logging and order lookup
        Log::info("🧪 TESTING WEBHOOK FUNCTIONALITY");

        // Check last few orders
        $recentOrders = Order::orderBy('id', 'desc')->limit(5)->get(['id', 'status', 'amount_paid', 'payment_id', 'created_at']);

        Log::info("📋 ÚLTIMAS 5 ÓRDENES", [
            'orders' => $recentOrders->toArray()
        ]);

        // Test environment variables
        Log::info("🔧 CONFIGURACIÓN STRIPE", [
            'has_stripe_secret' => !empty(env('STRIPE_SECRET')),
            'has_webhook_secret' => !empty(env('STRIPE_WEBHOOK_SECRET')),
            'webhook_secret_length' => strlen(env('STRIPE_WEBHOOK_SECRET') ?? ''),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Test completado - revisa los logs',
            'recent_orders_count' => $recentOrders->count(),
            'recent_orders' => $recentOrders
        ]);
    }
    public function act_log()
    {
        $title = 'Deal Stages';
        $projects = ModelsActivity::latest()->paginate(10); // Fetch 10 activities per page
        return view('admin.crm.actlog.index', compact('projects', 'title'))->with('i', (request()->input('page', 1) - 1) * 10 + 1);
    }
    // 📦 NUEVO SISTEMA DE ENVÍO GRATIS
    public function financing()
    {
        $title = 'Sistema de Envío Gratis';
        $config = \App\Models\ShippingConfig::getActiveConfig();
        return view('admin.financing.index', compact('config', 'title'));
    }

    public function updateShippingConfig(Request $request)
    {
        try {
            $request->validate([
                'min_order_for_free_shipping' => 'required|numeric|min:0',
                'standard_shipping_fee' => 'required|numeric|min:0',
                'description' => 'nullable|string|max:500'
            ]);

            // Buscar configuración existente o crear nueva
            $config = \App\Models\ShippingConfig::first();

            $data = [
                'min_order_for_free_shipping' => $request->min_order_for_free_shipping,
                'standard_shipping_fee' => $request->standard_shipping_fee,
                'description' => $request->description ?? 'Sistema de envío configurado',
                'is_active' => true // Siempre activo
            ];

            if ($config) {
                $config->update($data);
            } else {
                \App\Models\ShippingConfig::create($data);
            }

            return redirect()->to('delivery')->with(
                'success',
                '✅ Configuración de envío actualizada exitosamente. El nuevo sistema ya está activo.'
            );
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Error al actualizar configuración: ' . $e->getMessage()])
                ->withInput();
        }
    }

    // 🗑️ MÉTODOS ANTIGUOS - Mantener por compatibilidad temporal
    public function newfinancing()
    {
        // Redirigir al nuevo sistema
        return redirect()->to('delivery')->with(
            'info',
            'Sistema actualizado: Ahora usamos envío gratis por monto mínimo en lugar de tarifas por distancia.'
        );
    }

    public function addfinancing(Request $request)
    {
        // Redirigir al nuevo sistema
        return redirect()->to('delivery')->with(
            'info',
            'Sistema actualizado: Configura el envío gratis por monto mínimo.'
        );
    }

    public function deletefinancing($id)
    {
        // Redirigir al nuevo sistema
        return redirect()->to('delivery')->with(
            'info',
            'Sistema actualizado: El nuevo sistema no requiere eliminar elementos individuales.'
        );
    }

    public function financingEdit($id)
    {
        // Redirigir al nuevo sistema
        return redirect()->to('delivery')->with(
            'info',
            'Sistema actualizado: Configura el envío directamente en la página principal.'
        );
    }

    public function updatefinancing(Request $data)
    {
        // Redirigir al nuevo sistema
        return redirect()->to('delivery')->with(
            'info',
            'Sistema actualizado: Usa la nueva configuración de envío gratis.'
        );
    }


    public function getInverters($category = null)
    {
        $query = Inverters::latest();

        if ($category) {
            $query->where('product_cat', $category);
        }
        $generalDiscountPercent = Proposalbattery::find(1)->discount ?? 0;
        $projects = $query->get()->map(function ($project) use ($generalDiscountPercent) {
            $project->photo      = url('mydoc/' . $project->photo);
            $stockQty = Stockweb::where('product', $project->name)->sum('qty');
            $orderedQty = Ordedetail::where('item_name', $project->name)->sum('item_qty');
            $project->available_qty = max($stockQty - $orderedQty, 0);
            $price = floatval($project->price);
            $productDiscount = floatval($project->discount ?? 0);
            $generalDiscount = ($generalDiscountPercent / 100) * $price;
            //$project->discount = round($productDiscount + $generalDiscount, 2);
            $project->discount = round($productDiscount, 2);
            return $project;
        });

        return response()->json([
            'status' => 'success' . $category,
            'data'   => $projects
        ], 200);
    }


    public function getInverterscats()
    {
        $projects = Modules::latest()->get()->map(function ($project) {
            $project->photo = url('mydoc/' . $project->photo); // Append full URL
            return $project;
        });

        return response()->json([
            'status' => 'success',
            'data' => $projects
        ], 200);
    }

    public function inverter()
    {
        $title = 'Products';
        $projects = Inverters::latest()->get();
        return view('admin.inverter.index', compact('projects', 'title'))->with('i', 1);
    }
    public function newinverter()
    {
        $title = 'Add New Products';
        $mods = Modules::latest()->get();
        return view('admin.inverter.addnew', compact('title', 'mods'));
    }
    public function addinverter(Request $request)
    {
        $destinationPath = public_path('mydoc/');
        $projectImage = 'cover' . date('YmdHis') . "." . $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move($destinationPath, $projectImage);
        $projectphoto = "$projectImage";
        $user = Inverters::create([
            'name' => $request->title,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'product_cat' => $request->product_cat,
            'photo' => $projectphoto,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'cost' => $request->cost,
        ]);
        return redirect()->to('product')->with('success', 'Products added Successfully');
    }
    public function deleteinverter($id)
    {
        $myusers = Inverters::findOrFail($id);
        $myusers->delete();
        return redirect()->back()->with('destroy', 'Product deleted successfully');
    }
    public function inverterEdit($id)
    {
        $proposals = Inverters::find($id);
        $mods = Modules::latest()->get();
        return view('admin.inverter.edit', compact('proposals', 'mods'));
    }
    public function updateinverter(Request $data)
    {
        $id = $data->input('id');
        $user = Inverters::findOrFail($id);
        if ($image = $data->file('photo')) {
            $destinationPath = public_path('mydoc/');
            $profileImage = 'cover' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profilephot = "$profileImage";
            $user->update(['photo' => $profilephot]);
        }
        $user->update([
            'name' => $data->title,
            'unit' => $data->unit,
            'quantity' => $data->quantity,
            'description' => $data->description,
            'price' => $data->price,
            'cost' => $data->cost,
            'discount' => $data->discount,
            'product_cat' => $data->product_cat,
        ]);
        return redirect()->to('/product')->with('success', 'Product Updated Successfully');
    }

    ///stock
    //inventory
    public function inventory()
    {
        $title = 'Products';
        $mods = Inverters::latest()->get();
        $purchases = Stockweb::select('product', DB::raw('SUM(qty) as total_purchased'))
            ->groupBy('product')
            ->pluck('total_purchased', 'product');

        // Get sold items (grouped by product)
        $sales = Ordedetail::select('item_name', DB::raw('SUM(item_qty) as total_sold'))
            ->groupBy('item_name')
            ->pluck('total_sold', 'item_name');

        // Calculate net stock for each product
        $stock = [];
        foreach ($mods as $mod) {
            $productName = $mod->name;

            $totalPurchased = $purchases[$productName] ?? 0;
            $totalSold = $sales[$productName] ?? 0;

            $netStock = $totalPurchased - $totalSold;

            $stock[] = [
                'product' => $productName,
                'qty' => $netStock
            ];
        }
        //dd($stock);
        return view('admin.stock.inventory', compact('stock', 'title', 'mods'))->with('i', 1);
    }

    public function stock()
    {
        $title = 'Products';
        $projects = Stockweb::latest()->get();
        return view('admin.stock.index', compact('projects', 'title'))->with('i', 1);
    }
    public function newstock()
    {
        $title = 'Add New Stock';
        $mods = Inverters::latest()->get();
        return view('admin.stock.addnew', compact('title', 'mods'));
    }
    public function addstock(Request $request)
    {

        $user = Stockweb::create([
            'product' => $request->product,
            'qty' => $request->qty
        ]);
        return redirect()->to('stock')->with('success', 'Stock added Successfully');
    }
    public function deletestock($id)
    {
        $myusers = Stockweb::findOrFail($id);
        $myusers->delete();
        return redirect()->back()->with('destroy', 'Stock entry deleted successfully');
    }
    public function stockEdit($id)
    {
        $proposals = Stockweb::find($id);
        $mods = Inverters::latest()->get();
        return view('admin.stock.edit', compact('proposals', 'mods'));
    }
    public function updatestock(Request $data)
    {
        $id = $data->input('id');
        $user = Stockweb::findOrFail($id);

        $user->update([
            'product' => $data->product,
            'qty' => $data->qty
        ]);
        return redirect()->to('/stock')->with('success', 'Stock Updated Successfully');
    }
    //modules
    public function modules()
    {
        $title = 'Caegory';
        $projects = Modules::latest()->get();
        return view('admin.modules.index', compact('projects', 'title'))->with('i', 1);
    }
    public function newmodules()
    {
        $title = 'Add New Cat';
        return view('admin.modules.addnew', compact('title'));
    }
    public function addmodules(Request $request)
    {
        $destinationPath = public_path('mydoc/');
        $projectImage = 'cover' . date('YmdHis') . "." . $request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move($destinationPath, $projectImage);
        $projectphoto = "$projectImage";
        $user = Modules::create([
            'name' => $request->title,
            'photo' => $projectphoto,
            'description' => $request->description
        ]);
        return redirect()->to('modules')->with('success', 'Module added Successfully');
    }
    public function deletemodules($id)
    {
        $myusers = Modules::findOrFail($id);
        $myusers->delete();
        return redirect()->back()->with('destroy', 'Module deleted successfully');
    }
    public function modulesEdit($id)
    {
        $proposals = Modules::find($id);
        return view('admin.modules.edit', compact('proposals'));
    }
    public function updatemodules(Request $data)
    {
        $id = $data->input('id');
        $user = Modules::findOrFail($id);
        $oldName = $user->name;
        if ($image = $data->file('photo')) {
            $destinationPath = public_path('mydoc/');
            $profileImage = 'cover' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profilephot = "$profileImage";
            $user->update(['photo' => $profilephot]);
        }
        $user->update([
            'name' => $data->title,
            'description' => $data->description
        ]);

        Inverters::where('product_cat', $oldName)->update(['product_cat' => $data->title]);

        return redirect()->to('/modules')->with('success', 'Module Updated Successfully');
    }

    public function proposalbatteryd()
    {
        $title = 'Promotions';
        $timeline = Proposalbattery::latest()->get();
        return view('admin.proposalbattery.index', compact('timeline', 'title'))->with('i', 1);
    }
    //newtimeline
    public function newproposalbattery()
    {
        $title = 'Add New Promo';
        return view('admin.proposalbattery.addnew', compact('title'));
    }
    //addtimelineaction
    public function addproposalbatteryaction(Request $request)
    {
        // Validaciones
        $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:percentage,fixed',
            'minimum_amount' => 'nullable|numeric|min:0',
            'is_coupon' => 'required|boolean',
            'coupon_code' => 'nullable|string|max:50|unique:proposalbatteries,coupon_code',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'type' => 'nullable|in:Global,Individual,Birthday,Guest,Normal,Google,Apple',
            'applies_to' => 'nullable|in:total,shipping'
        ]);

        // Si es cupón (Sistema 1), código es requerido
        if ($request->is_coupon && !$request->coupon_code) {
            return redirect()->back()->withErrors(['coupon_code' => 'El código de cupón es requerido para cupones ecommerce.'])->withInput();
        }

        // Convertir código a mayúsculas y limpiar
        $couponCode = null;
        if ($request->coupon_code) {
            $couponCode = strtoupper(preg_replace('/[^A-Z0-9-]/', '', $request->coupon_code));
        }

        // Validar descuento según tipo
        if ($request->discount_type === 'percentage' && $request->discount > 100) {
            return redirect()->back()->withErrors(['discount' => 'El descuento no puede ser mayor al 100%.'])->withInput();
        }

        Proposalbattery::create([
            'name' => $request->name,
            'coupon_code' => $couponCode,
            'from' => $request->from,
            'to' => $request->to,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'minimum_amount' => $request->minimum_amount ?? 0,
            'type' => $request->type ?? 'Global',
            'is_coupon' => $request->is_coupon,
            'applies_to' => $request->applies_to ?? 'total',
        ]);

        $itemType = $request->is_coupon ? 'Cupón' : 'Promoción';
        return redirect()->to('promotion')->with('success', $itemType . ' agregado exitosamente');
    }
    //deletetime
    public function deleteproposalbattery($id)
    {
        $myusers = Proposalbattery::findOrFail($id);
        $myusers->delete();
        return redirect()->back()->with('destroy', 'Promotion deleted successfully');
    }
    public function proposalbatteryEdit($id)
    {
        $proposals = Proposalbattery::find($id);
        return view('admin.proposalbattery.edit', compact('proposals'));
    }
    public function updateproposalbattery(Request $request)
    {
        $id = $request->input('id');
        $proposal = Proposalbattery::findOrFail($id);

        // Validaciones
        $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:percentage,fixed',
            'minimum_amount' => 'nullable|numeric|min:0',
            'is_coupon' => 'required|boolean',
            'coupon_code' => 'nullable|string|max:50|unique:proposalbatteries,coupon_code,' . $id,
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'type' => 'nullable|in:Global,Individual,Birthday,Guest,Normal,Google,Apple',
            'applies_to' => 'nullable|in:total,shipping'
        ]);

        // Si es cupón (Sistema 1), código es requerido
        if ($request->is_coupon && !$request->coupon_code) {
            return redirect()->back()->withErrors(['coupon_code' => 'El código de cupón es requerido para cupones ecommerce.'])->withInput();
        }

        // Convertir código a mayúsculas y limpiar
        $couponCode = null;
        if ($request->coupon_code) {
            $couponCode = strtoupper(preg_replace('/[^A-Z0-9-]/', '', $request->coupon_code));
        }

        // Validar descuento según tipo
        if ($request->discount_type === 'percentage' && $request->discount > 100) {
            return redirect()->back()->withErrors(['discount' => 'El descuento no puede ser mayor al 100%.'])->withInput();
        }

        $proposal->update([
            'name' => $request->name,
            'coupon_code' => $couponCode,
            'from' => $request->from,
            'to' => $request->to,
            'discount' => $request->discount,
            'discount_type' => $request->discount_type,
            'minimum_amount' => $request->minimum_amount ?? 0,
            'type' => $request->type ?? 'Global',
            'is_coupon' => $request->is_coupon,
            'applies_to' => $request->applies_to ?? 'total',
        ]);

        $itemType = $request->is_coupon ? 'Cupón' : 'Promoción';
        return redirect()->to('promotion')->with('success', $itemType . ' actualizado exitosamente');
    }


    ///delivery slots per working
    public function dslots()
    {
        $title = 'Delivery Slots Management';

        // Obtener datos del nuevo sistema ÚNICAMENTE
        $deliveryDays = \App\Models\DeliveryDay::orderBy('priority')->get();
        $deliverySlots = \App\Models\DeliveryTimeSlot::orderBy('priority')->get();

        return view('admin.slots.index', compact(
            'title',
            'deliveryDays',
            'deliverySlots'
        ));
    }
    //newtimeline
    public function newdslots()
    {
        $title = 'Add New Slot';
        return view('admin.slots.addnew', compact('title'));
    }
    //addtimelineaction
    public function adddslotsaction(Request $request)
    {
        if ($request->type == 'day') {
            DeliveryDay::create([
                'day_name' => $request->day_name,
                'day_label' => $request->day_label,
                'day_number' => $request->day_number,
                'priority' => $request->priority,
                'is_active' => $request->is_active,
                'notes' => $request->notes
            ]);
            return redirect()->to('dslots')->with('success', 'Día agregado exitosamente');
        } else {
            DeliveryTimeSlot::create([
                'slot_name' => $request->slot_name,
                'slot_label' => $request->slot_label,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'priority' => $request->priority,
                'is_active' => $request->is_active,
                'notes' => $request->notes
            ]);
            return redirect()->to('dslots')->with('success', 'Horario agregado exitosamente');
        }
    }
    //deletetime
    public function deletedslots(Request $request, $id)
    {
        if ($request->type == 'day') {
            $item = DeliveryDay::findOrFail($id);
            $item->delete();
            return redirect()->back()->with('destroy', 'Día eliminado exitosamente');
        } else {
            $item = DeliveryTimeSlot::findOrFail($id);
            $item->delete();
            return redirect()->back()->with('destroy', 'Horario eliminado exitosamente');
        }
    }
    public function dslotsEdit(Request $request, $id)
    {
        if ($request->type == 'day') {
            $item = DeliveryDay::find($id);
        } else {
            $item = DeliveryTimeSlot::find($id);
        }
        return view('admin.slots.edit', compact('item'));
    }
    public function updatedslots(Request $request)
    {
        $id = $request->input('id');

        if ($request->type == 'day') {
            $item = DeliveryDay::findOrFail($id);
            $item->update([
                'day_name' => $request->day_name,
                'day_label' => $request->day_label,
                'day_number' => $request->day_number,
                'priority' => $request->priority,
                'is_active' => $request->is_active,
                'notes' => $request->notes
            ]);
            return redirect()->to('dslots')->with('success', 'Día actualizado exitosamente');
        } else {
            $item = DeliveryTimeSlot::findOrFail($id);
            $item->update([
                'slot_name' => $request->slot_name,
                'slot_label' => $request->slot_label,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'priority' => $request->priority,
                'is_active' => $request->is_active,
                'notes' => $request->notes
            ]);
            return redirect()->to('dslots')->with('success', 'Horario actualizado exitosamente');
        }
    }

    // ===============================================
    // 🆕 NUEVOS MÉTODOS PARA ADMINISTRACIÓN AVANZADA
    // ===============================================

    /**
     * Actualizar estado de un día de entrega
     */
    public function toggleDeliveryDay(Request $request)
    {
        try {
            $day = \App\Models\DeliveryDay::findOrFail($request->day_id);
            $day->is_active = !$day->is_active;
            $day->save();

            return redirect()->back()->with(
                'success',
                'Día de entrega ' . ($day->is_active ? 'activado' : 'desactivado') . ' correctamente'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar día de entrega');
        }
    }

    /**
     * Actualizar estado de un horario de entrega
     */
    public function toggleDeliverySlot(Request $request)
    {
        try {
            $slot = \App\Models\DeliveryTimeSlot::findOrFail($request->slot_id);
            $slot->is_active = !$slot->is_active;
            $slot->save();

            return redirect()->back()->with(
                'success',
                'Horario ' . ($slot->is_active ? 'activado' : 'desactivado') . ' correctamente'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar horario');
        }
    }

    /**
     * Agregar nuevo horario de entrega
     */
    public function addDeliverySlot(Request $request)
    {
        try {
            $request->validate([
                'slot_name' => 'required|string|max:50',
                'slot_label' => 'required|string|max:100',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            \App\Models\DeliveryTimeSlot::create([
                'slot_name' => $request->slot_name,
                'slot_label' => $request->slot_label,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'is_active' => true,
                'priority' => \App\Models\DeliveryTimeSlot::max('priority') + 1,
                'notes' => $request->notes
            ]);

            return redirect()->back()->with('success', 'Nuevo horario agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al agregar horario: ' . $e->getMessage());
        }
    }

    /**
     * Actualizar configuración de delivery
     */
    public function updateDeliveryConfig(Request $request)
    {
        try {
            $request->validate([
                'cut_off_hour_morning' => 'required|integer|min:0|max:23',
                'cut_off_hour_evening' => 'required|integer|min:0|max:23',
                'daily_cutoff_hour' => 'required|integer|min:0|max:23',
            ]);

            \App\Models\DeliveryConfig::set('cut_off_hour_morning', $request->cut_off_hour_morning, 'int', 'Hora límite para horario matutino');
            \App\Models\DeliveryConfig::set('cut_off_hour_evening', $request->cut_off_hour_evening, 'int', 'Hora límite para horario vespertino');
            \App\Models\DeliveryConfig::set('daily_cutoff_hour', $request->daily_cutoff_hour, 'int', 'Hora límite diaria');

            return redirect()->back()->with('success', 'Configuración actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar configuración: ' . $e->getMessage());
        }
    }

    /**
     * NUEVO: Obtener slots de entrega para una fecha específica
     * Integra lógica del frontend con administración backend
     */
    public function fetchddate($date)
    {
        try {
            // Importar nuevos modelos
            $deliveryTimeSlots = \App\Models\DeliveryTimeSlot::getActiveSlotsForAPI($date);

            // Si no hay slots configurados, usar fallback
            if ($deliveryTimeSlots->isEmpty()) {
                return response()->json([
                    ['label' => '9:00 AM - 1:00 PM', 'value' => '9am-1pm'],
                    ['label' => '4:00 PM - 12:00 PM', 'value' => '4pm-12pm']
                ]);
            }

            return response()->json($deliveryTimeSlots);
        } catch (\Exception $e) {
            // Fallback en caso de error
            return response()->json([
                ['label' => '9:00 AM - 1:00 PM', 'value' => '9am-1pm'],
                ['label' => '4:00 PM - 12:00 PM', 'value' => '4pm-12pm']
            ]);
        }
    }

    /**
     * NUEVO: Obtener días de entrega disponibles
     */
    public function getDeliveryDays()
    {
        try {
            $deliveryDays = \App\Models\DeliveryDay::getActiveDaysForAPI();

            return response()->json([
                'status' => 'success',
                'data' => $deliveryDays
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error obteniendo días de entrega',
                'data' => []
            ], 500);
        }
    }

    /**
     * NUEVO: Obtener configuración completa de delivery
     */
    public function getDeliveryConfig()
    {
        try {
            $config = \App\Models\DeliveryConfig::getDeliverySettings();
            $days = \App\Models\DeliveryDay::active()->ordered()->get();
            $slots = \App\Models\DeliveryTimeSlot::active()->ordered()->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'config' => $config,
                    'days' => $days,
                    'slots' => $slots
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error obteniendo configuración de delivery'
            ], 500);
        }
    }

    /**
     * Validar cupón de descuento
     */
    public function validateCoupon(Request $request)
    {
        try {
            // Validar entrada
            $request->validate([
                'coupon_code' => 'required|string|max:50',
                'subtotal' => 'required|numeric|min:0',
                'shipping_cost' => 'nullable|numeric|min:0',
                'user_email' => 'nullable|string|email'
            ]);

            $couponCode = strtoupper(trim($request->coupon_code));
            $subtotal = floatval($request->subtotal);
            $shippingCost = floatval($request->shipping_cost ?? 0);
            $userEmail = $request->user_email;

            // Buscar cupón
            $coupon = Proposalbattery::where('coupon_code', $couponCode)
                ->where('is_coupon', true) // Solo cupones del Sistema 1
                ->first();

            if (!$coupon) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cupón no válido'
                ], 404);
            }

            // Validar fechas de vigencia
            $now = now();
            if ($coupon->from && $now->lt($coupon->from)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cupón aún no está activo'
                ], 400);
            }

            if ($coupon->to && $now->gt($coupon->to)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cupón ha expirado'
                ], 400);
            }

            // Validar monto mínimo (siempre se valida contra el subtotal)
            if ($coupon->minimum_amount > 0 && $subtotal < $coupon->minimum_amount) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Monto mínimo requerido: $" . number_format($coupon->minimum_amount, 2),
                    'minimum_required' => $coupon->minimum_amount,
                    'current_amount' => $subtotal
                ], 400);
            }

            // Verificar uso único por usuario (solo si tiene email)
            if ($userEmail) {
                $alreadyUsed = \App\Models\Order::where('user_email', $userEmail)
                    ->where('coupon_code', $couponCode)
                    ->exists();

                if ($alreadyUsed) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Este cupón ya ha sido utilizado'
                    ], 400);
                }
            }

            // Determinar sobre qué monto aplicar el descuento
            $appliesTo = $coupon->applies_to ?? 'total';
            $baseAmount = $appliesTo === 'shipping' ? $shippingCost : $subtotal;

            // Calcular descuento
            $discountAmount = 0;
            if ($coupon->discount_type === 'percentage') {
                $discountAmount = ($baseAmount * $coupon->discount) / 100;
            } else {
                $discountAmount = $coupon->discount;
            }

            // Asegurar que el descuento no sea mayor al monto base
            $discountAmount = min($discountAmount, $baseAmount);

            return response()->json([
                'status' => 'success',
                'message' => 'Cupón válido',
                'coupon' => [
                    'code' => $coupon->coupon_code,
                    'name' => $coupon->name,
                    'discount' => $coupon->discount,
                    'discount_type' => $coupon->discount_type,
                    'applies_to' => $appliesTo,
                    'discount_amount' => round($discountAmount, 2),
                    'minimum_amount' => $coupon->minimum_amount,
                    'description' => $this->getCouponDescription($coupon, $appliesTo)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al validar cupón: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generar descripción del cupón
     */
    private function getCouponDescription($coupon, $appliesTo = null)
    {
        $appliesTo = $appliesTo ?? ($coupon->applies_to ?? 'total');

        $discountText = '';
        if ($coupon->discount_type === 'percentage') {
            $discountText = $coupon->discount . '% de descuento';
        } else {
            $discountText = '$' . number_format($coupon->discount, 2) . ' de descuento';
        }

        $appliesText = $appliesTo === 'shipping' ? ' en envío' : ' en total';

        return $discountText . $appliesText;
    }

    /**
     * Obtener promociones automáticas aplicables para un usuario
     */
    public function getAutomaticPromotions(Request $request)
    {
        try {
            $request->validate([
                'subtotal' => 'required|numeric|min:0',
                'user_email' => 'nullable|string|email'
            ]);

            $subtotal = $request->subtotal;
            $userEmail = $request->user_email;

            // Buscar al usuario si hay email
            $user = null;
            if ($userEmail) {
                $user = User::where('email', $userEmail)->first();
            }

            // Obtener todas las promociones automáticas activas
            $promotions = Proposalbattery::where('is_coupon', false)
                ->where(function ($query) use ($subtotal) {
                    $query->whereNull('minimum_amount')
                        ->orWhere('minimum_amount', '<=', $subtotal);
                })
                ->get();

            $applicablePromotions = [];

            foreach ($promotions as $promotion) {
                $isApplicable = false;

                switch ($promotion->type) {
                    case 'Global':
                        $isApplicable = true;
                        break;

                    case 'Individual':
                        $isApplicable = $user && $user->promotion_id == $promotion->id;
                        break;

                    case 'Birthday':
                        $isApplicable = $user && $this->isUserBirthdayThisMonth($user);
                        break;

                    case 'Guest':
                        $isApplicable = !$user; // Usuario no registrado
                        break;

                    case 'Normal':
                        $isApplicable = $user && is_null($user->provider);
                        break;

                    case 'Google':
                        $isApplicable = $user && $user->provider === 'google';
                        break;

                    case 'Apple':
                        $isApplicable = $user && $user->provider === 'apple';
                        break;
                }

                if ($isApplicable) {
                    // Calcular descuento
                    $discountAmount = 0;
                    if ($promotion->discount_type === 'percentage') {
                        $discountAmount = ($subtotal * $promotion->discount) / 100;
                    } else {
                        $discountAmount = $promotion->discount;
                    }

                    $discountAmount = min($discountAmount, $subtotal);

                    $applicablePromotions[] = [
                        'id' => $promotion->id,
                        'name' => $promotion->name,
                        'type' => $promotion->type,
                        'discount' => $promotion->discount,
                        'discount_type' => $promotion->discount_type,
                        'discountAmount' => $discountAmount,
                        'minAmount' => $promotion->minimum_amount ?? 0
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'data' => $applicablePromotions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor.'
            ], 500);
        }
    }

    /**
     * Verificar si el usuario cumple años este mes
     */
    private function isUserBirthdayThisMonth($user)
    {
        if (!$user->dob) {
            return false;
        }

        $birthday = \Carbon\Carbon::parse($user->dob);
        $currentMonth = now()->month;

        return $birthday->month === $currentMonth;
    }

    // ===============================================
    // 📦 NUEVOS MÉTODOS - SISTEMA ENVÍO GRATIS
    // ===============================================

    /**
     * Obtener configuración de envío activa
     */
    public function getShippingConfig()
    {
        try {
            $config = \App\Models\ShippingConfig::getActiveConfig();

            if (!$config) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No hay configuración de envío activa'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'min_order_for_free_shipping' => $config->min_order_for_free_shipping,
                    'standard_shipping_fee' => $config->standard_shipping_fee,
                    'description' => $config->description
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error obteniendo configuración de envío'
            ], 500);
        }
    }

    /**
     * Calcular costo de envío basado en subtotal
     */
    public function calculateShipping(Request $request)
    {
        try {
            $request->validate([
                'subtotal' => 'required|numeric|min:0'
            ]);

            $subtotal = floatval($request->subtotal);
            $shippingCost = \App\Models\ShippingConfig::calculateShippingCost($subtotal);
            $qualifiesForFree = \App\Models\ShippingConfig::qualifiesForFreeShipping($subtotal);
            $amountNeeded = \App\Models\ShippingConfig::getAmountNeededForFreeShipping($subtotal);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'qualifies_for_free_shipping' => $qualifiesForFree,
                    'amount_needed_for_free_shipping' => $amountNeeded,
                    'total' => $subtotal + $shippingCost
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error calculando envío'
            ], 500);
        }
    }

    /**
     * Obtener mensaje motivacional para envío gratis
     */
    public function getShippingMotivation($subtotal)
    {
        try {
            $subtotal = floatval($subtotal);
            $config = \App\Models\ShippingConfig::getActiveConfig();

            if (!$config) {
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'message' => 'Envío gratis disponible',
                        'type' => 'success'
                    ]
                ]);
            }

            $qualifiesForFree = $subtotal >= $config->min_order_for_free_shipping;
            $amountNeeded = $config->min_order_for_free_shipping - $subtotal;

            if ($qualifiesForFree) {
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'message' => '🎉 ¡Felicidades! Tienes envío gratis',
                        'type' => 'success',
                        'shipping_cost' => 0
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'message' => "🚚 Agrega $" . number_format($amountNeeded, 2) . " más para envío gratis",
                        'type' => 'motivation',
                        'amount_needed' => $amountNeeded,
                        'shipping_cost' => $config->standard_shipping_fee
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error generando motivación'
            ], 500);
        }
    }

    // ===============================================
    // 🛒 SISTEMA DE LIMPIEZA AUTOMÁTICA DE CARRITO
    // ===============================================

    /**
     * Verificar si el carrito de un usuario ha expirado (>24h sin actividad)
     * NOTA: La lógica principal está en el frontend con AsyncStorage timestamps
     * Este endpoint es solo para validación adicional si es necesario
     */
    public function cartCleanup(Request $request)
    {
        try {
            // 🛒 LÓGICA SIMPLIFICADA: Usar timestamp del frontend
            $lastModified = $request->last_modified ?? null;

            if ($lastModified) {
                // Verificar timestamp proporcionado por el frontend
                $hoursAgo = (time() * 1000 - $lastModified) / (1000 * 60 * 60); // convertir a horas
                $expired = $hoursAgo > 24;

                return response()->json([
                    'expired' => $expired,
                    'hours_since_activity' => round($hoursAgo, 2),
                    'last_modified' => $lastModified
                ]);
            }

            // Si no hay timestamp, considerar que debe limpiarse
            return response()->json(['expired' => true]);
        } catch (\Exception $e) {
            // En caso de error, no forzar limpieza
            return response()->json([
                'expired' => false,
                'error' => 'Error verificando expiración'
            ]);
        }
    }

    /**
     * Registrar actividad del carrito (cuando se modifica)
     * NOTA: Por simplicidad, usamos la tabla orders existente
     */
    public function cartActivity(Request $request)
    {
        try {
            // Por ahora, este endpoint puede quedar como placeholder
            // La actividad se registra automáticamente cuando se crean órdenes
            // En el futuro se podría implementar una tabla separada si es necesario

            return response()->json([
                'status' => 'success',
                'message' => 'Actividad registrada'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error registrando actividad'
            ], 500);
        }
    }

    // ===============================================
    // 🔔 SISTEMA DE NOTIFICACIONES FCM MEJORADO
    // ===============================================

    /**
     * Limpiar token FCM de todos los usuarios (prevenir notificaciones cruzadas)
     */
    public function removeFcmToken(Request $request)
    {
        try {
            $fcmToken = $request->fcm_token;

            if (!$fcmToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token FCM requerido'
                ], 400);
            }

            // Limpiar token de tabla users
            DB::table('users')
                ->where('fcm_token', $fcmToken)
                ->update(['fcm_token' => null]);

            return response()->json([
                'status' => 'success',
                'message' => 'Token FCM limpiado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error limpiando token FCM'
            ], 500);
        }
    }

    /**
     * 🗑️ AUTO-CLEANUP: Eliminar órdenes temporales abandonadas
     * Se ejecuta automáticamente para limpiar órdenes en estado 'processing'
     * después de 2 horas (pago cancelado/abandonado)
     */
    public function cleanupTempOrders()
    {
        try {
            // Buscar órdenes temporales creadas hace más de 2 horas
            $cutoffTime = now()->subHours(2);

            $tempOrders = \App\Models\Order::where('status', 'Processing Payment')
                ->where('created_at', '<', $cutoffTime)
                ->get();

            Log::info("🧹 INICIANDO CLEANUP DE ÓRDENES TEMPORALES", [
                'found_orders' => $tempOrders->count(),
                'cutoff_time' => $cutoffTime
            ]);

            $deletedCount = 0;
            foreach ($tempOrders as $order) {
                // Eliminar detalles de la orden primero
                \DB::table('ordedetails')->where('orderno', $order->order_number)->delete();

                // Eliminar la orden
                $order->delete();
                $deletedCount++;

                Log::info("🗑️ ORDEN TEMPORAL ELIMINADA", [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'created_at' => $order->created_at,
                    'age_hours' => $order->created_at->diffInHours(now())
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => "Cleanup completado: $deletedCount órdenes temporales eliminadas",
                'deleted_count' => $deletedCount
            ]);
        } catch (\Exception $e) {
            Log::error("❌ ERROR EN CLEANUP DE ÓRDENES TEMPORALES", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error en cleanup de órdenes temporales'
            ], 500);
        }
    }

    // ===============================================
    // ❌ SISTEMA DE CANCELACIÓN DE PEDIDOS
    // ===============================================

    /**
     * Cancelar pedido y guardar motivo en feedback
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelOrder(Request $request)
    {
        try {
            // Validar entrada
            $request->validate([
                'order_id' => 'required|integer|exists:orders,id',
                'cancellation_reason' => 'required|string|max:1000',
                'cancelled_by' => 'required|in:customer,driver,admin'
            ]);

            $orderId = $request->order_id;
            $reason = $request->cancellation_reason;
            $cancelledBy = $request->cancelled_by;

            // Buscar la orden
            $order = \App\Models\Order::find($orderId);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Orden no encontrada'
                ], 404);
            }

            // Verificar que la orden no esté ya cancelada o entregada
            if ($order->status === 'Cancelled') {
                return response()->json([
                    'success' => false,
                    'message' => 'La orden ya está cancelada'
                ], 400);
            }

            if (in_array($order->status, ['Delivered', 'delivered', 'entregado'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede cancelar una orden ya entregada'
                ], 400);
            }

            // Actualizar estado de la orden
            $order->status = 'Cancelled';
            $order->status_spanish = 'Cancelado';
            $order->save();

            // Guardar motivo en customerfeedbacks
            \App\Models\Customerfeedback::create([
                'orderno' => $order->id,
                'message' => "Pedido cancelado por {$cancelledBy}. Motivo: {$reason}"
            ]);

            // Enviar notificaciones push
            $firebaseService = new \App\Services\FirebaseNotificationService();

            // 1. Notificación al CLIENTE
            if ($cancelledBy === 'driver') {
                // Driver canceló - notificar al cliente
                if ($order->userid) {
                    $customer = \App\Models\User::find($order->userid);
                    if ($customer && !empty($customer->fcm_token)) {
                        $firebaseService->sendToDevice(
                            $customer->fcm_token,
                            "⚠️ Problema con tu pedido",
                            "El repartidor tuvo un problema y no pudo completar la entrega. Nos contactaremos contigo pronto.",
                            [
                                'type' => 'order_cancelled_by_driver',
                                'order_id' => (string)$orderId
                            ]
                        );
                    }
                } elseif (!empty($order->user_email)) {
                    // Guest customer
                    $guestAddress = \App\Models\GuestAddress::where('guest_email', $order->user_email)->first();
                    if ($guestAddress && !empty($guestAddress->fcm_token)) {
                        $firebaseService->sendToDevice(
                            $guestAddress->fcm_token,
                            "⚠️ Problema con tu pedido",
                            "El repartidor tuvo un problema y no pudo completar la entrega. Nos contactaremos contigo pronto.",
                            [
                                'type' => 'order_cancelled_by_driver',
                                'order_id' => (string)$orderId
                            ]
                        );
                    }
                }
            }

            // 2. Notificación al DRIVER
            if ($cancelledBy === 'customer' && $order->dman) {
                $driver = \App\Models\User::find($order->dman);
                if ($driver && !empty($driver->fcm_token)) {
                    $firebaseService->sendToDevice(
                        $driver->fcm_token,
                        "❌ Pedido cancelado",
                        "El cliente ha cancelado el pedido #{$orderId}.",
                        [
                            'type' => 'order_cancelled_by_customer',
                            'order_id' => (string)$orderId
                        ]
                    );
                }
            }

            Log::info("✅ ORDEN CANCELADA EXITOSAMENTE", [
                'order_id' => $orderId,
                'cancelled_by' => $cancelledBy,
                'reason' => $reason
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pedido cancelado exitosamente',
                'order_id' => $orderId
            ], 200);

        } catch (\Exception $e) {
            Log::error("❌ ERROR AL CANCELAR ORDEN", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar el pedido: ' . $e->getMessage()
            ], 500);
        }
    }
}
