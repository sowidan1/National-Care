<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold mb-6">All Products</h2>

        {{-- GRID WRAPPER to arrange products in rows --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 border group flex flex-col">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                        loading="lazy">
                    <div class="absolute top-2 left-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">
                        In Stock
                    </div>
                </div>

                <div class="flex flex-col justify-between flex-grow p-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-lg font-bold text-blue-600">${{ number_format($product->price, 2) }}</p>
                        <p class="text-xs text-gray-500 mt-1">Category: {{ $product->category->name }}</p>
                    </div>

                    <button
                        class="add-to-cart-btn mt-4 bg-blue-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                        data-image="{{ $product->image_url }}"
                    >
                        Add to Cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 mb-4 flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </main>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>

</x-app-layout>
