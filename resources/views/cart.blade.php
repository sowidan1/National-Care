<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold mb-6">Cart</h2>

        <!-- Cart items from local storage -->
        <div id="cart-items" class="space-y-6">
            <!-- Cart items will be dynamically inserted here -->
        </div>

        <!-- Empty cart message -->
        <div id="empty-cart" class="hidden text-center text-gray-600 text-lg mt-10">
            Your cart is empty. <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Shop now</a>.
        </div>

        <!-- Cart summary -->
        <div id="cart-summary" class="mt-8 bg-white rounded-2xl shadow-sm p-6 border hidden">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Total:</h3>
                <p id="cart-total" class="text-lg font-bold text-blue-600">$0.00</p>
            </div>
            <button id="checkout-btn" data-checkout-url="{{ route('checkout') }}"
                class="mt-4 w-full bg-blue-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Proceed to Checkout
            </button>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mt-10">
        <p>© {{ date('Y') }} National Care. All rights reserved.</p>
    </footer>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/cart-page.js') }}"></script>
</x-app-layout>