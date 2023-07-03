<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Mark;
use App\Models\Category;
use App\Models\Order_detail;
use App\Models\Order;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        Order::create([
            'price_total' => 0,
            'remarks' => '',
            'supplier_id' => 1,
            'user_id' => $user_id,
            'voucher_id' => 3
        ]);

        $order_x = Order::latest()->first();
        return redirect('/warehouse/create/'. $order_x->id);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id) // id de order de compra
    {
        return view('warehouse_create')->with('order_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marks = Mark::get();
        $categories = Category::get();
        $valor1=1; $valor2=1; $centinela=false;

        // Comprueba si existe un dato en Category
        foreach ($categories as $category) {
            if ($category->name == strtoupper($request->input('category'))){
                $valor1 = $category->id;
                $centinela = true;
            }
        }
        if ($centinela == false) {
            Category::create([
                'name' => strtoupper($request->input('category')),
            ]);
            $aux = Category::latest()->first();
            $valor1 = $aux->id;
        }
        $centinela = false;
        // Comprueba si existe un dato en mark
        if(Mark::count() != 0) {
            foreach ($marks as $mark) {
                if ($mark->name == strtoupper($request->input('mark'))){
                    $valor2 = $mark->id;
                    $centinela = true;
                }
            }
        }
        if ($centinela == false) {
            Mark::create([
                'name' => strtoupper($request->input('mark')),
            ]);
            $aux = Mark::latest()->first();
            $valor2 = $aux->id;
        }
        
        // Product::create($request->all());
        Product::create([
            'name' => strtoupper($request->input('name')),
            'model' => strtoupper($request->input('model')),
            'stock' => $request->input('amount'),
            'category_id' => $valor1,
            'price' => $request->input('price'),
            'mark_id' => $valor2,
            'date_manufacture' => $request->input('date'),
            'description' => $request->input('description'),
            'state' => 1,
        ]);

        $product_id = Product::latest()->first();

        Order_detail::create([
            'amount' => $request->input('amount'),
            'sub_total' => (float)$request->input('price') * (int)$request->input('amount'),
            'order_id' => (int)$request->input('order_id'),
            'product_id' => $product_id->id,
        ]);

        $order_x = Order::latest()->first();

        if ($order_x->voucher_id != 3){
            return redirect('/warehouse/orders/' . $request->input('order_id') . '/edit');
        }else {
            $order_x->update([
                'price_total' => (float)$request->input('price') * (int)$request->input('amount')
            ]);
            return redirect('/warehouse');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::get();
        
        return view('warehouse')->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marks = Mark::get();
        $categories = Category::get();
        $product = Product::find($id);

        return view('products_edit')->with([
            'product' => $product,
            'marks' => $marks,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $category = Category::find($request->category);
        $mark = Mark::find($request->mark);

        $name = $category->name . ' ' . $request->model . ' ' . $mark->name;
        
        $product->update([
            'name' => $name,
            'model' => $request->model,
            'description' => $request->description,
            'price' => $request->price,
            'mark' => $request->mark,
            'category' => $request->category
        ]);
        return redirect('/warehouse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/warehouse');
    }
}
