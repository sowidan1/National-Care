document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartMessage = document.getElementById('empty-cart');
    const cartSummary = document.getElementById('cart-summary');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');

    // Function to render cart items
    function renderCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Clear current items
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            emptyCartMessage.classList.remove('hidden');
            cartSummary.classList.add('hidden');
            return;
        }

        emptyCartMessage.classList.add('hidden');
        cartSummary.classList.remove('hidden');

        // Render each cart item
        cart.forEach((item, index) => {
            const itemElement = document.createElement('div');
            itemElement.className = 'bg-white rounded-2xl shadow-sm border p-4 flex items-center gap-4';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="w-24 h-24 object-cover rounded-lg"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/100x100?text=No+Image';">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800">${item.name}</h3>
                    <p class="text-sm text-gray-600">$${item.price.toFixed(2)} each</p>
                    <div class="flex items-center gap-2 mt-2">
                        <button class="decrease-qty text-gray-600 hover:text-gray-800" data-index="${index}">-</button>
                        <input type="number" class="quantity-input w-16 text-center border rounded-lg" value="${item.quantity}" min="1" data-index="${index}">
                        <button class="increase-qty text-gray-600 hover:text-gray-800" data-index="${index}">+</button>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-blue-600">$${(item.price * item.quantity).toFixed(2)}</p>
                    <button class="remove-item text-red-600 hover:text-red-800 text-sm mt-2" data-index="${index}">Remove</button>
                </div>
            `;
            cartItemsContainer.appendChild(itemElement);
        });

        // Update total
        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        cartTotal.textContent = `$${total.toFixed(2)}`;
    }

    // Function to update cart in localStorage
    function updateCart(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }

    // Event delegation for cart interactions
    cartItemsContainer.addEventListener('click', (e) => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const index = e.target.dataset.index;

        if (e.target.classList.contains('remove-item')) {
            Swal.fire({
                title: 'Remove Item',
                text: 'Are you sure you want to remove this item from your cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    cart.splice(index, 1);
                    updateCart(cart);
                    Swal.fire({
                        icon: 'success',
                        title: 'Removed!',
                        text: 'Item has been removed from your cart.',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end',
                        background: '#f0fdf4',
                        iconColor: '#16a34a'
                    });
                }
            });
        }

        if (e.target.classList.contains('increase-qty')) {
            cart[index].quantity += 1;
            updateCart(cart);
        }

        if (e.target.classList.contains('decrease-qty')) {
            if (cart[index].quantity > 1) {
                cart[index].quantity -= 1;
                updateCart(cart);
            }
        }
    });

    // Handle quantity input change
    cartItemsContainer.addEventListener('change', (e) => {
        if (e.target.classList.contains('quantity-input')) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const index = e.target.dataset.index;
            const newQuantity = parseInt(e.target.value);

            if (newQuantity >= 1) {
                cart[index].quantity = newQuantity;
                updateCart(cart);
            } else {
                e.target.value = cart[index].quantity; // Revert to previous value
            }
        }
    });

    // Handle checkout button click
    checkoutBtn.addEventListener('click', () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Empty Cart',
                text: 'Your cart is empty. Please add items before proceeding to checkout.',
                confirmButtonColor: '#3085d6'
            });
        } else {
            const checkoutUrl = checkoutBtn.dataset.checkoutUrl;
            window.location.href = checkoutUrl;
        }
    });

    // Initial render
    renderCart();
});