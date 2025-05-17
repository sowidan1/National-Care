<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order List</h2>

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
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Str::limit($order->id, 10) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->full_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($order->status) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.orders.index') }}?view_order={{ $order->id }}" class="text-blue-600 hover:text-blue-800">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-600">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- View Order Modal -->
        @if (isset($viewOrder))
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Details - {{ Str::limit($viewOrder->id, 10) }}</h3>
                    <div class="space-y-4">
                        <p><strong>Order ID:</strong> {{ $viewOrder->id }}</p>
                        <p><strong>Customer:</strong> {{ $viewOrder->full_name }}</p>
                        <p><strong>Phone:</strong> {{ $viewOrder->phone }}</p>
                        <p><strong>Address:</strong> {{ $viewOrder->address }}</p>
                        <p><strong>Date:</strong> {{ $viewOrder->date }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($viewOrder->payment_method) }}</p>
                    </div>

                    <h4 class="text-md font-semibold text-gray-800 mt-6">Order Items</h4>
                    <div class="space-y-4 mt-4">
                        @forelse ($viewOrder->orderItems as $item)
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
                            <p class="text-lg font-bold text-blue-600">${{ number_format($viewOrder->total, 2) }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-800">Close</a>
                    </div>
                </div>
            </div>
        @endif
    </main>
</x-app-layout>
