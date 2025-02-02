<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardCustomerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recentOrders = $user->orders()->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->sum('total_price');
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $completedOrders = $user->orders()->where('status', 'completed')->count();
        
        return view('customer.dashboard', compact('recentOrders', 'totalOrders',    'totalSpent', 'pendingOrders', 'completedOrders'));
    }
}
