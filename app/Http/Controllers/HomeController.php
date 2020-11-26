<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $salesToDay = 0;
        $purchasesToDay = 0;
        $utilityToDay = 0;
        
        $sales = auth()->user()->shop->sales;
        foreach ($sales as $sale) {
            $salesToDay += (float)$sale->total;
            $utilityToDay += (float)$sale->total_utility;
        }

        $purchases = auth()->user()->shop->purchases;
        foreach ($purchases as $purchase) $purchasesToDay += (float)$purchase->total;

        return view('admin.home', compact('salesToDay', 'purchasesToDay', 'utilityToDay'));
    }
}
