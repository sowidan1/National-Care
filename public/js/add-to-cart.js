document.addEventListener('DOMContentLoaded', () => {
    // Get all Add to Cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    // Add click event listener to each button
    addToCartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            // Get product data from data attributes
            const product = {
                id: button.dataset.id,
                name: button.dataset.name,
                price: parseFloat(button.dataset.price),
                image: button.dataset.image,
                quantity: 1
            };

            // Get existing cart from localStorage or initialize empty array
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Check if product already exists in cart
            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                // If product exists, increment quantity
                cart[existingProductIndex].quantity += 1;
            } else {
                // If product doesn't exist, add it to cart
                cart.push(product);
            }

            // Save updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Show SweetAlert2 notification
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart!',
                text: `${product.name} has been added to your cart.`,
                showConfirmButton: false,
                timer: 1500,
                toast: true,
                position: 'top-end',
                background: '#f0fdf4',
                iconColor: '#16a34a',
                customClass: {
                    title: 'text-gray-800 font-semibold',
                    content: 'text-gray-600'
                }
            });
        });
    });
});