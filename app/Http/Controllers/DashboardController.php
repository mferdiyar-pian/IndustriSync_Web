<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        $totalSales = Transaction::where('payment_status', 'paid')->sum('total_amount');
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalProfit = Transaction::where('payment_status', 'paid')->sum('profit');
        
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<=', 10)->get();
        
        // Sales data for chart (last 7 days)
        $salesData = Transaction::where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
            ->groupBy('date')
            ->pluck('total', 'date');

        return view('dashboard', compact(
            'totalSales', 
            'totalProducts', 
            'totalTransactions', 
            'totalProfit',
            'recentTransactions',
            'lowStockProducts',
            'salesData'
        ));
    }
}
