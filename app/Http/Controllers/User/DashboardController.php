<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalTransactions = Transaction::where('user_id', $user->id)->count();
        $totalSpent = Transaction::where('user_id', $user->id)->where('payment_status', 'paid')->sum('total_amount');
        
        $recentTransactions = Transaction::where('user_id', $user->id)->latest()->take(5)->get();
        $latestProducts = Product::with('category')->latest()->take(5)->get();
        
        // Personal transaction data for chart (last 7 days)
        $txData = Transaction::where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total'))
            ->groupBy('date')
            ->pluck('total', 'date');

        return view('user.dashboard', compact(
            'totalTransactions',
            'totalSpent',
            'recentTransactions',
            'latestProducts',
            'txData'
        ));
    }
}
