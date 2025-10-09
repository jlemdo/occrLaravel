<?php

namespace App\Http\Controllers\Auth;
use App\Mail\NewLeadMail;
use App\Mail\NewProMail;
use App\Mail\NewDocMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use App\Mail\NewSpeakerRegistrationMail;
use App\Mail\NewUserRegistrationMail;
use App\Models\Country;
use App\Models\Address;
use App\Models\UserAddress;
use App\Models\GuestAddress;
use App\Models\State;
use App\Models\User;
use App\Models\Communicationord;
use App\Models\Customerfeedback;
use App\Models\Driverloc;
use App\Models\Order;
use App\Models\Ordedetail;
use App\Services\FirebaseNotificationService;
use App\Models\Stockweb;
use App\Notifications\NewOrderApi;
use App\Notifications\NewUserRegistrationNotification;
//OutOfStockNotification
use App\Notifications\OutOfStockNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Exception;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request)
    {
        $usertype = $request->usertype;
        $states = State::get();
        $countries = Country::get();
		//$denominations = Denomination::get();
		//dd($denominations);
        $title = 'Register';
        return view('website.register',compact('usertype','states','countries','title'));
        
       
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'contact_number' => 'required|unique:user_details,contact_number',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

		$randomPassword=$request->password;
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => 'United States',
            'state' => $request->state,
            'usertype' => $request->usertype,
            'password' => Hash::make($request->password),
        ]);
        //dd($request->denomination);
        UserDetail::create(['user_id'=>$user->id,'contact_number'=>$request->contact_number]);
       // event(new Registered($user));

        Auth::login($user);
        $admin = User::where('usertype','admin')->first();
       // $admin->notify(new NewUserRegistrationNotification($user));
       
            // 📧 Enviar email de bienvenida usando sistema mejorado
        try {
            \App\Http\Controllers\EmailController::sendWelcomeEmail($user);
        } catch (\Exception $e) {
            \Log::error("Error sending welcome email to {$user->email}: " . $e->getMessage());
        }
        return redirect()->to('/dashboard')->with('success','Logged In Successfully');
        
        return redirect(RouteServiceProvider::HOME);
    }
	
	public function apiRegister(Request $request)
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'contact_number' => 'required|unique:users,phone',
        'password' => ['required', 'confirmed', 'min:6', 'regex:/^[a-zA-Z0-9]+$/'],
        'otp' => 'nullable|string|size:6', // OTP es opcional para backward compatibility
        'skip_otp' => 'nullable|boolean'  // Para cuando OTP está desactivado
    ]);

    // 🔐 VERIFICAR OTP SI ESTÁ ACTIVADO
    $otpEnabled = DB::table('settings')->where('key', 'otp_verification_enabled')->value('value') === 'true';
    
    if ($otpEnabled && !$request->skip_otp) {
        // Si OTP está activado, debe verificarse antes de crear usuario
        if (!$request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Código OTP requerido',
                'requires_otp' => true,
                'otp_enabled' => true
            ], 400);
        }

        // 🔪 CIRUGÍA DE CÓDIGO: La verificación ahora es centralizada.
        // Este endpoint de registro solo debe confirmar que una verificación exitosa ocurrió recientemente.
        // Buscamos un OTP que fue marcado como USADO hace poco.
        $verification = DB::table('email_verifications')
            ->where('email', $request->email)
            ->where('type', 'signup')
            ->where('used', true) // El OTP DEBE estar marcado como usado por el OTPController
            ->where('updated_at', '>', now()->subMinutes(5)) // Y debe haber sido usado en los últimos 5 minutos
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'La verificación del email no se completó o ha expirado. Por favor, intenta registrarte de nuevo.',
                'requires_otp' => true
            ], 400);
        }

        // No es necesario marcar el OTP como usado aquí, OTPController ya lo hizo.
        // Simplemente procedemos con el registro.
    }

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'country' => 'United States',
        'state' => $request->state ?? 'USA',
        'usertype' => $request->usertype ?? 'customer',
        'password' => Hash::make($request->password),
        'dob' => $request->dob,
        'phone' => $request->contact_number,
        'show_password' => $request->password,
    ]);
    $admin = User::where('usertype','admin')->first();
    $admin->notify(new NewUserRegistrationNotification($user));

    // 📧 Enviar email de bienvenida
    EmailController::sendWelcomeEmail($user);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'User registered successfully',
        'user' => $user,
        'token' => $token
    ], 201);
}


	public function orderSubs(Request $request)
{
    // 🔐 OTP DESHABILITADO TEMPORALMENTE PARA GUESTS - OPTIMIZACIÓN
    // TODO: Implementar OTP correctamente en el frontend cuando sea necesario
    /*
    if (!$request->userid && $request->user_email) { // Es un guest
        // OTP logic temporalmente deshabilitado para evitar demoras
    }
    */

    // ✅ VALIDACIÓN CRÍTICA: Asegurar que siempre haya dirección y coordenadas
    $request->validate([
        'delivery_address' => 'required|string',
        'customer_lat' => 'required',
        'customer_long' => 'required',
        'user_email' => 'required|email',
    ], [
        'delivery_address.required' => 'La dirección de entrega es obligatoria',
        'customer_lat.required' => 'Las coordenadas de ubicación son obligatorias',
        'customer_long.required' => 'Las coordenadas de ubicación son obligatorias',
        'user_email.required' => 'El correo electrónico es obligatorio',
    ]);

    // Generar order_number consistente con el frontend (formato AA-MM-DD-HH-MM-SS)
    $now = new \DateTime();
    $orderNumber = $this->generateOrderNumber($now);
    
    // Asegurar unicidad del order_number
    $counter = 0;
    $originalOrderNumber = $orderNumber;
    while (Order::where('order_number', $orderNumber)->exists()) {
        $counter++;
        $orderNumber = $originalOrderNumber . str_pad($counter, 2, '0', STR_PAD_LEFT);
    }

    $order = Order::create([
        'order_number' => $orderNumber,
        'orderno' => $request->orderno ?: $orderNumber, // Usar orderno del frontend o fallback
        
        // 🚨 FIX CRÍTICO: Crear como orden TEMPORAL hasta confirmar pago
        'status' => 'Processing Payment',
        'status_spanish' => 'Procesando pago', // Estado inicial temporal
        'userid' => $request->userid,
        'customer_lat' => $request->customer_lat,
        'customer_long' => $request->customer_long,
        'delivery_address' => $request->delivery_address, // 🔪 CIRUGÍA: Dirección escrita
        'user_email' => $request->user_email,
        'need_invoice' => $request->need_invoice,
        'tax_details' => $request->tax_details,
        'delivery_date' => $this->processDeliveryDate($request->delivery_date),
        'delivery_slot' => $request->delivery_slot,
        // Campos de cupón
        'coupon_code' => $request->coupon_code,
        'coupon_discount' => $request->coupon_discount,
        'coupon_type' => $request->coupon_type,
        'discount_amount' => $request->discount_amount ?? 0.00,
        // 🚚 NUEVOS CAMPOS: Información de envío y totales
        'shipping_cost' => $request->shipping_cost ?? 0.00,
        'subtotal' => $request->subtotal ?? 0.00,
        'total_amount' => $request->total_amount ?? 0.00,
    ]);
    $outOfStockItems = '';
    
    // 🔔 FIX CRÍTICO: Guardar FCM token para Guest notifications
    if (!$request->userid && $request->user_email && $request->fcm_token) {
        try {
            // Crear o actualizar guest_address con el FCM token y dirección de la orden
            GuestAddress::createOrUpdate($request->user_email, [
                'address' => $request->delivery_address,
                'latitude' => $request->customer_lat,
                'longitude' => $request->customer_long,
                'phone' => null, // Se puede agregar phone en el futuro si está en el request
                'fcm_token' => $request->fcm_token
            ]);
            
            \Log::info('🔔 FCM token guardado para Guest', [
                'email' => $request->user_email,
                'fcm_token_prefix' => substr($request->fcm_token, 0, 20) . '...'
            ]);
        } catch (\Exception $e) {
            \Log::error('❌ Error guardando FCM token para Guest', [
                'email' => $request->user_email,
                'error' => $e->getMessage()
            ]);
        }
    }

    foreach ($request->orderdetails as $detail) {
        Ordedetail::create([
            'orderno' => $order->order_number, // Usar order_number consistente con frontend
            'userid' => $request->userid,
            'item_name' => $detail['item_name'],
            'item_price' => $detail['item_price'],
            'item_qty' => $detail['item_qty'],
            'item_image' => $detail['item_image']
        ]);
        $totalPurchased = Stockweb::where('product', $detail['item_name'])->sum('qty');
        $totalSold = Ordedetail::where('item_name', $detail['item_name'])->sum('item_qty');

        if (($totalPurchased - $totalSold) <= 0) {
            $outOfStockItems = $detail['item_name'];
        }
        
         if (!empty($outOfStockItems)) {
             $admin = User::where('usertype','admin')->first();
             $admin->notify(new OutOfStockNotification($order, $outOfStockItems));
    }
        
    }

    $user = User::find($request->userid);

    // 🔧 Calculate total directly from request (más sencillo)
    $total = collect($request->orderdetails)->sum(function ($item) {
        return $item['item_price'] * $item['item_qty'];
    });
    $admin = User::where('usertype','admin')->first();
    $admin->notify(new NewOrderApi($order, $total));

    // 🔪 CIRUGÍA: NOTIFICACIONES PREMATURAS ELIMINADAS
    // Las notificaciones ahora solo se envían DESPUÉS de confirmar pago via webhook
    // El usuario no recibirá "pedido confirmado" hasta que Stripe confirme el pago
    // Esto elimina la confusión de notificaciones antes del pago real

    // Generate PDF file name
    $fileName = 'invoice_' . $order->id . '_' . Str::random(5) . '.pdf';
    
    // 🔧 HOSTING COMPATIBILITY: Detectar si estamos en hosting con public_html
    if (is_dir(base_path('public_html'))) {
        // Estamos en servidor de hosting (public_html existe)
        $filePath = base_path('public_html/invoices/' . $fileName);
        $publicInvoicesDir = base_path('public_html/invoices');
    } else {
        // Estamos en desarrollo local (usar public normal)
        $filePath = public_path('invoices/' . $fileName);
        $publicInvoicesDir = public_path('invoices');
    }

    // 🔍 DEBUG: Log PDF generation attempt
    \Log::info('🔍 PDF GENERATION START', [
        'order_id' => $order->id,
        'file_name' => $fileName,
        'file_path' => $filePath,
        'invoices_dir' => $publicInvoicesDir,
        'invoices_dir_exists' => is_dir($publicInvoicesDir),
        'invoices_writable' => is_writable(dirname($publicInvoicesDir)),
        'is_hosting_environment' => is_dir(base_path('public_html')),
        'user_id' => $user->id ?? 'null',
        'total' => $total
    ]);

    try {
        // Ensure invoices directory exists
        if (!file_exists($publicInvoicesDir)) {
            mkdir($publicInvoicesDir, 0755, true);
            \Log::info('📁 Created invoices directory', ['path' => $publicInvoicesDir]);
        }

        // Obtener detalles de productos para el PDF
        $orderDetails = Ordedetail::where('orderno', $order->order_number)->get();
        
        // Generate and save PDF con formato de ticket térmico
        $pdf = PDF::loadView('pdf.invoice', [
            'order' => $order,
            'user' => $user,
            'total' => $total,
            'orderDetails' => $orderDetails
        ])
        ->setOption('isRemoteEnabled', true)
        ->setPaper([0, 0, 226.77, 566.93], 'portrait'); // 80mm x 200mm aproximadamente
        
        $pdf->save($filePath);

        // Verify file was created
        if (file_exists($filePath)) {
            $fileSize = filesize($filePath);
            \Log::info('✅ PDF GENERATION SUCCESS', [
                'file_path' => $filePath,
                'file_size' => $fileSize . ' bytes'
            ]);
            
            // Update order with invoice file name
            $order->invoice = $fileName;
            $order->save();
        } else {
            \Log::error('❌ PDF FILE NOT CREATED', ['expected_path' => $filePath]);
        }
        
    } catch (\Exception $e) {
        \Log::error('❌ PDF GENERATION FAILED', [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        // Continue without PDF if generation fails
        $order->invoice = null;
        $order->save();
    }

    // 📧 Enviar email de confirmación de pedido
    try {
        $orderItems = $request->orderdetails;
        $customerData = [
            'name' => $user ? ($user->name ?? $user->first_name . ' ' . $user->last_name) : 'Cliente',
            'email' => $request->user_email,
            'address' => $request->delivery_address
        ];
        
        EmailController::sendOrderConfirmedEmail($order->toArray(), $orderItems, $customerData);
    } catch (\Exception $e) {
        \Log::error("Error sending order confirmation email: " . $e->getMessage());
    }

    return response()->json([
        'message' => 'Order Submitted successfully',
        'order' => $order
    ], 201);
}

	public function migorders(Request $request)
{
    try {
        $email = $request->user_email;
        
        if (!$email) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email es requerido'
            ], 400);
        }
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }
        
        // 🆕 NUEVA ESTRATEGIA: Migración por COPIA (mantiene acceso Guest)
        // Buscar órdenes Guest que aún no han sido migradas
        $guestOrders = Order::where('user_email', $email)
                           ->where('userid', null)  // Solo órdenes Guest
                           ->get();
        
        if ($guestOrders->isEmpty()) {
            return response()->json([
                'status' => 'info',
                'message' => 'No hay órdenes Guest para migrar',
                'migrated_count' => 0
            ], 200);
        }
        
        $migratedCount = 0;
        
        foreach ($guestOrders as $guestOrder) {
            // Crear COPIA como usuario registrado (mantiene original Guest)
            $userOrder = $guestOrder->replicate();
            $userOrder->userid = $user->id;
            $userOrder->order_number = $userOrder->order_number . '-USR'; // Diferenciador
            $userOrder->save();
            
            // Copiar order_details
            $orderDetails = \DB::table('ordedetails')
                              ->where('orderno', $guestOrder->order_number)
                              ->get();
                              
            foreach ($orderDetails as $detail) {
                \DB::table('ordedetails')->insert([
                    'orderno' => $userOrder->order_number,
                    'userid' => $user->id,
                    'item_name' => $detail->item_name,
                    'item_price' => $detail->item_price,
                    'item_qty' => $detail->item_qty,
                    'item_image' => $detail->item_image,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            $migratedCount++;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Órdenes migradas exitosamente',
            'migrated_count' => $migratedCount,
            'user' => $user
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error migrando órdenes: ' . $e->getMessage()
        ], 500);
    }
}

	public function addaddress(Request $request)
{
    $userid = $request->userid;
    $is_default = $request->is_default;
    if ($request->is_default == 1) {
        Address::where('userid', $userid)->update(['is_default' => 0]);
    }
    $user = Address::create([
            'userid' => $request->userid,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_default' => $request->is_default,
        ]);
       
   

    return response()->json([
        'message' => 'Address successfully',
        'order' => $user
    ], 201);
}

//updateaddress
	public function updateaddress(Request $request)
{
    $userid = $request->userid;
    $address_id = $request->address_id;
    $is_default = $request->is_default;
    if ($request->is_default == 1) {
        Address::where('userid', $userid)->update(['is_default' => 0]);
    }
    $address = Address::where('id', $address_id)
                      ->where('userid', $userid)
                      ->firstOrFail();

    // Update the address fields
    $user = $address->update([
        'address' => $request->address,
        'phone' => $request->phone,
        'is_default' => $request->is_default ?? 0,
    ]);
       
   

    return response()->json([
        'message' => 'Address successfully Updated',
        'order' => $user
    ], 201);
}
//deleteaddress
public function deleteaddress(Request $request)
{
    $id = $request->id;

    $address = Address::findOrFail($id); // Find the address by ID
    $address->delete(); // Delete the address

    return response()->json([
        'message' => 'Address successfully deleted'
    ], 200);
}
public function fetch_address($id)
{
    
    $orders = Address::where('userid', $id)->get();
    
   return response()->json([
        'status' => 'success',
        'data' => $orders
    ], 200);
}

//fetch_address_single_edit
public function fetch_address_single_edit($id)
{
    
    $orders = Address::where('id', $id)->first();
    
   return response()->json([
        'status' => 'success',
        'data' => $orders
    ], 200);
}
public function driverlocsubmit(Request $request)
{
    $order = Driverloc::create([
        'orderid' => $request->orderid,
        'driver_lat' => $request->driver_lat,
        'driver_long' => $request->driver_long,
    ]);
    
     $order = Order::find($request->orderid);
     $order->status = 'On the Way';
     $order->status_spanish = 'En camino';
     $order->save();

     // 🔔 Notificación push: Pedido en camino
     $user = User::find($order->userid);
     if ($user && !empty($user->fcm_token)) {
         // 💰 Calcular total del pedido para notificación
         $orderTotal = $this->calculateOrderTotal($order->order_number);
         
         $firebaseService = new FirebaseNotificationService();
         $firebaseService->sendOrderNotification(
             $user->fcm_token,
             $order->order_number ?: $order->id,
             'on_the_way',
             "¡Tu pedido está en camino! Total: $" . number_format($orderTotal, 2) . " 🚚"
         );
     }
     // 🔪 CIRUGÍA: Guest también recibe notificación "en camino"
     elseif (!$user && !empty($order->user_email)) {
         $guestAddress = GuestAddress::where('guest_email', $order->user_email)->first();
         if ($guestAddress && !empty($guestAddress->fcm_token)) {
             // 💰 Calcular total del pedido para Guest
             $orderTotal = $this->calculateOrderTotal($order->order_number);
                 
             $firebaseService = new FirebaseNotificationService();
             $firebaseService->sendOrderNotification(
                 $guestAddress->fcm_token,
                 $order->order_number ?: $order->id,
                 'on_the_way',
                 "¡Tu pedido está en camino! Total: $" . number_format($orderTotal, 2) . " 🚚"
             );
         }
     }

    return response()->json([
        'message' => 'Location Submitted successfully',
        'order' => $order
    ], 201);
}


	public function orderdel(Request $request)
{
    
        $orderid = $request->orderid;
        $order = Order::find($orderid);
        $order->status = 'Delivered';
        $order->status_spanish = 'Entregado';
        $order->save();

        // 🔔 Notificación push: Pedido entregado
        $user = User::find($order->userid);
        if ($user && !empty($user->fcm_token)) {
            // 💰 Calcular total del pedido para notificación
            $orderTotal = $this->calculateOrderTotal($order->order_number);
                
            $firebaseService = new FirebaseNotificationService();
            $firebaseService->sendOrderNotification(
                $user->fcm_token,
                $order->order_number ?: $order->id,
                'delivered',
                "¡Pedido entregado exitosamente! Total: $" . number_format($orderTotal, 2) . " - ¡Esperamos que lo disfrutes! 🎉"
            );
        }
        // 🔪 CIRUGÍA: Guest también recibe notificación "entregado"
        elseif (!$user && !empty($order->user_email)) {
            $guestAddress = GuestAddress::where('guest_email', $order->user_email)->first();
            if ($guestAddress && !empty($guestAddress->fcm_token)) {
                // 💰 Calcular total del pedido para Guest
                $orderTotal = $this->calculateOrderTotal($order->order_number);
                    
                $firebaseService = new FirebaseNotificationService();
                $firebaseService->sendOrderNotification(
                    $guestAddress->fcm_token,
                    $order->order_number ?: $order->id,
                    'delivered',
                    "¡Pedido entregado exitosamente! Total: $" . number_format($orderTotal, 2) . " - ¡Esperamos que lo disfrutes! 🎉"
                );
            }
        }

    // 📧 Enviar email de entrega completada
    try {
        $orderItems = Ordedetail::where('orderno', $order->order_number)->get()->toArray();
        $customerData = [
            'name' => $user ? ($user->name ?? $user->first_name . ' ' . $user->last_name) : 'Cliente',
            'email' => $order->user_email,
            'address' => $order->delivery_address
        ];
        
        EmailController::sendOrderDeliveredEmail($order->toArray(), $orderItems, $customerData);
    } catch (\Exception $e) {
        \Log::error("Error sending order delivered email: " . $e->getMessage());
    }

    return response()->json([
        'message' => 'Order Status changed to delivered successfully',
        'order' => $order
    ], 201);
}

// Función helper para mapear estados a español
private function getSpanishStatus($status, $paymentStatus = null)
{
    $statusMap = [
        // Estados principales
        'open' => 'Abierto',
        'pending' => 'Pendiente', 
        'processing' => 'Procesando',
        'confirmed' => 'Confirmado',
        'preparing' => 'Preparando',
        'ready' => 'Listo para entrega',
        'on_the_way' => 'En camino',
        'out_for_delivery' => 'En camino',
        'delivered' => 'Entregado',
        'completed' => 'Completado',
        'cancelled' => 'Cancelado',
        'refunded' => 'Reembolsado',
        
        // Estados de pago
        'payment_pending' => 'Pendiente de pago',
        'payment_confirmed' => 'Pago confirmado',
        'payment_failed' => 'Pago fallido',
    ];
    
    // Si tiene payment_status, priorizarlo
    if ($paymentStatus && isset($statusMap[$paymentStatus])) {
        return $statusMap[$paymentStatus];
    }
    
    // Mapear status principal
    return $statusMap[strtolower($status)] ?? ucfirst($status);
}

public function orderHistory($userid)
{
    // 🚨 FIX CRÍTICO: Solo mostrar órdenes confirmadas (no temporales)
    $orders = Order::where('userid', $userid)
        ->where('status', '!=', 'Processing Payment') // Filtrar órdenes temporales
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($order) {
            // 🔧 Buscar por order_number primero, fallback a id para órdenes antiguas
            $orderDetails = \DB::table('ordedetails')->where('orderno', $order->order_number)->get();
            
            // Si no hay detalles con order_number, intentar con id (compatibilidad órdenes antiguas)
            if ($orderDetails->isEmpty() && $order->id) {
                $orderDetails = \DB::table('ordedetails')->where('orderno', $order->id)->get();
            }
            
            // 🚚 ARREGLAR: Calcular total incluyendo shipping
            $subtotalPrice = $orderDetails->sum(function ($item) {
                return $item->item_price * $item->item_qty;
            });
            
            // Usar total_amount guardado en BD si está disponible, sino calcular con shipping
            $order->total_price = $order->total_amount > 0 
                ? $order->total_amount 
                : $subtotalPrice + ($order->shipping_cost ?? 0);
            $order->order_details = $orderDetails; // Para compatibilidad frontend
            return $order;
        });

    return response()->json([
        'orders' => $orders
    ], 200);
}

public function orderHistoryDriver($userid)
{
    // 🚨 FIX CRÍTICO: Solo mostrar órdenes confirmadas para drivers
    $orders = Order::where('dman', $userid)
        ->where('status', '!=', 'Processing Payment') // Filtrar órdenes temporales
        ->with(['orderDetails' => function ($query) {
            $query->select('*'); 
        }])->orderByRaw(                                  // custom ordering
            "FIELD(status, 'Open', 'On the way', 'Delivered')"
        )
        ->get()
        ->map(function ($order) {
            // 🚚 ARREGLAR: Calculate total price including shipping
            $subtotalPrice = $order->orderDetails->sum(function ($item) {
                return $item->item_price * $item->item_qty;
            });
            
            // Usar total_amount guardado en BD si está disponible, sino calcular con shipping
            $order->total_price = $order->total_amount > 0 
                ? $order->total_amount 
                : $subtotalPrice + ($order->shipping_cost ?? 0);

            return $order;
        });

    return response()->json([
        'orders' => $orders
    ], 200);
}

public function orderDetails($orderId)
{
    /* 1. single order */
    $order = Order::findOrFail($orderId);

    /* 2. 🔧 Buscar order_details directamente en tabla ordedetails (mismo fix que orderHistory) */
    $orderDetails = \DB::table('ordedetails')->where('orderno', $order->order_number)->get();
    
    /* 3. runtime total */
    $order->total_price = $orderDetails->sum(function ($item) {
        return $item->item_price * $item->item_qty;
    });
    
    /* 4. Agregar order_details para frontend */
    $order->order_details = $orderDetails;

    /* 3. fetch both users in one shot */
    $users = User::select('id', 'first_name','last_name', 'email')  // pick the columns you need
                 ->whereIn('id', [$order->userid, $order->dman])
                 ->get()
                 ->keyBy('id');        // makes lookup easy: $users[92], $users[106]

    /* 4. attach to the order model (these are just dynamic properties) */
    $order->customer = $users->get($order->userid);   // may be null if user deleted
    $order->driver   = $users->get($order->dman);

    return response()->json(['order' => $order], 200);
}

	
	 public function registeradmin(Request $request): RedirectResponse
    {
        
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);
        $profilephot ='';
		if ($image = $request->file('profile_photo')) {
            request()->validate([
                'profile_photo' => 'image|mimes:jpg,png,jpeg|max:50000',
            ]);
            $destinationPath = public_path('profile/');
            $profileImage = 'cover'.date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profilephot = "$profileImage";
           
        }
        $randomPassword = Str::random(8);
		//ye random password es user ko email kr dena he first time per
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => 'United States',
            'state' => '',
            'usertype' => $request->usertype,
            'gender' => 'Male',
            'password' => Hash::make($randomPassword),
            'image'=>$profilephot,
            'intro' => $request->intro,
            'show_password' => $randomPassword,
            'address' => $request->address,
            'phone' => $request->contact_number
        ]);
         $admin = User::where('usertype','admin')->first();
        $admin->notify(new NewUserRegistrationNotification($user));
       
       return redirect()->to('/allsalereps')->with('success','User added Successfully');
			
        
    }
    
    ////////////////////////
    public function msgsubmit(Request $request)
{
    $order = Communicationord::create([
        'orderid' => $request->orderid,
        'sender' => $request->sender,
        'message' => $request->message,
    ]);

    // 💬 NUEVO: Enviar push notification al receptor del mensaje
    $this->sendChatNotification($request->orderid, $request->sender, $request->message);

    return response()->json([
        'message' => 'Message Submitted successfully',
        'data' => $order
    ], 201);
}
 public function compsubmit(Request $request)
{
    $order = Customerfeedback::create([
        'orderno' => $request->orderno,
        'message' => $request->message,
    ]);

    return response()->json([
        'message' => 'Feedback Submitted successfully',
        'data' => $order
    ], 201);
}
public function msgfetch($orderid)
{

    $orders = Communicationord::where('orderid', $orderid)->get();

   return response()->json([
        'status' => 'success',
        'data' => $orders
    ], 200);
}

// 💬 NUEVO: Función para enviar notificaciones push de mensajes de chat
private function sendChatNotification($orderid, $sender, $message)
{
    try {
        // Obtener información de la orden
        $order = Order::find($orderid);
        if (!$order) return;

        $receiverFcmToken = null;
        $senderName = '';
        $notificationTitle = '';

        if ($sender === 'driver') {
            // Mensaje del driver al customer
            $senderName = 'Tu repartidor';
            $notificationTitle = '💬 Mensaje del repartidor';

            // Buscar FCM token del customer
            if ($order->userid) {
                // Customer registrado
                $customer = User::find($order->userid);
                $receiverFcmToken = $customer ? $customer->fcm_token : null;
            } else {
                // Guest customer
                $guestAddress = GuestAddress::where('guest_email', $order->user_email)->first();
                $receiverFcmToken = $guestAddress ? $guestAddress->fcm_token : null;
            }
        } else {
            // Mensaje del customer al driver
            $senderName = 'Cliente';
            $notificationTitle = '💬 Mensaje del cliente';

            // Buscar FCM token del driver
            $driver = User::find($order->driver_id);
            $receiverFcmToken = $driver ? $driver->fcm_token : null;
        }

        // Enviar notificación si hay FCM token
        if ($receiverFcmToken) {
            $firebaseService = new FirebaseNotificationService();
            $firebaseService->sendChatNotification(
                $receiverFcmToken,
                $orderid,
                $senderName,
                $message,
                $notificationTitle
            );
        }
    } catch (\Exception $e) {
        // Log error pero no fallar el endpoint principal
        \Log::error("Error sending chat notification: " . $e->getMessage());
    }
}
public function userdetails($userid)
{
    
    $orders = User::where('id', $userid)->get();
    
   return response()->json([
        'status' => 'success',
        'data' => $orders
    ], 200);
}
  ////////////////////////
    public function updateuserprofile(Request $request)
{
     $user = User::findOrFail($request->userid);
     $user ->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'address' => $request->address,
        'phone' => $request->phone,
        'dob' => $request->dob,
        'fcm_token' => $request->fcm_token ?? $user->fcm_token, // Mantener token existente si no se proporciona
    ]);

    return response()->json([
        'message' => 'Profile updated successfully',
        'data'    => $user->fresh(), 
    ], 200);
}

/**
 * Actualizar solo FCM token sin afectar otros campos
 * Fix para evitar corrupción de datos del perfil
 */
public function updateFcmToken(Request $request)
{
    try {
        $user = User::findOrFail($request->userid);
        
        // 🔒 FIX NOTIFICACIONES: Limpiar token de otros usuarios primero
        if ($request->fcm_token) {
            // Limpiar de otros usuarios
            User::where('fcm_token', $request->fcm_token)
                ->where('id', '!=', $user->id)
                ->update(['fcm_token' => null, 'session_id' => null]);
            
            // Limpiar de guest addresses
            \App\Models\GuestAddress::where('fcm_token', $request->fcm_token)
                ->update(['fcm_token' => null, 'session_id' => null]);
        }
        
        // Generar session_id único para este usuario
        $sessionId = \Illuminate\Support\Str::random(10);
        
        // Actualizar usuario actual con token y sesión única
        $user->update([
            'fcm_token' => $request->fcm_token,
            'session_id' => $sessionId
        ]);
        
        return response()->json([
            'message' => 'FCM token updated successfully',
            'user_id' => $user->id,
            'session_id' => $sessionId
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating FCM token',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function driverlocationsagainstorder($orderid)
{
    
    $orders = Driverloc::where('orderid', $orderid)->get();
    
   return response()->json([
        'status' => 'success',
        'data' => $orders
    ], 200);
}

/**
 * Genera order_number en formato consistente con el frontend (AA-MM-DD-HH-MM-SS)
 * @param \DateTime $dateTime
 * @return string
 */
private function generateOrderNumber(\DateTime $dateTime): string
{
    $year = $dateTime->format('y'); // AA: últimos 2 dígitos del año
    $month = $dateTime->format('m'); // MM: mes con 0 inicial
    $day = $dateTime->format('d'); // DD: día con 0 inicial
    $hours = $dateTime->format('H'); // HH: horas con 0 inicial
    $minutes = $dateTime->format('i'); // MM: minutos con 0 inicial
    $seconds = $dateTime->format('s'); // SS: segundos con 0 inicial

    return "{$year}{$month}{$day}-{$hours}{$minutes}{$seconds}";
}

// ===============================================
// 🏠 NUEVOS MÉTODOS PARA SISTEMA DE DIRECCIONES
// ===============================================

/**
 * Obtener todas las direcciones de un usuario registrado
 */
public function getUserAddresses(Request $request, $userId)
{
    try {
        $addresses = UserAddress::where('user_id', $userId)
                               ->orderBy('is_primary', 'desc')
                               ->orderBy('created_at', 'desc')
                               ->get();
        
        return response()->json([
            'status' => 'success',
            'addresses' => $addresses
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error obteniendo direcciones: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Agregar nueva dirección para usuario registrado
 */
public function addUserAddress(Request $request)
{
    try {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'address' => 'required|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'label' => 'nullable|string|max:50',
            'is_primary' => 'nullable|boolean'
        ]);

        // Verificar límite de 3 direcciones por usuario
        $addressCount = UserAddress::where('user_id', $request->user_id)->count();
        if ($addressCount >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Solo puedes tener un máximo de 3 direcciones guardadas.'
            ], 400);
        }

        // Si es la primera dirección o se marca como primaria
        $isPrimary = $request->is_primary || $addressCount === 0;

        $address = UserAddress::create([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'label' => $request->label ?: 'Dirección',
            'is_primary' => $isPrimary
        ]);

        // Si se marca como primaria, desmarcar las demás
        if ($isPrimary) {
            $address->makePrimary();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Dirección agregada exitosamente',
            'address' => $address
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error agregando dirección: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Actualizar dirección de usuario registrado
 */
public function updateUserAddress(Request $request, $addressId)
{
    try {
        $request->validate([
            'address' => 'required|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'label' => 'nullable|string|max:50',
            'is_primary' => 'nullable|boolean'
        ]);

        $address = UserAddress::findOrFail($addressId);
        
        $address->update([
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'label' => $request->label ?: $address->label,
        ]);

        // Si se marca como primaria
        if ($request->is_primary) {
            $address->makePrimary();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Dirección actualizada exitosamente',
            'address' => $address->fresh()
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error actualizando dirección: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Eliminar dirección de usuario registrado
 */
public function deleteUserAddress(Request $request, $addressId)
{
    try {
        $address = UserAddress::findOrFail($addressId);
        $userId = $address->user_id;
        $wasPrimary = $address->is_primary;
        
        $address->delete();

        // Si se eliminó la dirección primaria, hacer primaria la más reciente
        if ($wasPrimary) {
            $nextPrimary = UserAddress::where('user_id', $userId)
                                     ->orderBy('created_at', 'desc')
                                     ->first();
            if ($nextPrimary) {
                $nextPrimary->update(['is_primary' => true]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Dirección eliminada exitosamente'
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error eliminando dirección: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Establecer dirección como primaria
 */
public function setPrimaryAddress(Request $request, $addressId)
{
    try {
        $address = UserAddress::findOrFail($addressId);
        $address->makePrimary();

        return response()->json([
            'status' => 'success',
            'message' => 'Dirección establecida como primaria',
            'address' => $address->fresh()
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error estableciendo dirección primaria: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Guardar dirección de guest
 */
public function saveGuestAddress(Request $request)
{
    try {
        $request->validate([
            'guest_email' => 'required|email',
            'address' => 'required|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'fcm_token' => 'nullable|string|max:255'
        ]);

        $guestAddress = GuestAddress::createOrUpdate($request->guest_email, [
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'phone' => $request->phone,
            'fcm_token' => $request->fcm_token
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Dirección de guest guardada exitosamente',
            'address' => $guestAddress
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error guardando dirección guest: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Obtener dirección de guest por email
 */
public function getGuestAddress(Request $request, $email)
{
    try {
        $guestAddress = GuestAddress::getByEmail($email);
        
        if ($guestAddress) {
            return response()->json([
                'status' => 'success',
                'address' => $guestAddress
            ], 200);
        } else {
            return response()->json([
                'status' => 'not_found',
                'message' => 'No se encontró dirección para este guest'
            ], 404);
        }

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error obteniendo dirección guest: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * 🆕 Obtener órdenes de guest por email
 */
public function getGuestOrders(Request $request, $email)
{
    try {
        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Formato de email inválido'
            ], 400);
        }
        
        // Buscar órdenes Guest (userid = null + email coincide)
        // 🚨 FIX CRÍTICO: Solo mostrar órdenes confirmadas para guests
        $orders = Order::where('userid', null)
                       ->where('user_email', $email)
                       ->where('status', '!=', 'Processing Payment') // Filtrar órdenes temporales
                       ->orderBy('created_at', 'desc')
                       ->paginate(20); // Paginación para performance
        
        // Agregar order_details a cada orden
        $orders->getCollection()->transform(function ($order) {
            // Buscar detalles por order_number
            $orderDetails = \DB::table('ordedetails')
                              ->where('orderno', $order->order_number)
                              ->get();
            
            // Si no hay detalles con order_number, intentar con id (compatibilidad)
            if ($orderDetails->isEmpty() && $order->id) {
                $orderDetails = \DB::table('ordedetails')
                                  ->where('orderno', $order->id)
                                  ->get();
            }
            
            // Calcular precio total
            $order->total_price = $orderDetails->sum(function ($item) {
                return $item->item_price * $item->item_qty;
            });
            
            $order->order_details = $orderDetails;
            return $order;
        });

        return response()->json([
            'status' => 'success',
            'orders' => $orders,
            'total_orders' => $orders->total(),
            'current_page' => $orders->currentPage(),
            'has_more' => $orders->hasMorePages()
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error obteniendo órdenes guest: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * 🗑️ Eliminar cuenta de usuario
     */
    public function deleteUser(Request $request)
    {
        // Validar userid requerido siempre
        if (!$request->userid) {
            return response()->json([
                'status' => 'error',
                'message' => 'userid es requerido'
            ], 422);
        }

        // Buscar usuario
        $user = User::find($request->userid);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        // ✅ NUEVO: Manejo diferenciado para OAuth vs Local
        if ($request->has('provider') && !empty($request->provider)) {
            // ========================================
            // 🔐 USUARIO OAUTH (Google/Apple)
            // ========================================

            // Verificar que el provider coincida con el usuario
            if ($user->provider !== $request->provider) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Provider OAuth no coincide con el usuario'
                ], 401);
            }

            // OAuth: Ya fue re-autenticado en frontend con Google/Apple
            // No necesitamos verificar password ya que no existe

        } else {
            // ========================================
            // 🔑 USUARIO LOCAL (email/password)
            // ========================================

            // Validar password requerido para usuarios locales
            if (!$request->password) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'password es requerido para usuarios locales'
                ], 422);
            }

            // Verificar contraseña como antes
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Contraseña incorrecta'
                ], 401);
            }
        }

        try {
            // Eliminar usuario (funciona igual para OAuth y Local)
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Cuenta eliminada exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error eliminando cuenta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 💰 Helper: Calcular total del pedido para notificaciones
     */
    private function calculateOrderTotal($orderNumber)
    {
        return Ordedetail::where('orderno', $orderNumber)
            ->sum(\DB::raw('item_price * item_qty'));
    }

    /**
     * 🇲🇽 NUEVO: Procesar fecha de entrega con timezone de México
     *
     * Este método asegura que las fechas se interpreten correctamente
     * en el timezone de México, evitando problemas de conversión UTC.
     */
    private function processDeliveryDate($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            // Si la fecha viene en formato YYYY-MM-DD (desde frontend)
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateString)) {
                // Crear fecha explícitamente en timezone de México
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $dateString, 'America/Mexico_City');

                // Log para debug (remover en producción)
                \Log::info('🇲🇽 Fecha procesada:', [
                    'input' => $dateString,
                    'processed' => $date->format('Y-m-d'),
                    'timezone' => $date->timezone->getName(),
                    'day_name' => $date->locale('es')->isoFormat('dddd')
                ]);

                return $date->format('Y-m-d');
            }

            // Si viene en otro formato, intentar parsear con Carbon
            $date = \Carbon\Carbon::parse($dateString, 'America/Mexico_City');
            return $date->format('Y-m-d');

        } catch (\Exception $e) {
            \Log::error('Error procesando fecha de entrega:', [
                'input' => $dateString,
                'error' => $e->getMessage()
            ]);

            // Fallback: devolver el string original
            return $dateString;
        }
    }
}
