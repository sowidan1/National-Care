document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartMessage = document.getElementById('empty-cart');
    const cartTotal = document.getElementById('cart-total');
    const checkoutForm = document.getElementById('checkout-form');

    // Function to render cart items
    function renderCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            emptyCartMessage.classList.remove('hidden');
            cartItemsContainer.parentElement.classList.add('hidden');
            checkoutForm.classList.add('hidden');
            return;
        }

        emptyCartMessage.classList.add('hidden');
        cartItemsContainer.parentElement.classList.remove('hidden');
        checkoutForm.classList.remove('hidden');

        cart.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'flex justify-between items-center';
            itemElement.innerHTML = `
                <div class="flex items-center gap-4">
                    <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-lg"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/64x64?text=No+Image';">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800">${item.name}</h4>
                        <p class="text-sm text-gray-600">$${item.price.toFixed(2)} x ${item.quantity}</p>
                    </div>
                </div>
                <p class="text-sm font-bold text-blue-600">$${(item.price * item.quantity).toFixed(2)}</p>
            `;
            cartItemsContainer.appendChild(itemElement);
        });

        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }

    // Handle form submission
    checkoutForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Empty Cart',
                text: 'Your cart is empty. Please add items before checking out.',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        const formData = new FormData(checkoutForm);
        const orderData = {
            full_name: formData.get('full_name'),
            phone: formData.get('phone'),
            address: formData.get('address'),
            items: cart,
            _token: formData.get('_token')
        };

        try {
            const response = await fetch(checkoutForm.dataset.storeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(orderData)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Failed to place order');
            }

            // Clear cart
            localStorage.removeItem('cart');

            Swal.fire({
                icon: 'success',
                title: 'Order Placed!',
                text: 'Your order has been successfully placed.',
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-end',
                background: '#f0fdf4',
                iconColor: '#16a34a'
            }).then(() => {
                // Store last order in localStorage for confirmation page
                localStorage.setItem('lastOrder', JSON.stringify({
                    id: result.order_id,
                    full_name: orderData.full_name,
                    phone: orderData.phone,
                    address: orderData.address,
                    items: orderData.items,
                    total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0),
                    date: new Date().toISOString()
                }));
                window.location.href = checkoutForm.dataset.confirmationUrl;
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'An error occurred while placing your order.',
                confirmButtonColor: '#3085d6'
            });
        }
    });

    // Initial render
    renderCart();
});