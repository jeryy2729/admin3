<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\RefundRequest;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function requestRefund(Request $request, $orderId)
{
    $order = Order::where('id', $orderId)->where('user_id', auth()->id())->firstOrFail();

   RefundRequest::create([
        'order_id' => $order->id,
        'user_id' => auth()->id(),
        'reason' => $request->reason,
    ]);

    return back()->with('success', 'Refund request submitted.');
}

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
