<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-2xl font-semibold mb-6">Order Confirmation</h2>

        <div id="order-confirmation" class="bg-white rounded-2xl shadow-sm border p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Thank You for Your Order!</h3>
            <p class="text-gray-600 mb-6">Your order has been successfully placed. You'll receive a confirmation soon.</p>

            <!-- Order Details -->
            <div id="order-details" class="space-y-4">
                <!-- Order details will be dynamically inserted here -->
            </div>

            <!-- Order Items -->
            <h4 class="text-md font-semibold text-gray-800 mt-6">Order Items</h4>
            <div id="order-items" class="space-y-4 mt-4">
                <!-- Order items will be dynamically inserted here -->
            </div>

            <!-- Order Total -->
            <div class="mt-6 pt-4 border-t">
                <div class="flex justify-between items-center">
                    <h4 class="text-md font-semibold text-gray-800">Total:</h4>
                    <p id="order-total" class="text-lg font-bold text-blue-600">$0.00</p>
                </div>
            </div>
        </div>

        <!-- No order message -->
        <div id="no-order" class="hidden text-center text-gray-600 text-lg mt-10">
            No order found. <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Shop now</a>.
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mt-10">
        <p>© {{ date('Y') }} National Care. All rights reserved.</p>
    </footer>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/order-confirmation.js') }}"></script>
</x-app-layout>