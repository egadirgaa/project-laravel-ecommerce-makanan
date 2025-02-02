<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardSellerController extends Controller
{
    public function index()
{
    $sellerId = auth()->id();

    // Inisialisasi total revenue
    $totalRevenue = 0;

    // Ambil semua orders terkait dengan seller
    $orders = Order::whereHas('details.product', function ($query) use ($sellerId) {
        $query->where('seller_id', $sellerId);
    })->with('details.product')->get();

    // Hitung total revenue secara manual
    foreach ($orders as $order) {
        foreach ($order->details as $detail) {
            $totalRevenue += $detail->product->price * $detail->quantity;
        }
    }

    return view('seller.dashboard', [
        'totalProducts' => Product::where('seller_id', $sellerId)->count(),
        'totalOrders' => $orders->count(),
        'totalRevenue' => $totalRevenue,
        'recentOrders' => $orders->take(5),
    ]);
}

}
