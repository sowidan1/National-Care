<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderStoreRequest;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {

        try {
            DB::beginTransaction();

            $total = collect($request->items)->sum(fn($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'id'             => Str::ulid(),
                'full_name'      => $request->full_name,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'total'          => $total,
                'date'           => now()->toDateString(),
                'status'         => 'completed',
                'payment_method' => 'cash'
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'id'         => Str::ulid(),
                    'order_id'   => $order->id,
                    'product_id' => $item['id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to place order: ' . $e->getMessage()
            ], 500);
        }
    }
}