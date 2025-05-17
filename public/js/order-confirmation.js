document.addEventListener('DOMContentLoaded', () => {
    const orderConfirmation = document.getElementById('order-confirmation');
    const noOrderMessage = document.getElementById('no-order');
    const orderDetails = document.getElementById('order-details');
    const orderItems = document.getElementById('order-items');
    const orderTotal = document.getElementById('order-total');

    // Get last order from localStorage
    const order = JSON.parse(localStorage.getItem('lastOrder'));

    if (!order) {
        orderConfirmation.classList.add('hidden');
        noOrderMessage.classList.remove('hidden');
        return;
    }

    orderConfirmation.classList.remove('hidden');
    noOrderMessage.classList.add('hidden');

    // Render order details
    orderDetails.innerHTML = `
        <p><strong>Order ID:</strong> ${order.id}</p>
        <p><strong>Name:</strong> ${order.full_name}</p>
        <p><strong>Phone:</strong> ${order.phone}</p>
        <p><strong>Delivery Address:</strong> ${order.address}</p>
        <p><strong>Date:</strong> ${new Date(order.date).toLocaleString()}</p>
    `;

    // Render order items
    order.items.forEach(item => {
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
        orderItems.appendChild(itemElement);
    });

    // Render total
    orderTotal.textContent = `$${order.total.toFixed(2)}`;
});