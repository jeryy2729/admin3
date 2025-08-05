<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function index()
{
    $userId = Auth::id();

    $cartItems = Cart::where('user_id', $userId)
        ->with('product') // assuming you have a relation in Cart model
        ->get();

    return view('frontend.cart.index', compact('cartItems'));
}


    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock < 1) {
            return back()->with('error', 'Product is out of stock.');
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        $product->decrement('stock');

            return redirect()->route('cart.index')->with('success', 'Data has been inserted successfully.');
    }

    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $product = Product::find($cart->product_id);

        if ($product) {
            $product->increment('stock', $cart->quantity);
        }

        $cart->delete();

        return back()->with('success', 'Product removed from cart.');
    }
    public function decreasequantity($id)
{
    $cart = Cart::findOrFail($id);

    // If quantity is more than 1, decrement quantity
    if ($cart->quantity > 1) {
        $cart->decrement('quantity');

        // Restore product stock
        $product = Product::find($cart->product_id);
        if ($product) {
            $product->increment('stock');
        }

        return back()->with('success', 'Product quantity decreased.');
    } else {
        return back()->with('warning', 'Minimum quantity is 1. If you want to remove the item, click Remove.');
    }
}
    public function increaseQuantity($id)
    {
        $cart = Cart::findOrFail($id);
        $product = Product::find($cart->product_id);

        if ($product && $product->stock > 0) {
            $cart->increment('quantity');
            $product->decrement('stock');

            return back()->with('success', 'Product quantity increased.');
        }

        return back()->with('error', 'No more stock available for this product.');
    }
    

}
