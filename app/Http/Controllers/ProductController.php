<?php

namespace App\Http\Controllers;

use App\Http\Utils\PaginationUtil;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // categorias de la tienda
        $categories = auth()->user()->shop->categories;
        $productsData = [];

        // productos
        foreach ($categories as $category) {
            $items = Product::with('category')->where('category_id', $category->id)->get();
            foreach ($items as $item) array_push($productsData, $item);
        }

        $products = PaginationUtil::startPagination($productsData, 7);        

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = auth()->user()->shop->categories;

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:App\Models\Category,id',
            'name' => 'required',
            'reference' => 'required',
            'price_sale' => 'required|integer',
            'image' => 'required|max:2000',
        ]);

        $product = new Product();

        // viene una imagen
        $file = $request->file('image');
        if($file) {
            $image = $file->store('products', 'public');
            $product->image = $image;
        }

        $product->category_id = $data['category_id'];
        $product->name = $data['name'];
        $product->reference = $data['reference'];
        $product->price_sale = $data['price_sale'];        

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    
        $categories = auth()->user()->shop->categories; // categorias
        
        // historia de compras
        $historyPurchases = [];
        foreach (auth()->user()->shop->purchases ?? [] as $purchase) {
            foreach ($purchase->products as $item) array_push($historyPurchases, $item);
        }
        rsort($historyPurchases);
        $historyPurchases = PaginationUtil::startPagination($historyPurchases);

        // historia de compras
        $historySales = [];
        foreach (auth()->user()->shop->sales ?? [] as $sale) {
            foreach ($sale->products as $item) array_push($historySales, $item);
        }
        rsort($historySales);
        $historySales = PaginationUtil::startPagination($historySales);

        return view('admin.products.edit', compact('categories', 'product', 'historyPurchases', 'historySales'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:App\Models\Category,id',
            'name' => 'required',
            'reference' => 'required',
            'price_sale' => 'required|integer'
        ]);

        // viene una imagen
        $file = $request->file('image');
        if($file) {
            $image = $file->store('products', 'public');
            $product->image = $image;
        }

        $product->category_id = $data['category_id'];
        $product->name = $data['name'];
        $product->reference = $data['reference'];
        $product->price_sale = $data['price_sale'];
        $product->utility = ((float)$data['price_sale'] - (float)$product->price_purchase);

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto modificado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto Eliminado exitosamente.');
    }

}
