<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utils\PaginationUtil;

class ProductController extends Controller
{
    /**
     * Cargar productos
     */
    public function load(Request $request)
    {

        $action = $request->action;

        // productos
        $products = [];
        foreach (auth()->user()->shop->categories as $category) {
            $items = Product::where('category_id', $category->id);
            
            // verficar si es ventas solo productos mayores que 0
            if($action == "sale") $items = $items->where('quantity', '>', '0');
            
            foreach ($items->get() as $item) array_push($products, $item);
        }

        $data = PaginationUtil::startPagination($products);
        
        return response()->json([            
            'statusCode' => 200,
            'data' => $data,
            'action' => $action
        ]);
    }

    /**
     * Buscar productos
     */
    public function search(Request $request)
    {

        $search = $request->search;
        $action = $request->action;

         // productos
         $products = [];
         foreach (auth()->user()->shop->categories as $category) {
            $items = Product::where('category_id', $category->id);
            
            // verficar si es ventas solo productos mayores que 0
            if($action == "sale") $items = $items->where('quantity', '>', '0');
            
            foreach ($items->get() as $item) array_push($products, $item);
         }

         // filtros         
         $results = collect($products)->filter(function($query) use ($search) {
            return false !== stristr("$query->name $query->reference", $search);
         });

         $data = PaginationUtil::startPagination($results, 100);

         return response()->json([
            'statusCode' => 200,
            'search' => $search,
            'action' => $action,
            'quantity' => count($results),
            'data' => $data
         ]);

    }

}
