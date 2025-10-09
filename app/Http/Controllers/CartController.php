<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GuestAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Obtener carrito del usuario
     */
    public function getCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable|integer',
                'user_type' => 'required|string|in:user,guest',
                'guest_email' => 'required_if:user_type,guest|email'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            if ($request->user_type === 'guest') {
                // Obtener carrito de guest
                $guest = GuestAddress::where('guest_email', $request->guest_email)->first();
                
                if (!$guest) {
                    return response()->json([
                        'success' => true,
                        'cart' => [],
                        'message' => 'Guest not found - empty cart'
                    ], 200);
                }

                // Verificar si el carrito no ha expirado (24 horas)
                if ($guest->cart_updated_at && $guest->cart_updated_at->diffInHours(now()) > 24) {
                    $guest->update([
                        'cart_data' => null,
                        'cart_updated_at' => null
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'cart' => [],
                        'message' => 'Cart expired after 24 hours'
                    ], 200);
                }

                return response()->json([
                    'success' => true,
                    'cart' => $guest->cart_data ?? [],
                    'updated_at' => $guest->cart_updated_at,
                    'user_type' => 'guest'
                ], 200);

            } else {
                // Obtener carrito de usuario registrado
                $user = User::find($request->user_id);
                
                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => 'User not found'
                    ], 404);
                }

                // Verificar si el carrito no ha expirado (24 horas)
                if ($user->cart_updated_at && $user->cart_updated_at->diffInHours(now()) > 24) {
                    $user->update([
                        'cart_data' => null,
                        'cart_updated_at' => null
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'cart' => [],
                        'message' => 'Cart expired after 24 hours'
                    ], 200);
                }

                return response()->json([
                    'success' => true,
                    'cart' => $user->cart_data ?? [],
                    'updated_at' => $user->cart_updated_at,
                    'user_type' => 'user'
                ], 200);
            }

        } catch (\Exception $e) {
            Log::error('Failed to get cart', [
                'error' => $e->getMessage(),
                'user_id' => $request->user_id,
                'user_type' => $request->user_type
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Guardar carrito del usuario
     */
    public function saveCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable|integer',
                'user_type' => 'required|string|in:user,guest',
                'guest_email' => 'required_if:user_type,guest|email',
                'cart_data' => 'required|array'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $cartData = $request->cart_data;
            $now = now();

            if ($request->user_type === 'guest') {
                // Guardar carrito de guest
                $guest = GuestAddress::firstOrCreate(
                    ['guest_email' => $request->guest_email],
                    ['guest_email' => $request->guest_email]
                );

                $guest->update([
                    'cart_data' => $cartData,
                    'cart_updated_at' => $now
                ]);

                Log::info('Guest cart saved successfully', [
                    'guest_email' => $request->guest_email,
                    'cart_items' => count($cartData),
                    'guest_id' => $guest->id
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Guest cart saved successfully',
                    'cart_items' => count($cartData),
                    'updated_at' => $now
                ], 200);

            } else {
                // Guardar carrito de usuario registrado
                $user = User::find($request->user_id);
                
                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => 'User not found'
                    ], 404);
                }

                $user->update([
                    'cart_data' => $cartData,
                    'cart_updated_at' => $now
                ]);

                Log::info('User cart saved successfully', [
                    'user_id' => $user->id,
                    'cart_items' => count($cartData),
                    'user_type' => $user->usertype
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'User cart saved successfully',
                    'cart_items' => count($cartData),
                    'updated_at' => $now
                ], 200);
            }

        } catch (\Exception $e) {
            Log::error('Failed to save cart', [
                'error' => $e->getMessage(),
                'user_id' => $request->user_id,
                'user_type' => $request->user_type,
                'cart_items' => count($request->cart_data ?? [])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Limpiar carrito del usuario
     */
    public function clearCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'nullable|integer',
                'user_type' => 'required|string|in:user,guest',
                'guest_email' => 'required_if:user_type,guest|email'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            if ($request->user_type === 'guest') {
                // Limpiar carrito de guest
                $guest = GuestAddress::where('guest_email', $request->guest_email)->first();
                
                if ($guest) {
                    $guest->update([
                        'cart_data' => null,
                        'cart_updated_at' => null
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Guest cart cleared successfully'
                ], 200);

            } else {
                // Limpiar carrito de usuario registrado
                $user = User::find($request->user_id);
                
                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => 'User not found'
                    ], 404);
                }

                $user->update([
                    'cart_data' => null,
                    'cart_updated_at' => null
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'User cart cleared successfully'
                ], 200);
            }

        } catch (\Exception $e) {
            Log::error('Failed to clear cart', [
                'error' => $e->getMessage(),
                'user_id' => $request->user_id,
                'user_type' => $request->user_type
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Migrar carrito de guest a usuario registrado
     */
    public function migrateCart(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'from_guest_email' => 'required|email',
                'to_user_id' => 'required|integer|exists:users,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Obtener carrito de guest
            $guest = GuestAddress::where('guest_email', $request->from_guest_email)->first();
            
            if (!$guest || empty($guest->cart_data)) {
                return response()->json([
                    'success' => true,
                    'message' => 'No guest cart to migrate',
                    'migrated_items' => 0
                ], 200);
            }

            // Obtener usuario destino
            $user = User::find($request->to_user_id);

            // Migrar carrito: combinar con carrito existente del usuario
            $guestCart = $guest->cart_data;
            $userCart = $user->cart_data ?? [];

            // Combinar carritos (guest tiene prioridad en caso de productos duplicados)
            $mergedCart = $userCart;
            foreach ($guestCart as $item) {
                $existingIndex = array_search($item['id'], array_column($mergedCart, 'id'));
                if ($existingIndex !== false) {
                    // Producto ya existe - sumar cantidades
                    $mergedCart[$existingIndex]['quantity'] = ($mergedCart[$existingIndex]['quantity'] ?? 1) + ($item['quantity'] ?? 1);
                } else {
                    // Producto nuevo - agregar
                    $mergedCart[] = $item;
                }
            }

            // Guardar carrito combinado en usuario
            $user->update([
                'cart_data' => $mergedCart,
                'cart_updated_at' => now()
            ]);

            // Limpiar carrito de guest
            $guest->update([
                'cart_data' => null,
                'cart_updated_at' => null
            ]);

            Log::info('Cart migrated successfully', [
                'from_guest_email' => $request->from_guest_email,
                'to_user_id' => $user->id,
                'guest_items' => count($guestCart),
                'user_items' => count($userCart),
                'merged_items' => count($mergedCart)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cart migrated successfully',
                'migrated_items' => count($guestCart),
                'total_items' => count($mergedCart)
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to migrate cart', [
                'error' => $e->getMessage(),
                'from_guest_email' => $request->from_guest_email ?? null,
                'to_user_id' => $request->to_user_id ?? null
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}