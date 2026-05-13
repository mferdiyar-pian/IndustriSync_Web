<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->search) {
            $query->where('invoice_number', 'like', '%' . $request->search . '%');
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:paid,pending,failed',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $totalAmount = 0;
                $totalProfit = 0;
                $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'user_id' => auth()->id(),
                    'total_amount' => 0,
                    'profit' => 0,
                    'payment_status' => $request->payment_status,
                ]);

                foreach ($request->products as $item) {
                    $product = Product::find($item['id']);
                    
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Stock for {$product->name} is insufficient.");
                    }

                    $subtotal = $product->price * $item['quantity'];
                    // Assuming profit is 20% of price for demo
                    $profit = $subtotal * 0.2;

                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ]);

                    $product->decrement('stock', $item['quantity']);
                    
                    $totalAmount += $subtotal;
                    $totalProfit += $profit;
                }

                $transaction->update([
                    'total_amount' => $totalAmount,
                    'profit' => $totalProfit,
                ]);

                return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.product', 'user');
        return view('transactions.show', compact('transaction'));
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load('details.product', 'user');
        $pdf = Pdf::loadView('transactions.invoice', compact('transaction'));
        return $pdf->download($transaction->invoice_number . '.pdf');
    }
}
