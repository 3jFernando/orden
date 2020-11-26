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
        $sales = Sale::with('contact')
            ->where('shop_id', $shopID)
            ->whereBetween(DB::raw('DATE(created_at)'), [$since, $until])
            ->orderBy('id', 'DESC')
            ->get();
        $purchases = Purchase::with('contact')
            ->where('shop_id', $shopID)
            ->whereBetween(DB::raw('DATE(created_at)'), [$since, $until])
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($sales as $sale) {
            $salesToDay += (float)$sale->total;
            $utilityToDay += (float)$sale->total_utility;
            $sale->date_humans = $sale->created_at->diffForHumans();
        }
        foreach ($purchases as $purchase) {
            $purchasesToDay += (float)$purchase->total;
            $purchase->date_humans = $purchase->created_at->diffForHumans();
        }

        return response()->json([
            'data' => [
                'sales' => $sales,
                'salesToDay' => $salesToDay,
                'purchases' => $purchases,
                'purchasesToDay' => $purchasesToDay,
                'utilityToDay' => $utilityToDay
            ]
        ])->setStatusCode(200);
    }
}
