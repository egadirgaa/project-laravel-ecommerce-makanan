<?php

namespace App\Http\Controllers\Seller;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    public function index()
{
    $sellerId = Auth::id();

    // Ambil order details yang hanya memiliki order ID unik
    $orders = OrderDetail::with(['order', 'product'])
        ->whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
        ->get()
        ->groupBy('order_id'); // Kelompokkan berdasarkan ID pesanan untuk memastikan pesanan unik

    // Hitung total harga untuk setiap pesanan
    $orders = $orders->map(function ($orderDetails) {
        $orderDetail = $orderDetails->first(); // Ambil hanya satu item dari setiap kelompok
        $orderDetail->total_price = $orderDetails->sum(function ($orderDetail) {
            return $orderDetail->quantity * $orderDetail->price;
        });
        return $orderDetail;
    });

    // Paginasi hasil
    $orders = new \Illuminate\Pagination\LengthAwarePaginator(
        $orders,
        $orders->count(),
        10,
        Paginator::resolveCurrentPage(),
        ['path' => Paginator::resolveCurrentPath()]
    );

    return view('seller.orders.index', compact('orders'));
}



    public function show($id)
    {
        // Ambil detail pesanan berdasarkan ID pesanan
        $order = Order::with(['orderDetails.product'])->findOrFail($id);

        // Kirim data ke view show
        return view('seller.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi status yang dikirimkan
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
    
        // Ambil pesanan berdasarkan ID
        $order = Order::findOrFail($id);
    
        // Update status pesanan
        $order->status = $validated['status'];
        $order->save();
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('seller.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

}
