<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold mb-6">Checkout</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Summary -->
            <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                <div id="cart-items" class="space-y-4">
                    <!-- Cart items will be dynamically inserted here -->
                </div>
                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-between items-center">
                        <h4 class="text-md font-semibold text-gray-800">Total:</h4>
                        <p id="cart-total" class="text-lg font-bold text-blue-600">$0.00</p>
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Delivery Information</h3>
                <form id="checkout-form" data-store-url="{{ route('orders.store') }}" data-confirmation-url="{{ route('order.confirmation') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="full_name" name="full_name" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                        <textarea id="address" name="address" required rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Place Order
                    </button>
                </form>
            </div>
        </div>

        <!-- Empty cart message -->
        <div id="empty-cart" class="hidden text-center text-gray-600 text-lg mt-10">
            Your cart is empty. <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Shop now</a>.
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mt-10">
        <p>© {{ date('Y') }} National Care. All rights reserved.</p>
    </footer>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
</x-app-layout>