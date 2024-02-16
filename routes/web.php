<?php

use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\configuracion\combos\StatusController;
use App\Http\Controllers\Admin\configuracion\combos\StatusPedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\configuracion\direccion\CountryController;
use App\Http\Controllers\Admin\configuracion\direccion\StateController;
use App\Http\Controllers\Admin\configuracion\direccion\CityController;
use App\Http\Controllers\Admin\configuracion\direccion\MunicipalityController;
use App\Http\Controllers\Admin\configuracion\direccion\ZoneController;
use App\Http\Controllers\Admin\configuracion\pedidos\OrderController;
use App\Http\Controllers\Admin\configuracion\productos\CategoryController;
use App\Http\Controllers\Admin\configuracion\productos\MisProductosController;
use App\Http\Controllers\Admin\configuracion\productos\ProductController;
use App\Http\Controllers\Admin\configuracion\productos\SpecialityController;
use App\Http\Controllers\Admin\configuracion\users\DrugstoreController;
use App\Http\Controllers\Admin\configuracion\users\JluserController;
use App\Http\Controllers\Admin\configuracion\users\OtherController;
use App\Http\Controllers\Admin\configuracion\users\PharmacyController;
use App\Http\Controllers\Admin\configuracion\users\SellerController;
use App\Http\Controllers\Admin\DrugstorexPharmacyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermisoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/lang/{language}', function ($language) {
    Session::put('language', $language);
    return redirect()->back();
});

// RUTAS DE VERIFICACIÓN DE CORREO //
Auth::routes();
//FIN DE RUTAS VERIFICACIÓN//

Route::middleware(['auth', 'translate'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class)->except(['show'])->names('roles');
    Route::resource('countries', CountryController::class)->except(['show'])->names('countries');
    Route::resource('zones', ZoneController::class)->except(['show'])->names('zones');
    Route::resource('states', StateController::class)->except(['show'])->names('states');
    Route::resource('cities', CityController::class)->except(['show'])->names('cities');
    Route::resource('municipality', MunicipalityController::class)->except(['show'])->names('municipality');
    Route::resource('status', StatusController::class)->except(['show'])->names('status');
    Route::resource('statusp', StatusPedidoController::class)->except(['show'])->names('statusp');
    Route::resource('category', CategoryController::class)->except(['show'])->names('category');
    Route::resource('speciality', SpecialityController::class)->except(['show'])->names('speciality');

    Route::resource('pharmacy', PharmacyController::class)->except(['show'])->names('pharmacy');
    Route::resource('drugstore', DrugstoreController::class)->except(['show'])->names('drugstore');
    Route::resource('jluser', JluserController::class)->except(['show'])->names('jluser');
    Route::resource('other', OtherController::class)->except(['show'])->names('other');
    Route::resource('product', ProductController::class)->except(['show'])->names('product');
    Route::get('/get-product-data', [ProductController::class, 'getProductData'])->name('product.get-product-data');
    Route::resource('mis-productos', MisProductosController::class)->except(['show', 'update', 'create', 'destroy'])->names('mis_productos');
    Route::get('product-dg/get-product-data', [MisProductosController::class, 'getProductData'])->name('mis_productos.get-product-data');


    Route::resource('seller', SellerController::class)->except(['show'])->names('seller');


    Route::get('/activar/{id}/{idPro}/product', [ProductController::class, 'aceptar'])->name('product.activar');
    Route::get('/rotacion/{id}/{idPro}/product', [ProductController::class, 'rotacion'])->name('product.rotacion');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::match(['get', 'post'], '/order/filtro', [OrderController::class, 'filtro'])->name('order.filtro');
    Route::match(['get', 'post'], '/order/products/{id}/{idProduct}', [OrderController::class, 'products'])->name('order.products');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/clear', [OrderController::class, 'clear'])->name('order.clear');
    Route::post('/order/remove', [OrderController::class, 'remove'])->name('order.remove');
    Route::post('/order/pedido', [OrderController::class, 'pedido'])->name('order.pedido');
    Route::post('/order/send', [OrderController::class, 'send'])->name('order.send');
    Route::post('/order/actualizar', [OrderController::class, 'actualizar'])->name('order.actualizar');
    Route::get('/order/state/{id}', [OrderController::class, 'state'])->name('order.state');
    Route::get('/order/{id}/info', [OrderController::class, 'info'])->name('order.info');
    Route::get('/update/{id}/{cant}/order', [OrderController::class, 'update']);
    Route::get('/update_pedido/{idOrder}/{id}/{cant}/{idCar}/order', [OrderController::class, 'update_pedido']);
    Route::get('/order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('order/aceptar', [OrderController::class, 'aceptar'])->name('order.aceptar');
    Route::post('order/rechazar', [OrderController::class, 'rechazar'])->name('order.rechazar');
    Route::post('order/cambiar', [OrderController::class, 'cambiar'])->name('order.cambiar');
    Route::get('order/{id}/destroyCart', [OrderController::class, 'destroyCart'])->name('order.destroyCart');

    Route::get('/request/permission', [DrugstorexPharmacyController::class, 'index'])->name('request.index');
    Route::get('/request/permission-all', [DrugstorexPharmacyController::class, 'all'])->name('request.all');
    Route::post('/request/permission/add', [DrugstorexPharmacyController::class, 'store'])->name('request.store');
    Route::post('/request/permission/aceptar', [DrugstorexPharmacyController::class, 'aceptar'])->name('request.aceptar');
    Route::post('/request/permission/rechazar', [DrugstorexPharmacyController::class, 'rechazar'])->name('request.rechazar');

    Route::controller(ComboController::class)->prefix('combo')->group(function () {
        Route::match(['get', 'post'], '/{country}/state', 'state');
        Route::match(['get', 'post'], '/{state}/city', 'city');
        Route::match(['get', 'post'], '/{state}/municipality', 'municipality');
        Route::match(['get', 'post'], '/{pedido}/combo_pedido', 'pedido');
        Route::match(['get', 'post'], '/{idUser}/user', 'user');
    });
    // Ruta de Prueba de las Notificaciones 
    Route::post('/notificar', [PermisoController::class, 'enviarNotificacion'])->name('order.permiso');
    Route::get('/permiso/index', [PermisoController::class, 'index'])->name('cambio.index');
});

require __DIR__ . '/auth.php';
