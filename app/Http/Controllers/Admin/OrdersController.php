<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index()
    {
        // return response()->json($request->toArray());
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
        public function edit($id)
    {
        $order = Order::find($id);
       
    
        return view('admin.orders.edit', compact('order'));
    }
    
public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        
        'status' => 'required',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {
        $order = Order::find($id); // Changed variable name to $book
     
        $order->status = $request->input('status');
       
         
        // Save the changes to the database
        $order->save();
        
        // Redirect with success message
        return redirect(route('orders.index'))->with('success', 'Order has been updated successfully.');
    }
}


    


     



}
