<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Admin Dashboard</h2>

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

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800">Total Products</h3>
                <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Product::count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800">Pending Orders</h3>
                <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Order::where('status', 'pending')->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800">Categories</h3>
                <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Category::count() }}</p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Manage Resources</h3>
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('admin.products.index') }}" class="bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center">
                    Manage Products
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center">
                    Manage Categories
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center">
                    Manage Orders
                </a>
            </div>
        </div>
    </main>
</x-app-layout>
