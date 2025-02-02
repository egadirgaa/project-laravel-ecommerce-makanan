<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan semua item di keranjang
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        
        return view('cart.index', compact('carts'));
    }

    // Menambahkan item ke keranjang
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::Create(
            [
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity']
            ],
        );

        return redirect()->route('customer.cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Mengupdate jumlah item di keranjang
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);

        // Perbarui jumlah produk di keranjang
        $cart->quantity = $validated['quantity'];
        $cart->save();

        return redirect()->route('customer.cart.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }


    // Menghapus item dari keranjang
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
    public function order(Request $request)
    {
        // Ambil semua item di keranjang untuk pengguna yang sedang login
        $userId = Auth::id();
        $carts = \App\Models\Cart::with('product')->where('user_id', $userId)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Membuat pesanan baru
        $order = Order::create([
            'customer_id' => $userId,  // Menambahkan customer_id
            'category_id' => null, // Bisa disesuaikan jika perlu
        ]);

        // Menyimpan detail pesanan
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        // Menghapus semua item dari keranjang setelah pesanan dibuat
        \App\Models\Cart::where('user_id', $userId)->delete();

        // Redirect ke halaman pesanan atau pembayaran
        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}
