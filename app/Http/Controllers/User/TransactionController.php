<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->latest()->paginate(10);
        return view('user.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('user.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $totalAmount = 0;
                $totalProfit = 0;
                $invoiceNumber = 'USR-' . strtoupper(Str::random(8));

                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'user_id' => auth()->id(),
                    'total_amount' => 0,
                    'profit' => 0,
                    'payment_status' => 'paid',
                ]);

                foreach ($request->products as $item) {
                    $product = Product::find($item['id']);
                    
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Stok untuk {$product->name} tidak cukup.");
                    }

                    $subtotal = $product->price * $item['quantity'];
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

                session()->forget('cart');

                return redirect()->route('user.transactions.index')->with('success', 'Pesanan Anda berhasil dibuat dan sedang diproses!');
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $user = auth()->user();
        
        // Allow if user is owner of transaction OR if user is admin/owner/staff
        if ($transaction->user_id !== $user->id && !in_array($user->role->slug, ['admin', 'owner', 'staff'])) {
            abort(403);
        }
        $transaction->load('details.product');
        return view('user.transactions.show', compact('transaction'));
    }
}
