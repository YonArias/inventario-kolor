<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_detail;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        Sale::create([
            'total' => 0,
            'user_id' => $user_id,
            'voucher_id' => 3,
        ]);
        $sale = Sale::latest()->first();
        $cadena = "/sales/ " . $sale->id . " /edit/";

        return redirect($cadena);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = Sale::latest()->first();
       
        Sale_detail::create([
            'amount' => $request->input('amount'),
            'sub_total' => (int)$request->input('amount') * (float)$request->input('price'),
            'sale_id' => $sale->id,
            'product_id' => $request->input('id'),
        ]);

        $products = Product::get();

        // Actualizar stock
        foreach ($products as $product) {
            if ($product->id == $request->input('id')) {
                $product->update([
                    'stock' => $product->stock - (int)$request->input('amount')
                ]);
            }
        }


        $cadena = "/sales/ " . $sale->id . " /edit/";
        return redirect($cadena);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $detail = Sale_detail::get();
        $products = Product::get();
        return view('sales')->with([
            'sale' => $sale,
            'details' => $detail,
            'products' => $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->update([
            'total' => (float)$request->input('total'),
            'voucher_id' => $request->input('voucher'),
        ]);
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect('/dashboard');
    }
}
