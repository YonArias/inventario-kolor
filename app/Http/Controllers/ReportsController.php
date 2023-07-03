<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale_detail;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Product;
use App\Models\Mark;
use App\Models\Category;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect('/reports/0');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sales = Sale::get();
        $detail_sales = Sale_detail::get();
        $orders = Order::get();
        $detail_orders = Order_detail::get();
        $table = (int)$id;
        $suppliers = Supplier::get();
        $users = User::get();

        return view('reports')->with([
            'table' => $table, 
            'sales' => $sales, 
            'orders' => $orders, 
            'orders_details' => $detail_orders,
            'suppliers' => $suppliers,
            'sales_details' => $detail_sales,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function viewSale(Sale $sale)
    {
        $detail = Sale_detail::get();
        $user = User::find($sale->user_id);
        $products = Product::get();

        $voucher = 'NONE';

        if ($sale->voucher_id == 1) {
            $voucher = 'FACTURA';
        }
        if ($sale->voucher_id == 2) {
            $voucher = 'BOLETA';
        }

        return view('reports_sale')->with([
            'sale' => $sale,
            'details' => $detail,
            'user' => $user,
            'products' => $products,
            'voucher' => $voucher
        ]);
    }
    /** 
     * Show the form for editing the specified resource.
     * 
    */
    public function viewOrder(Order $order)
    {
        $detail = Order_detail::get();
        $user = User::find($order->user_id);
        $supplier = Supplier::find($order->supplier_id);
        $products = Product::get();

        $voucher = 'NONE';

        if ($order->voucher_id == 1) {
            $voucher = 'FACTURA';
        }
        if ($order->voucher_id == 2) {
            $voucher = 'BOLETA';
        }

        return view('reports_order')->with([
            'order' => $order,
            'details' => $detail,
            'user' => $user,
            'supplier' => $supplier,
            'products' => $products,
            'voucher' => $voucher
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
