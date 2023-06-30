<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Models\Sale_detail;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $sales = Sale::get();
    $products = Product::get();
    $users = User::get();
    $detail_sales = Sale_detail::get();
    
    $user = Auth::user();
    $user->update([
        'state' => 1
    ]);

    return view('dashboard')->with([
        'sales' => $sales,
        'products' => $products,
        'users' => $users,
        'details' => $detail_sales
    ]);
    
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTAS NUEVAS PARA LOS NUEVAS SECCIONES
Route::controller(SalesController::class)->group(function () {
    Route::get('/api/data', 'index');
    Route::get('/sales', "show");
    Route::get('/sales/create', "create");
    Route::post('/sales', "store");
    Route::get('/sales/{sale}/edit', "edit");
    Route::patch('/sales/{sale}', "update");
    Route::delete('/sales/{sale}', "destroy");
})->middleware(['auth', 'verified'])->name('sales');

Route::get('/detail/delete/{detail}', function (Sale_detail $detail) {
    $products = Product::get();
    $producto_id = $detail->product_id;

    foreach ($products as $product){
        if($product->id == $producto_id) {
            $product->update([
                'stock' => $product->stock + (int)$detail->amount,
            ]);
        }
    }

    $detail->delete();

    $cadena = "/sales/ " . $detail->sale_id . " /edit/";
    return redirect($cadena);
});

Route::controller(ProductsController::class)->group(function () {
    Route::get('/warehouse/create/just', "index");
    Route::get('/warehouse', "show");
    Route::get('/warehouse/create/{id}', "create");
    Route::post('/warehouse', "store");
    Route::get('/warehouse/{id}/edit', "edit");
    Route::patch('/warehouse/{product}', "update");
    Route::delete('/warehouse/delete/{product}', "destroy");
})->middleware(['auth', 'verified'])->name('warehouse');

Route::controller(OrdersController::class)->group(function () {
    Route::get('/warehouse/orders', "show");
    Route::get('/warehouse/orders/create', "create");
    Route::post('/warehouse/orders', "store");
    Route::get('/warehouse/orders/{order}/edit', "edit");
    Route::patch('/warehouse/orders/{order}', "update");
    Route::delete('/warehouse/orders/{order}', "destroy");
})->middleware(['auth', 'verified'])->name('warehouse_orders');

Route::get('/detail_order/delete/{detail}', function (Order_detail $detail) {
    $products = Product::get();
    $producto_id = $detail->product_id;

    foreach ($products as $product){
        if($product->id == $producto_id) {
            $product->update([
                'stock' => $product->stock - (int)$detail->amount,
            ]);
        }
    }

    $detail->delete();
    $cadena = "/warehouse/orders/". $detail->order_id ."/edit";
    return redirect($cadena);
});

Route::controller(SuppliersController::class)->group(function () {
    Route::get('/api/supplier', 'index');
    Route::get('/supplier', "show");
    Route::get('/supplier/create', "create");
    Route::post('/supplier', "store");
    Route::get('/supplier/{order}/edit', "edit");
    Route::patch('/supplier/{order}', "update");
    Route::delete('/supplier/{order}', "destroy");
})->middleware(['auth', 'verified'])->name('supplier');

Route::controller(ReportsController::class)->group(function () {
    Route::get('/reports', "index");
    Route::get('/reports/create', "create");
    Route::get('/reports/{id}', "show");
    Route::post('/reports', "store");
    Route::get('/reports/{id}/viewSale', "viewSale");
    Route::get('/reports/{id}/viewOrder', "viewOrder");
    Route::patch('/reports/{product}', "update");
    Route::delete('/reports/{id}', "destroy");
})->middleware(['auth', 'verified'])->name('reports');

Route::controller(UsersController::class)->group(function () {
    Route::get('/users', "index");
    Route::get('/users/create', "create");
    Route::get('/users/{table}', "show");
    Route::post('/users', "store");
    Route::delete('/users/{user}', "destroy");
})->middleware(['auth', 'verified'])->name('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
