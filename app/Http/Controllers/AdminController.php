<?php

namespace App\Http\Controllers;

use App\Models\Customerfeedback;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Order;
use App\Models\Ordedetail;
use App\Models\Tasks;
use App\Models\Proposalbattery;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Notifications\DriverChange;
use App\Notifications\NewOrder;
use App\Services\FirebaseNotificationService;


class AdminController extends Controller
{

    public function allusers()
    {
        $title = 'Users Management';
        $users = User::where('usertype', 'staff')->latest()->get();
        return view('admin.users.index', compact('users', 'title'))->with('i', 1);
    }
    //markAsRead

    public function allsalereps()
    {
        $title = 'Users Management';
        $users = User::latest()->get();

        // Para cada usuario, calcular promociones automáticas aplicables
        foreach ($users as $user) {
            $user->automatic_promotions = $this->getAutomaticPromotionsForUser($user);
        }

        return view('admin.users.salereps', compact('users', 'title'))->with('i', 1);
    }

    /**
     * Obtener promociones automáticas aplicables para un usuario específico
     */
    private function getAutomaticPromotionsForUser($user)
    {
        // Obtener todas las promociones automáticas activas
        $promotions = \App\Models\Proposalbattery::where('is_coupon', false)->get();
        $applicablePromotions = [];

        foreach ($promotions as $promotion) {
            $isApplicable = false;

            switch ($promotion->type) {
                case 'Global':
                    $isApplicable = true;
                    break;

                case 'Individual':
                    $isApplicable = $user->promotion_id == $promotion->id;
                    break;

                case 'Birthday':
                    $isApplicable = $this->isUserBirthdayThisMonth($user);
                    break;

                case 'Guest':
                    $isApplicable = false; // Los usuarios registrados no califican para promociones de Guest
                    break;

                case 'Normal':
                    $isApplicable = is_null($user->provider);
                    break;

                case 'Google':
                    $isApplicable = $user->provider === 'google';
                    break;

                case 'Apple':
                    $isApplicable = $user->provider === 'apple';
                    break;
            }

            if ($isApplicable) {
                $applicablePromotions[] = $promotion;
            }
        }

        return $applicablePromotions;
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

    public function allcustomers(Request $request)
    {
        $title = 'Order Management';
        $all_d = User::where('usertype', 'driver')->latest()->get();

        // 🚨 FIX CRÍTICO: Admin NO ve órdenes temporales (solo confirmadas)
        $leadsQuery = Order::query()
            ->where('status', '!=', 'Processing Payment') // Filtrar órdenes temporales canceladas
            ->latest();

        // Filter by date range if provided
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $leadsQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }

        // 🔧 NUEVO: Filtrar por usuario específico si se proporciona user_id
        if ($request->filled('user_id')) {
            $leadsQuery->where('userid', $request->input('user_id'));
            // Actualizar título para indicar que es un filtro de usuario
            $user = User::find($request->input('user_id'));
            if ($user) {
                $title = 'Pedidos de ' . $user->first_name . ' ' . $user->last_name;
            }
        }

        // Filter if user is driver
        if (auth()->user()->usertype == 'driver') {
            $leadsQuery->where('dman', auth()->id());
        }

        $users = $leadsQuery->paginate(10);

        return view('admin.users.customers', compact('users', 'title', 'all_d'))->with('i', 1);
    }
    /**
     * 📊 EXPORT ORDERS TO EXCEL/CSV
     */
    public function exportOrders(Request $request)
    {
        // Build the same query as allcustomers  
        // 🚨 FIX CRÍTICO: Export NO incluye órdenes temporales
        $query = Order::query()
            ->where('status', '!=', 'Processing Payment') // Filtrar órdenes temporales canceladas
            ->latest();
        
        // Apply same filters as the view
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }
        
        // Filter by status if provided
        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'guest') {
                $query->whereNull('userid');
            } elseif ($request->status === 'registered') {
                $query->whereNotNull('userid');
            } else {
                $query->where('status', $request->status);
            }
        }
        
        // Filter by user type if driver
        if (auth()->user()->usertype == 'driver') {
            $query->where('dman', auth()->id());
        }
        
        $orders = $query->get();
        
        // Prepare data for export
        $exportData = [];
        $exportData[] = [
            'Número de Pedido',
            'Fecha',
            'Hora',
            'Cliente',
            'Email',
            'Teléfono',
            'Dirección Entrega',
            'Fecha Entrega',
            'Horario Entrega',
            'Productos'
        ];
        
        foreach ($orders as $order) {
            // Get order details
            $orderDetails = \DB::table('ordedetails')
                ->where('orderno', $order->order_number ?? $order->id)
                ->get();
            
            $productos = $orderDetails->map(function($item) {
                return $item->item_name . ' (x' . $item->item_qty . ') $' . number_format($item->item_price, 2);
            })->join('; ');
            
            // Get customer info
            $user = $order->userid ? User::find($order->userid) : null;
            $customerName = $user ? ($user->first_name . ' ' . $user->last_name) : 'Cliente Guest';
            $customerPhone = $user ? $user->phone : 'N/A';
            
            $exportData[] = [
                $order->order_number ?? "#{$order->id}",
                $order->created_at->format('d/m/Y'),
                $order->created_at->format('H:i:s'),
                $customerName,
                $order->user_email ?? 'N/A',
                $customerPhone,
                $order->delivery_address ?? 'N/A',
                $order->delivery_date ?? 'N/A',
                $order->delivery_slot ?? 'N/A',
                $productos
            ];
        }
        
        // Determine export format
        $format = $request->input('format', 'excel');
        $filename = 'pedidos_' . date('Y-m-d_H-i-s');
        
        if ($format === 'csv') {
            return $this->exportToCsv($exportData, $filename);
        } else {
            return $this->exportToExcel($exportData, $filename);
        }
    }
    
    /**
     * Export data to CSV
     */
    private function exportToCsv($data, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}.csv\"",
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel to properly display UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            foreach ($data as $row) {
                fputcsv($file, $row, ',', '"');
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Export data to Excel (HTML table format)
     */
    private function exportToExcel($data, $filename)
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => "attachment; filename=\"{$filename}.xls\"",
        ];
        
        $callback = function() use ($data) {
            echo '<html>';
            echo '<head><meta charset="UTF-8"></head>';
            echo '<body>';
            echo '<table border="1">';
            
            foreach ($data as $row) {
                echo '<tr>';
                foreach ($row as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }
                echo '</tr>';
            }
            
            echo '</table>';
            echo '</body>';
            echo '</html>';
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function allcustomerfeedback(Request $request)
    {
        $title = 'Customer Feedback';
        $leadsQuery = Customerfeedback::query()->latest();

        // Filter by date range if provided
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $leadsQuery->whereBetween('created_at', [$fromDate, $toDate]);
        }

        $users = $leadsQuery->paginate(10);

        return view('admin.users.customersfeed', compact('users', 'title'))->with('i', 1);
    }
    public function updateStatus(Request $request)
    {
        $order = Order::find($request->id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        // Enviar notificación al admin
        $admin = User::where('usertype', 'admin')->first();
        $admin->notify(new NewOrder($order));

        // 🔔 RESTAURADO: Enviar push notification al cliente cuando admin cambia estado
        try {
            $firebaseService = new FirebaseNotificationService();

            // 🔧 FIX CRÍTICO: Definir statusMessages ANTES de los bloques para que funcione tanto para usuarios como Guest
            $statusMessages = [
                'Open' => ['status' => 'confirmed', 'message' => '¡Pedido confirmado!'],
                'On the Way' => ['status' => 'on_the_way', 'message' => '¡Tu pedido está en camino! 🚚'],
                'Delivered' => ['status' => 'delivered', 'message' => '¡Pedido entregado exitosamente! - ¡Esperamos que lo disfrutes! 🎉'],
                'Cancelled' => ['status' => 'cancelled', 'message' => 'Tu pedido ha sido cancelado. ❌']
            ];

            // Obtener el usuario del pedido
            $customer = User::find($order->userid);
            if ($customer && !empty($customer->fcm_token)) {
                
                if (isset($statusMessages[$request->status])) {
                    $statusConfig = $statusMessages[$request->status];
                    
                    $firebaseService->sendOrderNotification(
                        $customer->fcm_token,
                        $order->order_number ?: $order->id, // Número formateado para mostrar
                        $statusConfig['status'],
                        $statusConfig['message'],
                        $order->id // ID interno para navegación
                    );
                    
                    \Log::info('✅ Push notification sent for admin status update', [
                        'order_id' => $order->id,
                        'status' => $request->status,
                        'customer_id' => $customer->id
                    ]);
                }
            }
            // 🆕 También enviar a Guest si es orden Guest
            elseif (!$customer && !empty($order->user_email)) {
                $guestAddress = \App\Models\GuestAddress::where('guest_email', $order->user_email)->first();
                if ($guestAddress && !empty($guestAddress->fcm_token)) {
                    
                    if (isset($statusMessages[$request->status])) {
                        $statusConfig = $statusMessages[$request->status];
                        
                        $firebaseService->sendOrderNotification(
                            $guestAddress->fcm_token,
                            $order->order_number ?: $order->id, // Número formateado para mostrar
                            $statusConfig['status'],
                            $statusConfig['message'],
                            $order->id // ID interno para navegación
                        );
                        
                        \Log::info('✅ Push notification sent to Guest for admin status update', [
                            'order_id' => $order->id,
                            'status' => $request->status,
                            'guest_email' => $order->user_email
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error('❌ Failed to send push notification from admin', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
    public function updateStatusd(Request $request)
    {
        $order = Order::find($request->id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $order->dman = $request->status;
        // $order->status = 'On the Way';
        $order->save();
        $dmann = User::where('id', $request->status)->first();
        $drivername = $dmann->first_name . ' ' . $dmann->last_name;
        $admin = User::where('usertype', 'admin')->first();
        $admin->notify(new DriverChange($order, $drivername));

        // 🔔 NUEVAS NOTIFICACIONES FCM: Driver asignado
        $firebaseService = new FirebaseNotificationService();
        
        // 📦 1. Notificación para el DRIVER: "Nuevo pedido asignado"
        if ($dmann && !empty($dmann->fcm_token)) {
            $orderNumberFormatted = $order->order_number ?: $order->id;
            $firebaseService->sendToDevice(
                $dmann->fcm_token,
                "📦 Nuevo pedido asignado",
                "Se te ha asignado el pedido #{$orderNumberFormatted}. ¡Revisa los detalles!",
                [
                    'type' => 'new_order_assigned',
                    'order_id' => (string)$orderNumberFormatted,
                    'driver_name' => $drivername
                ]
            );
        }

        // 🚗 2. Notificación para el USUARIO: "Repartidor asignado"
        $customer = User::find($order->userid);
        if ($customer && !empty($customer->fcm_token)) {
            $orderNumberFormatted = $order->order_number ?: $order->id;
            $firebaseService->sendToDevice(
                $customer->fcm_token,
                "🚗 Repartidor asignado",
                "{$drivername} será quien entregue tu pedido #{$orderNumberFormatted}.",
                [
                    'type' => 'driver_assigned',
                    'order_id' => (string)$orderNumberFormatted,
                    'driver_name' => $drivername
                ]
            );
        }
        // 🚗 3. Notificación para GUEST: "Repartidor asignado"
        elseif (!$customer && !empty($order->user_email)) {
            $guestAddress = \App\Models\GuestAddress::where('guest_email', $order->user_email)->first();
            if ($guestAddress && !empty($guestAddress->fcm_token)) {
                $orderNumberFormatted = $order->order_number ?: $order->id;
                $firebaseService->sendToDevice(
                    $guestAddress->fcm_token,
                    "🚗 Repartidor asignado",
                    "{$drivername} será quien entregue tu pedido #{$orderNumberFormatted}.",
                    [
                        'type' => 'driver_assigned',
                        'order_id' => (string)$orderNumberFormatted,
                        'driver_name' => $drivername
                    ]
                );
            }
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
    public function allcontractirs()
    {
        $title = 'Contractors Management';
        $users = User::where('usertype', 'contractor')->latest()->get();
        return view('admin.users.contractors', compact('users', 'title'))->with('i', 1);
    }
    public function markAsUNRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->update(['read_at' => null]);
            return redirect()->back()->with('success', 'Notification marked as read.');
        }
        return redirect()->back()->with('error', 'Notification not found.');
    }
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
            return redirect()->back()->with('success', 'Notification marked as read.');
        }
        return redirect()->back()->with('error', 'Notification not found.');
    }

    public function showprofile()
    {
        $title = 'My Profile';
        $user = auth()->user();
        return view('admin.profile', compact('user', 'title'));
    }
    public function editprofile()
    {
        $title = 'Update Profile';
        $user = auth()->user();
        // print_r($user);
        return view('admin.editprofile', compact('user', 'title'));
    }
    public function updateprofile(Request $request)
    {


        // $input = $request->except(['_token','profile_photo']);
        //	$profilephot = '';
        if ($image = $request->file('profile_photo')) {
            request()->validate([
                'profile_photo' => 'image|mimes:jpg,png,jpeg|max:50000',
            ]);
            $destinationPath = public_path('profile/');
            $profileImage = 'cover' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profilephot = "$profileImage";
            User::where('id', $request->id)->update(['image' => $profilephot]);
        }

        User::where('id', $request->id)->update(['phone' => $request->contact_number, 'address' => $request->address, 'intro' => $request->intro]);
        return redirect()->route('users.editprofile')->with('success', 'Profile Updated Successfully');
    }
    public function deleteuser($id)
    {
        //	dd($id);
        $myusers = User::findOrFail($id);
        $myusers->delete();
        return redirect()->back()->with('destroy', 'User deleted successfully');
    }
    //deleteproposal


    public function userEdit($id)
    {
        $user = User::find($id);
        $promo = Proposalbattery::latest()->get();
        return view('admin.users.edit', compact('user', 'promo'));
    }

    public function ordershowd($id)
    {
        $order = Order::where('id', $id)->first();
        
        if (!$order) {
            abort(404, 'Orden no encontrada');
        }
        
        // 🚚 ARREGLAR: Buscar detalles usando order_number para consistencia
        $detail = Ordedetail::where('orderno', $order->order_number ?? $id)->get();
        
        // Si no encuentra con order_number, usar id como fallback para órdenes antiguas
        if ($detail->isEmpty()) {
            $detail = Ordedetail::where('orderno', $id)->get();
        }
        
        return view('admin.users.odetails', compact('detail', 'id', 'order'))->with('i', 1);
    }


    public function usersts($id, $sts)
    {
        $newStatus = ($sts == 'active') ? 'inactive' : 'active';
        $myuser = User::where('id', $id)->update(['is_active' => $newStatus]);
        return redirect()->back()->with('success', 'Status Changed successfully');
    }

    public function updateuser(Request $data)
    {
        //dd('haji ruk');
        $id = $data->input('id');
        $user = User::findOrFail($id);
        if ($image = $data->file('profile_photo')) {
            request()->validate([
                'profile_photo' => 'image|mimes:jpg,png,jpeg|max:50000',
            ]);
            $destinationPath = public_path('profile/');
            $profileImage = 'cover' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $profilephot = "$profileImage";
            $user->update(['image' => $profilephot]);
            //exit;
        }
        // $promo = Proposalbattery::latest()->get();
        $userdiscount = 0;
        if ($data->promotion_id != 0) {
            $myid = $data->promotion_id;
            $promo = Proposalbattery::where('id', $myid)->first();
            $userdiscount = $promo->discount;
        }
        $user->update([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'usertype' => $data->usertype,
            'intro' => $data->intro,
            'address' => $data->address,
            'phone' => $data->contact_number,
            'promotion_id' => $data->promotion_id,
            'promotional_discount' => $userdiscount
        ]);


        return redirect()->to('/allsalereps')->with('success', 'User added Successfully');
    }

    public function saveimage(Request $request)
    {
        $timestamp = time();
        if ($request->has('imgData')) {
            $imgData = $request->imgData;
            $imgData = str_replace('data:image/png;base64,', '', $imgData);
            $imgData = str_replace(' ', '+', $imgData);
            $data = base64_decode($imgData);
            $fileName = 'mapimages/' . $timestamp . '.png';
            file_put_contents(public_path($fileName), $data);
            return $timestamp . ".png";
        } else {
            return "Error: No image data received!";
        }
    }
    public function addnewuser($type)
    {
        $title = 'Add New User';
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.users.addnew', compact('title', 'type', 'roles'));
    }



    public function speakerprofile($id)
    {
        $user = User::FindorFail($id);
        return view('speakers.profile', compact('user'));
    }

    public function changepassword($id)
    {
        $user = User::FindorFail($id);
        return view('admin.changepassword', compact('user'))->render();
    }

    public function updatepassword(Request $request)
    {

        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $member = User::FindorFail($request->id);
        // Update the user's password

        $member->password = bcrypt($request->new_password);
        $member->save();

        return response()->json(['message' => 'Password changed successfully.']);
    }





    public function update_task(Request $request)
    {
        Tasks::where('id', $request->id)->update(['task_type' => $request->status]);
    }
}
