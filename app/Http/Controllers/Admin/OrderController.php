<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('date', 'desc')->paginate(10);
        $viewOrder = null;

        // If viewing an order, find it to populate the modal
        if ($request->has('view_order')) {
            $viewOrder = Order::with(['orderItems.product'])->findOrFail($request->view_order);
        }

        return view('admin.orders.index', compact('orders', 'viewOrder'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        try {
            $order = Order::findOrFail($id);
            $order->update(['status' => $request->status]);

            return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Failed to update order status: '.$e->getMessage())->with('view_order', $id);
        }
    }
}
