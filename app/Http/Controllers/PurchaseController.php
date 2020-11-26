<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchaseProduct;
use App\Http\Utils\PaginationUtil;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
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
        $data = Purchase::where('shop_id', auth()->user()->shop->id)->with('contact')->orderBy('id', 'DESC')->get();
        $purchases = PaginationUtil::startPagination($data);

        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // contactos
        $contacts = auth()->user()->shop->contacts;            

        return view('admin.purchases.create', compact('contacts'));
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
            'contact_id' => 'required|exists:App\Models\Contact,id',
            'total' => 'integer|required',
        ]);

        try { 

            // validar productos
            $products = json_decode($request->products);
            if(!count($products)) throw new Exception("Debes seleccionar por lo menos un producto.");        
        
            DB::beginTransaction();

            // crear la venta
            $sale = Purchase::create([
                'shop_id' => auth()->user()->shop->id,
                'contact_id' => $data['contact_id'],
                'subtotal' => $data['total'],
                'total' => $data['total']
            ]);

            // crear los productos de la compra
            foreach ($products as $product) {                                     

                // crear detalle del producto
                $purchaseProduct = new PurchaseProduct();

                $purchaseProduct->purchase_id = $sale->id;
                $purchaseProduct->product_id = $product->id;
                $purchaseProduct->quantity = $product->quantity_stock;
                $purchaseProduct->price_purchase = $product->price_purchase;
                $purchaseProduct->total = $product->total;
                $purchaseProduct->save();

                // producto en inventario
                $itemStock = Product::find($product->id);          

                // utilidad, y actualizar datos del producto
                $totalUtility = ( (float)$itemStock->price_sale - (float)$product->price_purchase );                

                $itemStock->quantity += $product->quantity_stock;
                $itemStock->price_purchase = $product->price_purchase;
                $itemStock->utility = $totalUtility;
                $itemStock->save();
                
            }

            DB::commit();
            return redirect()->route('purchases.index')->with('success', 'Compra creada con exito.');

        } catch(Exception $e) {
            DB::rollBack();
            return redirect()->route('purchases.create')
                ->with('danger', 'Problemas al crear la Compra.'. $e->getMessage())
                ->with('total', $request->total)
                ->with('products', $request->products)
                ->with('contact_id', $request->contact_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
