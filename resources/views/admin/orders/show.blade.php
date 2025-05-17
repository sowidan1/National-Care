<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Order Details - {{ Str::limit($order->id, 10) }}</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Back to Orders</a>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Order Details -->
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <div class="space-y-4">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Customer:</strong> {{ $order->full_name }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
                <p><strong>Date:</strong> {{ $order->date }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            </div>

            <h4 class="text-md font-semibold text-gray-800 mt-6">Order Items</h4>
            <div class="space-y-4 mt-4">
                @forelse ($order->orderItems as $item)
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">{{ $item->product ? $item->product->name : 'Unknown Product' }}</h4>
                            <p class="text-sm text-gray-600">${{ number_format($item->price, 2) }} x {{ $item->quantity }}</p>
                        </div>
                        <p class="text-sm font-bold text-blue-600">${{ number_format($item->price * $item->quantity, 2) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-600">No items found.</p>
                @endforelse
            </div>

            <div class="mt-6 pt-4 border-t">
                <div class="flex justify-between items-center">
                    <h4 class="text-md font-semibold text-gray-800">Total:</h4>
                    <p class="text-lg font-bold text-blue-600">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mt-10">
        <p>© {{ date('Y') }} National Care. All rights reserved.</p>
    </footer>
</x-app-layout>