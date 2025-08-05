<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
class PaymentController extends Controller
{
    /**
     * Show the Stripe Checkout form.
     */
  public function show()
{
    $user = Auth::user();
    $cartItems =Cart::where('user_id', $user->id)->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $amountPKR = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    
    if ($amountPKR < 50) {
        return redirect()->back()->with('error', 'Minimum total must be ₨50 to proceed with payment.');
    }

    $amountInPaisa = $amountPKR * 100;

    return view('frontend.checkout.form', [
        'user' => $user,
        'amount' => $amountInPaisa,
        'amount_display' => $amountPKR,
        'cart' => $cartItems,
    ]);
}

    /**
     * Create Stripe PaymentIntent.
     */
    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer',
            'customerName' => 'required|string',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required|string',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $intent = PaymentIntent::create([
                'amount' => $request->amount,
                'currency' => 'pkr',
                'automatic_payment_methods' => ['enabled' => true],
                'receipt_email' => $request->customerEmail,
                'metadata' => [
                    'customer_name' => $request->customerName,
                    'customer_phone' => $request->customerPhone,
                ],
            ]);

            return response()->json(['clientSecret' => $intent->client_secret]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store order in DB after payment success.
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'customerName' => 'required|string',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required|string',
            'address' => 'required|string',
            'amount' => 'required|integer',
        ]);

$cart = Cart::where('user_id', Auth::id())->with('product')->get();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

      $productSummary = collect($cart)->map(function ($item) {
    return $item->product->name . ' (x' . $item->quantity . ')';
})->implode(', ');

        Order::create([
            'user_id' => Auth::id(),
            'name' => $request->customerName,
            'email' => $request->customerEmail,
            'phone' => $request->customerPhone,
            'address' => $request->address,
            'products' => $productSummary,
'total_amount' => $request->amount / 100,
        ]);

Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.show')->with('success', 'Payment Successful! Order Placed.');
    }
}
