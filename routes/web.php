<?php

use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\configuracion\combos\MaritalStatusController;
use App\Http\Controllers\Admin\configuracion\combos\PrefixController;
use App\Http\Controllers\Admin\configuracion\combos\SexController;
use App\Http\Controllers\Admin\configuracion\combos\StatusController;
use App\Http\Controllers\Admin\configuracion\combos\StatusPedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\configuracion\direccion\CountryController;
use App\Http\Controllers\Admin\configuracion\direccion\StateController;
use App\Http\Controllers\Admin\configuracion\direccion\CityController;
use App\Http\Controllers\Admin\configuracion\direccion\MunicipalityController;
use App\Http\Controllers\Admin\configuracion\direccion\ParishController;
use App\Http\Controllers\Admin\configuracion\direccion\ZoneController;
use App\Http\Controllers\Admin\configuracion\pedidos\OrderController;
use App\Http\Controllers\Admin\configuracion\productos\CategoryController;
use App\Http\Controllers\Admin\configuracion\productos\MarkController;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('auth.login');
})->name('home');
Route::get('/lang/{language}', function ($language) {
    Session::put('language', $language);
    return redirect()->back();
})->name('language');

// RUTAS DE VERIFICACIÓN DE CORREO //
Auth::routes(['verify' => true]);
//FIN DE RUTAS VERIFICACIÓN//

Route::middleware(['auth', 'translate', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class)->except(['show'])->names('roles');
    Route::resource('countries', CountryController::class)->except(['show'])->names('countries');
    Route::resource('zones', ZoneController::class)->except(['show'])->names('zones');
    Route::resource('states', StateController::class)->except(['show'])->names('states');
    Route::resource('cities', CityController::class)->except(['show'])->names('cities');
    Route::resource('municipality', MunicipalityController::class)->except(['show'])->names('municipality');
    Route::resource('parishes', ParishController::class)->except(['show'])->names('parishes');
    Route::resource('prefixes', PrefixController::class)->except(['show'])->names('prefixes');
    Route::resource('sexes', SexController::class)->except(['show'])->names('sexes');
    Route::resource('status', StatusController::class)->except(['show'])->names('status');
    Route::resource('statusp', StatusPedidoController::class)->except(['show'])->names('statusp');
    Route::resource('maritalStatus', MaritalStatusController::class)->except(['show'])->names('maritalStatus');
    Route::resource('category', CategoryController::class)->except(['show'])->names('category');
    Route::resource('speciality', SpecialityController::class)->except(['show'])->names('speciality');

    // Route::resource('users', UserController::class)->names('users');
    Route::resource('pharmacy', PharmacyController::class)->except(['show'])->names('pharmacy');
    Route::resource('drugstore', DrugstoreController::class)->except(['show'])->names('drugstore');
    Route::resource('jluser', JluserController::class)->except(['show'])->names('jluser');
    Route::resource('product', ProductController::class)->except(['show'])->names('product');
    Route::resource('mis-productos', MisProductosController::class)->except(['show', 'update', 'create', 'destroy'])->names('mis_productos');

    Route::resource('seller', SellerController::class)->except(['show'])->names('seller');


    Route::post('seller/aceptar', [SellerController::class, 'aceptar'])->name('seller.aceptar');
    Route::post('seller/rechazar', [SellerController::class, 'rechazar'])->name('seller.rechazar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::match(['get', 'post'], '/order/filtro', [OrderController::class, 'filtro'])->name('order.filtro');
    Route::match(['get', 'post'], '/order/products/{id}', [OrderController::class, 'products'])->name('order.products');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/clear', [OrderController::class, 'clear'])->name('order.clear');
    Route::post('/order/remove', [OrderController::class, 'remove'])->name('order.remove');
    Route::post('/order/pedido', [OrderController::class, 'pedido'])->name('order.pedido');
    Route::post('/order/send', [OrderController::class, 'send'])->name('order.send');
    Route::get('/order/{order}/detail', [OrderController::class, 'detalle'])->name('order.detalle');
    Route::get('/order/state', [OrderController::class, 'state'])->name('order.state');
    Route::get('/order/{id}/info', [OrderController::class, 'info'])->name('order.info');
    Route::get('/update/{id}/{cant}/order', [OrderController::class, 'update']);
    Route::get('/update_pedido/{id}/{cant}/order', [OrderController::class, 'update_pedido']);
    Route::post('/order/pdf', [OrderController::class, 'pdf'])->name('order.pdf');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');

    Route::get('/request/permission', [DrugstorexPharmacyController::class, 'index'])->name('request.index');
    Route::post('/request/permission/add', [DrugstorexPharmacyController::class, 'store'])->name('request.store');
    Route::post('/request/permission/aceptar', [DrugstorexPharmacyController::class, 'aceptar'])->name('request.aceptar');
    Route::post('/request/permission/rechazar', [DrugstorexPharmacyController::class, 'rechazar'])->name('request.rechazar');

    Route::controller(ComboController::class)->prefix('combo')->group(function () {
        Route::match(['get', 'post'], '/{country}/state', 'state')->name('combo_estado');
        Route::match(['get', 'post'], '/{state}/city', 'city')->name('combo_ciudad');
        Route::match(['get', 'post'], '/{state}/municipality', 'municipality')->name('combo_municipio');
        Route::match(['get', 'post'], '/{municipality}/parish', 'parish')->name('combo_parroquia');
        Route::match(['get', 'post'], '/{pedido}/combo_pedido', 'pedido');
        Route::match(['get', 'post'], '/{idUser}/user', 'user');
    });
});

require __DIR__ . '/auth.php';
