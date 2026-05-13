<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with('product.category')->where('user_id', auth()->id())->latest()->get();
        return view('user.wishlist.index', compact('wishlist'));
    }

    public function toggle(Product $product)
    {
        $exists = Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->first();

        if ($exists) {
            $exists->delete();
            return redirect()->back()->with('success', 'Produk dihapus dari wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist!');
    }
}
