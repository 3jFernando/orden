<?php

namespace App\Http\Controllers;

use App\Http\Utils\PaginationUtil;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exact;

class SaleController extends Controller
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
        $data = Sale::where('shop_id', auth()->user()->shop->id)->with('contact')->orderBy('id', 'DESC')->get();
        
        $sales = PaginationUtil::startPagination($data);

        return view('admin.sales.index', compact('sales'));
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

        return view('admin.sales.create', compact('contacts'));
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

        // validar productos
        $products = json_decode($request->products);
        if(!count($products)) return redirect()->route('sales.create')->with('danger', 'Debes seleccionar por lo menos un producto.');

        try { 

            DB::beginTransaction();

            // crear la venta
            $sale = Sale::create([
                'shop_id' => auth()->user()->shop->id,
                'contact_id' => $data['contact_id'],
                'subtotal' => $data['total'],
                'total' => $data['total']
            ]);

            // crear los productos de la venta
            $totalUtility = 0;
            foreach ($products as $product) {

                // crear el detalle
                $saleProduct = new SaleProduct();

                $saleProduct->sale_id = $sale->id;
                $saleProduct->product_id = $product->id;
                $saleProduct->quantity = $product->quantity_stock;
                $saleProduct->price_sale_unit = $product->price_sale;
                $saleProduct->total = $product->total;
                $saleProduct->utility = ( $product->quantity_stock * (float)$product->utility );
                $saleProduct->save();

                // utilidad
                $totalUtility += $saleProduct->utility;

                // actualziar el stock
                $itemStock = Product::find($product->id);                
                $itemStock->quantity -= $saleProduct->quantity;
                $itemStock->save();

            }

            $sale->total_utility = $totalUtility;
            $sale->save();

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Venta creada con exito.');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('sales.index')->with('danger', 'Problemas al crear la venta.'. $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {

        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
