<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan form pengaturan akun
    public function settings()
    {
        return view('auth.settings');
    }

    // Fungsi untuk mengupdate pengaturan akun
    public function updateSettings(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'phone' => 'required|string|max:15',
        'password' => 'nullable|min:8|confirmed',
    ]);

    // Ambil user yang sedang login
    $user = Auth::user();

    // Update data user
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

    // Jika password diisi, update password
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Simpan perubahan
    $user->save();

    // Redirect ke halaman pengaturan dengan pesan sukses
    return redirect()->route('auth.settings')->with('success', 'Akun berhasil diperbarui!');
}


    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
