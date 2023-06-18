<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Order_detail;
use App\Models\Order;
use App\Models\Product;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // creamos el orden de compra
        $user = Auth::user();
        $user_id = Auth::id();
        Order::create([
            'price_total' => 0,
            'remarks' => '',
            'supplier_id' => 1, // Como prueba cambiar en futuro
            'user_id' => $user_id,
            'voucher_id' => 2, // Como prueba
        ]);
        
        $order = Order::latest()->first();
        return redirect('/warehouse/orders/' . $order->id . '/edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_product = (int)$request->input('product');

        $order = Order::latest()->first();
        Order_detail::create([
            'amount' => $request->input('amount'),
            'sub_total' => (float)$request->input('price') * (int)$request->input('amount'),
            'order_id' => $order->id,
            'product_id' => $id_product,
        ]);
        $products = Product::get();
        foreach ($products as $product) {
            if ($product->id == $id_product) {
                $product->update([
                    'stock' => $product->stock + (int)$request->input('amount'),
                    'price' => (float)$request->input('price')
                ]);
            }
        }
        return redirect('/warehouse/orders/' . $order->id . '/edit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::get();
        $details = Order_detail::get();
        $suppliers = Supplier::get();

        $total = 0;
        foreach ($details as $detail) {
            if ($detail->order_id == $id) {
                $total = $total + $detail->sub_total;
            }
        }
        return view('warehouse_orders')->with([
            'products' => $products, 
            'details' => $details, 
            'order_id' => $id, 
            'suppliers' => $suppliers,
            'total' => $total
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'price_total' => (float)$request->input('total'),
            'supplier_id' => (int)$request->input('supplier'),
            'voucher_id' => (int)$request->input('voucher')
        ]);
        return redirect('/warehouse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('/dashboard');
    }
}
