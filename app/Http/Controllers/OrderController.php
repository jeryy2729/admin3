<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('frontend.orders.history', compact('orders'));
    }
}
