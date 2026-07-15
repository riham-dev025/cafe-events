document.addEventListener('DOMContentLoaded', () => {
    // 1. Listen for any form submission on the page
    document.addEventListener('submit', function (event) {
        const form = event.target;

        // Only intercept if the form has our specific cart class
        if (!form.classList.contains('ajax-cart-form')) return;

        // 2. Prevent the page from refreshing
        event.preventDefault();

        // Disable the button so the user can't double-click it while loading
        const submitButton = form.querySelector('[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.dataset.originalText = submitButton.innerHTML;
            submitButton.innerHTML = 'Adding...'; // Friendly loading state
        }

        const url = form.action;
        const formData = new FormData(form);

        // 3. Send the request to Laravel
        fetch(url, {
            method: 'POST',
            headers: {
                // Grab the token from the meta tag we added in Phase A
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // 4. Update the cart badge count in your header (No refresh!)
                const cartBadge = document.querySelector('.cart-count-badge');
                if (cartBadge && data.cart_count !== undefined) {
                    cartBadge.textContent = data.cart_count;
                }

                // Optional: Show a quick success alert/notification
                alert(data.message || 'Added to cart!');
            } else {
                alert(data.message || 'Failed to add item to cart.');
            }
        })
        .catch(error => {
            console.error('AJAX Error:', error);
            alert('Something went wrong. Please try again.');
        })
        .finally(() => {
            // Re-enable the button when done
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.innerHTML = submitButton.dataset.originalText;
            }
        });
    });
});