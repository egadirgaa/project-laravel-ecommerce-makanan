<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderDetail;

class HomeController extends Controller
{
    public function index()
    {
        // ambil data terbanyak di order
        $topProducts = Product::select('products.*')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('COALESCE(SUM(order_details.quantity), 0) as total_quantity')
            ->groupBy('products.id')
            ->orderByDesc('total_quantity')
            ->limit(3)
            ->get();
        
        if ($topProducts->isEmpty()) {
            $topProducts = Product::latest()->limit(3)->get();
        }

        return view('home', compact('topProducts'));
    }
}
