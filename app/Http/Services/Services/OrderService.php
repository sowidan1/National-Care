<?php

namespace App\Http\Services\Services;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Services\Contracts\OrderContract;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService implements OrderContract
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

    public function store(OrderStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $total = collect($request->items)->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'id' => Str::ulid(),
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total' => $total,
                'date' => now()->toDateString(),
                'status' => 'completed',
                'payment_method' => 'cash',
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'id' => Str::ulid(),
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to place order: '.$e->getMessage(),
            ], 500);
        }
    }
}
