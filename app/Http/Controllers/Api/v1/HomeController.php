<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Purchase;

class HomeController extends Controller
{
    /**
     * Filtros de estadisticas del home
     */
    public function home(Request $request)
    {
        $salesToDay = 0;
        $purchasesToDay = 0;
        $utilityToDay = 0;

        // rangos
        $since = $request->since;
        $until = $request->until;

        $shopID = auth()->user()->shop->id;
        
        // ventas
        $sales = Sale::where('shop_id', $shopID)->whereBetween(DB::raw('DATE(created_at)'), [$since, $until])->get();
        $purchases = Purchase::where('shop_id', $shopID)->whereBetween(DB::raw('DATE(created_at)'), [$since, $until])->get();

        foreach ($sales as $sale) {
            $salesToDay += (float)$sale->total;
            $utilityToDay += (float)$sale->total_utility;
        }
        foreach ($purchases as $purchase) $purchasesToDay += (float)$purchase->total;

        return response()->json([            
            'data' => [
                'sales' => $salesToDay,
                'purchases' => $purchasesToDay,
                'utility' => $utilityToDay
            ]
        ])->setStatusCode(200);
    }
}
