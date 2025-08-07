<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Http\Controllers\Controller;

class AdminRefundController extends Controller
{
    //
    public function index()
{
    $refunds =RefundRequest::with('order', 'user')->latest()->get();
    return view('admin.refunds.index', compact('refunds'));
}

public function approve($id)
{
    $refund =RefundRequest::findOrFail($id);
    $refund->update(['status' => 'approved']);

    // Optional: Trigger Stripe Refund
    // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    // \Stripe\Refund::create(['payment_intent' => $refund->order->payment_intent_id]);

    return back()->with('success', 'Refund approved.');
}

public function reject($id)
{
    $refund =RefundRequest::findOrFail($id);
    $refund->update(['status' => 'rejected']);

    return back()->with('error', 'Refund rejected.');
}

}
