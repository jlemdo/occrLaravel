<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ordedetail;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class TestInvoiceController extends Controller
{
    public function createTestOrder()
    {
        try {
            // Buscar o crear un usuario de prueba
            $user = User::where('email', 'test@lacteosymas.mx')->first();
            
            if (!$user) {
                $user = User::create([
                    'first_name' => 'Juan Carlos',
                    'last_name' => 'López González',
                    'email' => 'test@lacteosymas.mx',
                    'password' => bcrypt('password'),
                    'usertype' => 'customer',
                    'is_active' => 'active',
                    'phone' => '+52 55 1234 5678',
                    'address' => 'Av. Insurgentes Sur 123, Col. Del Valle, CDMX'
                ]);
            }

            // Crear una orden de prueba con formato correcto
            $now = new \DateTime();
            $orderNumber = $this->generateOrderNumber($now);
            
            // Asegurar unicidad
            $counter = 0;
            $originalOrderNumber = $orderNumber;
            while (Order::where('order_number', $orderNumber)->exists()) {
                $counter++;
                $orderNumber = $originalOrderNumber . str_pad($counter, 2, '0', STR_PAD_LEFT);
            }
            
            $order = Order::create([
                'userid' => $user->id,
                'order_number' => $orderNumber,
                'orderno' => $orderNumber,
                'status' => 'completed',
                'user_email' => $user->email,
                'delivery_address' => $user->address,
                'delivery_date' => now()->addDay(),
                'payment_status' => 'paid',
                'amount_paid' => 285.50
            ]);

            // Crear detalles de productos lácteos
            $products = [
                ['name' => 'Leche Entera 1L', 'price' => 25.50, 'qty' => 3],
                ['name' => 'Queso Oaxaca 500g', 'price' => 75.00, 'qty' => 2],
                ['name' => 'Yogurt Natural 1L', 'price' => 35.00, 'qty' => 2],
                ['name' => 'Crema Dulce 200ml', 'price' => 18.00, 'qty' => 1],
                ['name' => 'Mantequilla 250g', 'price' => 45.00, 'qty' => 1],
            ];

            $total = 0;
            foreach ($products as $product) {
                Ordedetail::create([
                    'userid' => $user->id,
                    'orderno' => $order->id,
                    'item_name' => $product['name'],
                    'item_price' => $product['price'],
                    'item_qty' => $product['qty'],
                    'item_image' => 'default.jpg'
                ]);
                $total += $product['price'] * $product['qty'];
            }

            // Generar el PDF
            return $this->generateTestInvoice($order->id, $user->id, $total);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error creando orden de prueba: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createTestOrderHTML()
    {
        try {
            // Buscar o crear un usuario de prueba
            $user = User::where('email', 'test@lacteosymas.mx')->first();
            
            if (!$user) {
                $user = User::create([
                    'first_name' => 'Juan Carlos',
                    'last_name' => 'López González',
                    'email' => 'test@lacteosymas.mx',
                    'password' => bcrypt('password'),
                    'usertype' => 'customer',
                    'is_active' => 'active',
                    'phone' => '+52 55 1234 5678',
                    'address' => 'Av. Insurgentes Sur 123, Col. Del Valle, CDMX'
                ]);
            }

            // Crear una orden de prueba con formato correcto
            $now = new \DateTime();
            $orderNumber = $this->generateOrderNumber($now);
            
            // Asegurar unicidad
            $counter = 0;
            $originalOrderNumber = $orderNumber;
            while (Order::where('order_number', $orderNumber)->exists()) {
                $counter++;
                $orderNumber = $originalOrderNumber . str_pad($counter, 2, '0', STR_PAD_LEFT);
            }
            
            $order = Order::create([
                'userid' => $user->id,
                'order_number' => $orderNumber,
                'orderno' => $orderNumber,
                'status' => 'completed',
                'user_email' => $user->email,
                'delivery_address' => $user->address,
                'delivery_date' => now()->addDay(),
                'payment_status' => 'paid',
                'amount_paid' => 285.50
            ]);

            // Crear detalles de productos lácteos
            $products = [
                ['name' => 'Leche Entera 1L', 'price' => 25.50, 'qty' => 3],
                ['name' => 'Queso Oaxaca 500g', 'price' => 75.00, 'qty' => 2],
                ['name' => 'Yogurt Natural 1L', 'price' => 35.00, 'qty' => 2],
                ['name' => 'Crema Dulce 200ml', 'price' => 18.00, 'qty' => 1],
                ['name' => 'Mantequilla 250g', 'price' => 45.00, 'qty' => 1],
            ];

            $total = 0;
            foreach ($products as $product) {
                Ordedetail::create([
                    'userid' => $user->id,
                    'orderno' => $order->id,
                    'item_name' => $product['name'],
                    'item_price' => $product['price'],
                    'item_qty' => $product['qty'],
                    'item_image' => 'default.jpg'
                ]);
                $total += $product['price'] * $product['qty'];
            }

            // Mostrar directamente en HTML
            return $this->showTestInvoice($order->id, $user->id, $total);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error creando orden de prueba HTML: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generateTestInvoice($orderId, $userId, $total)
    {
        try {
            $order = Order::with('orderDetails')->find($orderId);
            $user = User::find($userId);

            if (!$order || !$user) {
                return response()->json(['error' => 'Orden o usuario no encontrado'], 404);
            }

            // Generar el PDF con configuración optimizada para ticket
            $pdf = PDF::loadView('pdf.invoice', [
                'order' => $order,
                'user' => $user,
                'total' => $total
            ])
            ->setOption('isRemoteEnabled', true)
            ->setOption('defaultFont', 'Arial')
            ->setOption('dpi', 96)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isPhpEnabled', true)
            ->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm width

            // Retornar el PDF para descarga
            return $pdf->download('factura_prueba_lacteos_y_mas.pdf');

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error generando PDF: ' . $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function showTestInvoice($orderId, $userId, $total)
    {
        try {
            $order = Order::with('orderDetails')->find($orderId);
            $user = User::find($userId);

            if (!$order || !$user) {
                return response()->json(['error' => 'Orden o usuario no encontrado'], 404);
            }

            // Mostrar la vista directamente en el navegador
            return view('pdf.invoice', [
                'order' => $order,
                'user' => $user,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error mostrando factura: ' . $e->getMessage()
            ], 500);
        }
    }

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
}