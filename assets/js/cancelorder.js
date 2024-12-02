document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.cancelorder').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-product-id'); // Get the product ID from the button

            if (confirm('Are you sure you want to cancel this item?')) {
                // Send AJAX request to cancel the product in the cart
                fetch('./cancel-cart-item.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ product_id: productId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item canceled successfully!');
                        // Optionally, refresh the page or update the UI
                        location.reload();
                    } else {
                        alert('Failed to cancel the item: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while canceling the item.');
                });
            }
        });
    });
});