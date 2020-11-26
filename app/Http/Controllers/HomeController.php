<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Utils\PaginationUtil;

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
        // fechas
        $since = Carbon::now()->format('Y-m-d');
        $until = Carbon::now()->format('Y-m-d');

        return view('admin.home', compact('since', 'until'));
    }

}
