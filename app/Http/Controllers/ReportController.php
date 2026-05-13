<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        $transactions = Transaction::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('payment_status', 'paid')
            ->get();

        $totalSales = $transactions->sum('total_amount');
        $totalProfit = $transactions->sum('profit');
        
        $stockReport = Product::with('category')->get();

        return view('reports.index', compact('transactions', 'totalSales', 'totalProfit', 'stockReport', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $type = $request->type ?? 'sales';
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        if ($type === 'sales') {
            $data = Transaction::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                ->where('payment_status', 'paid')
                ->get();
            $pdf = Pdf::loadView('reports.sales_pdf', compact('data', 'startDate', 'endDate'));
        } else {
            $data = Product::with('category')->get();
            $pdf = Pdf::loadView('reports.stock_pdf', compact('data'));
        }

        return $pdf->download("report_{$type}_{$startDate}_to_{$endDate}.pdf");
    }
}
