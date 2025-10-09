<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WebSiteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ControllsController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AppController;
/*
|--------------------------------------------------------------------------
| API Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/











Route::post('register', [RegisteredUserController::class, 'apiRegister']);
Route::post('api/login', [AuthenticatedSessionController::class, 'apiLogin']);
Route::get('products/{category?}', [ControllsController::class, 'getInverters']);
Route::get('productscats', [ControllsController::class, 'getInverterscats']);
Route::post('ordersubmit', [RegisteredUserController::class, 'orderSubs']);
Route::post('migrateorders', [RegisteredUserController::class, 'migorders']);
Route::get('/orderhistory/{userid}', [RegisteredUserController::class, 'orderHistory']);
Route::post('/create-payment-intent', [ControllsController::class, 'createPaymentIntent']);

Route::post('/stripe/webhook', [ControllsController::class, 'handle']);
Route::get('/test-webhook-logs', [ControllsController::class, 'testWebhookLogs']);

Route::get('/orderhistorydriver/{userid}', [RegisteredUserController::class, 'orderHistoryDriver']);
Route::get('/orderdetails/{orderid}', [RegisteredUserController::class, 'orderDetails']);
//change status of order to delivered from mobile driver
Route::post('orderdel', [RegisteredUserController::class, 'orderdel']);
Route::post('driverlocsubmit', [RegisteredUserController::class, 'driverlocsubmit']);
Route::get('/driverlocationsagainstorder/{orderid}', [RegisteredUserController::class, 'driverlocationsagainstorder']);
Route::post('msgsubmit', [RegisteredUserController::class, 'msgsubmit']);
Route::get('/msgfetch/{orderid}', [RegisteredUserController::class, 'msgfetch']);
Route::get('/fetch_ddates/{ddate}', [ControllsController::class, 'fetchddate']);
Route::get('/delivery-days', [ControllsController::class, 'getDeliveryDays']);
Route::get('/delivery-config', [ControllsController::class, 'getDeliveryConfig']);
Route::get('/userdetails/{userid}', [RegisteredUserController::class, 'userdetails']);
Route::post('forgetpasswordlink', [PasswordResetLinkController::class, 'forgetpasswordlink']);
Route::post('updateuserprofile', [RegisteredUserController::class, 'updateuserprofile']);
Route::post('update-fcm-token', [RegisteredUserController::class, 'updateFcmToken']);
Route::post('updateusepassword', [PasswordController::class, 'updateusepassword']);
Route::post('deleteuser', [RegisteredUserController::class, 'deleteUser']);
Route::post('compsubmit', [RegisteredUserController::class, 'compsubmit']);
Route::post('/auth/google', [WebSiteController::class, 'googleLogin']);
Route::post('/auth/apple', [WebSiteController::class, 'appleLogin']);

// 🧪 Testing endpoint for Apple communication
Route::post('/test/apple-communication', [WebSiteController::class, 'testAppleCommunication']);
Route::post('/webhooks/apple', [WebSiteController::class, 'appleWebhook']);
//manage address
Route::post('addaddress', [RegisteredUserController::class, 'addaddress']);
Route::get('/fetch_address/{id}', [RegisteredUserController::class, 'fetch_address']);
Route::get('/fetch_address_single_edit/{id}', [RegisteredUserController::class, 'fetch_address_single_edit']);
Route::post('updateaddress', [RegisteredUserController::class, 'updateaddress']);
Route::post('deleteaddress', [RegisteredUserController::class, 'deleteaddress']);
//coupon validation
Route::post('validate-coupon', [ControllsController::class, 'validateCoupon']);
//automatic promotions
Route::post('get-automatic-promotions', [ControllsController::class, 'getAutomaticPromotions']);

// ===============================================
// 📦 SISTEMA DE ENVÍO GRATIS POR MONTO MÍNIMO
// ===============================================
Route::get('/shipping-config', [ControllsController::class, 'getShippingConfig']);
Route::post('/calculate-shipping', [ControllsController::class, 'calculateShipping']);
Route::get('/shipping-motivation/{subtotal}', [ControllsController::class, 'getShippingMotivation']);

// ===============================================
// 🛒 SISTEMA DE LIMPIEZA AUTOMÁTICA DE CARRITO
// ===============================================
Route::post('/cart-cleanup', [ControllsController::class, 'cartCleanup']);
Route::post('/cart-activity', [ControllsController::class, 'cartActivity']);

// ===============================================
// 🔔 SISTEMA DE NOTIFICACIONES FCM MEJORADO
// ===============================================
Route::post('/remove-fcm-token', [ControllsController::class, 'removeFcmToken']);

// ===============================================
// 🛒 SISTEMA DE CARRITO PERSISTENTE POR USUARIO
// ===============================================
use App\Http\Controllers\CartController;
Route::post('/cart/get', [CartController::class, 'getCart']);
Route::post('/cart/save', [CartController::class, 'saveCart']);
Route::post('/cart/clear', [CartController::class, 'clearCart']);
Route::post('/cart/migrate', [CartController::class, 'migrateCart']);


// ===============================================
// 🗑️ SISTEMA DE LIMPIEZA DE ÓRDENES TEMPORALES
// ===============================================
Route::post('/cleanup-temp-orders', [ControllsController::class, 'cleanupTempOrders']);

// ===============================================
// 🏠 NUEVAS RUTAS PARA SISTEMA DE DIRECCIONES
// ===============================================

// USUARIOS REGISTRADOS - Direcciones (máximo 3)
Route::get('/user/{userId}/addresses', [RegisteredUserController::class, 'getUserAddresses']);
Route::post('/user/addresses', [RegisteredUserController::class, 'addUserAddress']);
Route::put('/user/addresses/{addressId}', [RegisteredUserController::class, 'updateUserAddress']);
Route::delete('/user/addresses/{addressId}', [RegisteredUserController::class, 'deleteUserAddress']);
Route::post('/user/addresses/{addressId}/primary', [RegisteredUserController::class, 'setPrimaryAddress']);

// GUESTS - Dirección única persistente
Route::post('/guest/address', [RegisteredUserController::class, 'saveGuestAddress']);
Route::get('/guest/address/{email}', [RegisteredUserController::class, 'getGuestAddress']);

// GUESTS - Órdenes
Route::get('/guest/orders/{email}', [RegisteredUserController::class, 'getGuestOrders']);

// OTP SETTINGS - Control simple activar/desactivar
Route::get('/settings/otp-status', function() {
    $setting = DB::table('settings')->where('key', 'otp_verification_enabled')->first();
    return response()->json([
        'enabled' => $setting ? $setting->value === 'true' : false
    ]);
});

Route::post('/settings/toggle-otp', function() {
    $setting = DB::table('settings')->where('key', 'otp_verification_enabled')->first();
    $newValue = $setting && $setting->value === 'true' ? 'false' : 'true';
    
    DB::table('settings')
        ->updateOrInsert(
            ['key' => 'otp_verification_enabled'],
            [
                'value' => $newValue, 
                'description' => 'Activar/Desactivar verificación OTP por email',
                'updated_at' => now()
            ]
        );
        
    return response()->json([
        'enabled' => $newValue === 'true',
        'message' => 'OTP ' . ($newValue === 'true' ? 'activado' : 'desactivado')
    ]);
});

// OTP EMAIL VERIFICATION - Endpoints principales
Route::post('/otp/send', [OTPController::class, 'sendOTP']);
Route::post('/otp/verify', [OTPController::class, 'verifyOTP']);

// EMAIL TESTING - Endpoint para pruebas de emails
Route::post('/emails/test', [EmailController::class, 'testEmail']);

// ✅ SISTEMA DE ACTUALIZACIONES AUTOMÁTICAS DE LA APP
Route::get('/app-version', [AppController::class, 'checkVersion']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
