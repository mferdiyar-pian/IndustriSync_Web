<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class IntegrationController extends Controller
{
    public function index()
    {
        return view('integrations.index');
    }

    public function shopee()
    {
        return view('integrations.shopee');
    }

    public function shopeeSync(Request $request)
    {
        // Mock sync logic
        // In a real scenario, this would call Shopee API to update stock/products
        
        return back()->with('success', 'Sinkronisasi dengan Shopee berhasil dilakukan!');
    }
}
