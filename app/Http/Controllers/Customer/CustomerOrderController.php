<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderDetails.product'])
            ->where('customer_id', auth()->id())
            ->get();

        return view('customer.orders.index', compact('orders'));
    }
    public function cancel($id)
{
    // Ambil pesanan berdasarkan ID dan pastikan milik customer yang sedang login
    $order = Order::where('id', $id)
        ->where('customer_id', auth()->id())
        ->firstOrFail();

    // Periksa status saat ini agar tidak bisa membatalkan pesanan yang sudah completed
    if ($order->status === 'completed') {
        return redirect()->route('customer.orders.index')
            ->with('error', 'Pesanan sudah selesai dan tidak bisa dibatalkan.');
    }

    // Update status pesanan menjadi cancelled
    $order->update(['status' => 'cancelled']);

    return redirect()->route('customer.orders.index')
        ->with('success', 'Pesanan berhasil dibatalkan.');
}

}
