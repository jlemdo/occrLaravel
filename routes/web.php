<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebSiteController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ControllsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TestInvoiceController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Console\Commands\SendTaskReminders;
use Illuminate\Support\Facades\Artisan;

Route::get('/test-task-reminders', function () {
    Artisan::call('send:task-reminders');
    return 'Task reminder command executed!';
});

    Route::get('/',[WebSiteController::class,'index']);
	Route::get('signAuth',[WebSiteController::class,'signAuth'])->name('signAuth');
	Route::get('auth/google', [WebSiteController::class, 'redirectToGoogle'])->name('login.google');
	Route::get('auth/google/callback', [WebSiteController::class, 'handleGoogleCallback']);
	//a testing route
	Route::get('shoaib',[WebSiteController::class,'shoaib']);

	// ✅ LANDING PAGE DE LA APP - Ruta /app
	Route::get('app', [AppController::class, 'landingPage'])->name('app.landing');
	
	// Rutas de prueba para la factura
	Route::get('test-invoice', [TestInvoiceController::class, 'createTestOrder']);
	Route::get('test-invoice-html', [TestInvoiceController::class, 'createTestOrderHTML']);
	Route::get('test-invoice/{orderId}/{userId}/{total}', [TestInvoiceController::class, 'showTestInvoice']);
    Route::middleware('auth')->group(function () {
    Route::get('dashboard',[HomeController::class,'dashboard'])->name('dashboard');
	Route::get('notifications',[HomeController::class,'notifications'])->name('notifications');
    Route::get('profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //ye nechy wala
    Route::get('changepassword/{id}',[AdminController::class,'changepassword'])->name('admin.changepassword');
    Route::post('updatepassword',[AdminController::class,'updatepassword'])->name('admin.updatepassword');
    Route::get('allusers',[AdminController::class,'allusers'])->name('admin.users');
	Route::get('allsalereps',[AdminController::class,'allsalereps'])->name('admin.allsalereps');
	Route::get('allcustomers',[AdminController::class,'allcustomers'])->name('admin.allcustomers');
	Route::post('export-orders',[AdminController::class,'exportOrders'])->name('admin.exportOrders');
	Route::get('allcustomerfeedback',[AdminController::class,'allcustomerfeedback'])->name('admin.allcustomerfeedback');
	Route::post('/order/update-status', [AdminController::class, 'updateStatus'])->name('order.updateStatus');
	Route::post('/order/update-statusd', [AdminController::class, 'updateStatusd'])->name('order.updateStatusd');
	Route::get('ordershowd/{id}', [AdminController::class, 'ordershowd']);
	Route::get('allcontractors',[AdminController::class,'allcontractirs'])->name('admin.allcontractors');
	Route::get('addnewuser/{type}', [AdminController::class, 'addnewuser'])->name('addnewuser');
	Route::post('registeradmin', [RegisteredUserController::class, 'registeradmin'])->name('registeradmin');
	Route::get('/notifications/mark-as-read/{id}', [AdminController::class, 'markAsRead'])->name('notifications.markAsRead');
	Route::get('/notifications/mark-as-unread/{id}', [AdminController::class, 'markAsUNRead'])->name('notifications.markAsUNRead');
	//deleteuser
	Route::post('/deleteuser/{id}', [AdminController::class,'deleteuser'])->name('deleteuser');
	Route::get('userEdit/{id}', [AdminController::class, 'userEdit']);
	Route::get('usersts/{id}/{sts}', [AdminController::class, 'usersts']);
	Route::post('updateuser', [AdminController::class, 'updateuser']);
    // Controller
	Route::post('saveimage', [AdminController::class, 'saveimage'])->name('saveimage');
    Route::get('speakers/editprofile',[AdminController::class,'editprofile'])->name('users.editprofile');
    Route::post('speakers/updateprofile',[AdminController::class,'updateprofile'])->name('users.updateprofile');
	// 📦 SISTEMA DE ENVÍO GRATIS (Nuevo)
	Route::get('delivery',[ControllsController::class,'financing'])->name('admin.delivery');
	Route::post('shipping/update', [ControllsController::class, 'updateShippingConfig'])->name('shipping.update');
	
	// 🗑️ RUTAS ANTIGUAS - Mantener por compatibilidad pero redirigen al nuevo sistema
	Route::get('newfinancing',[ControllsController::class, 'newfinancing'])->name('newfinancing');
	Route::post('addfinancing', [ControllsController::class, 'addfinancing'])->name('addfinancing');
	Route::post('/deletefinancing/{id}', [ControllsController::class,'deletefinancing'])->name('deletefinancing');
	Route::get('deliveryEdit/{id}', [ControllsController::class, 'financingEdit']);
	Route::post('updatefinancing', [ControllsController::class, 'updatefinancing']);
	//all modules.
	Route::get('modules',[ControllsController::class,'modules'])->name('admin.modules');
	Route::get('newmodules',[ControllsController::class, 'newmodules'])->name('newmodules');
	Route::post('addmodules', [ControllsController::class, 'addmodules'])->name('addmodules');
	Route::post('/deletemodules/{id}', [ControllsController::class,'deletemodules'])->name('deletemodules');
	Route::get('modulesEdit/{id}', [ControllsController::class, 'modulesEdit']);
	Route::post('updatemodules', [ControllsController::class, 'updatemodules']);
	//all .
	Route::get('product',[ControllsController::class,'inverter'])->name('admin.product');
	Route::get('newinverter',[ControllsController::class, 'newinverter'])->name('newinverter');
	Route::post('addinverter', [ControllsController::class, 'addinverter'])->name('addinverter');
	Route::post('/deleteinverter/{id}', [ControllsController::class,'deleteinverter'])->name('deleteinverter');
	Route::get('inverterEdit/{id}', [ControllsController::class, 'inverterEdit']);
	Route::post('updateinverter', [ControllsController::class, 'updateinverter']);
	Route::get('stock',[ControllsController::class,'stock'])->name('admin.stock');
	Route::get('newstock',[ControllsController::class, 'newstock'])->name('newstock');
	Route::post('addstock', [ControllsController::class, 'addstock'])->name('addstock');
	Route::post('/deletestock/{id}', [ControllsController::class,'deletestock'])->name('deletestock');
	Route::get('stockEdit/{id}', [ControllsController::class, 'stockEdit']);
	Route::post('updatestock', [ControllsController::class, 'updatestock']);
	Route::get('inventory',[ControllsController::class,'inventory'])->name('admin.inventory');

	Route::get('act_log',[ControllsController::class,'act_log'])->name('admin.act_log');
	
	Route::get('promotion',[ControllsController::class,'proposalbatteryd'])->name('promotion');
	Route::get('newproposalbattery',[ControllsController::class, 'newproposalbattery'])->name('newproposalbattery');
	Route::post('addproposalbatteryaction', [ControllsController::class, 'addproposalbatteryaction'])->name('addproposalbatteryaction');
	Route::post('/deleteproposalbattery/{id}', [ControllsController::class,'deleteproposalbattery'])->name('deleteproposalbattery');
	Route::get('proposalbatteryEdit/{id}', [ControllsController::class, 'proposalbatteryEdit'])->name('promotionsp');
	Route::post('updateproposalbattery', [ControllsController::class, 'updateproposalbattery'])->name('updateproposalbattery');
	
	
	Route::get('dslots',[ControllsController::class,'dslots'])->name('dslots');
	Route::get('newdslots',[ControllsController::class, 'newdslots'])->name('newdslots');
	Route::post('adddslotsaction', [ControllsController::class, 'adddslotsaction'])->name('adddslotsaction');
	Route::post('/deletedslots/{id}', [ControllsController::class,'deletedslots'])->name('deletedslots');
	Route::get('dslotsEdit/{id}', [ControllsController::class, 'dslotsEdit'])->name('dslotsEdit');
	Route::post('updatedslots', [ControllsController::class, 'updatedslots'])->name('updatedslots');
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';