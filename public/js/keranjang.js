document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

    // Mode default
    if (localStorage.getItem('theme') === 'dark') {
        html.classList.add('dark');
        themeIcon.classList.replace('bx-sun', 'bx-moon');
    }

    // Toggle mode gelap/terang
    themeToggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        if (html.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            themeIcon.classList.replace('bx-sun', 'bx-moon');
        } else {
            localStorage.setItem('theme', 'light');
            themeIcon.classList.replace('bx-moon', 'bx-sun');
        }
    });

    // Menambah dan mengurangi kuantitas produk di keranjang
    const incrementButtons = document.querySelectorAll('.increment');
    const decrementButtons = document.querySelectorAll('.decrement');

    incrementButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productElement = e.target.closest('.product');
            const quantityElement = productElement.querySelector('.quantity');
            let quantity = parseInt(quantityElement.textContent);
            quantity++;
            quantityElement.textContent = quantity;

            // Update hidden quantity input form
            const quantityInput = productElement.querySelector('.quantity-input');
            quantityInput.value = quantity;

            // Update subtotal
            const price = parseFloat(productElement.dataset.price);
            const subtotalElement = productElement.querySelector('.subtotal');
            subtotalElement.textContent = `Rp.${(quantity * price).toFixed(2)}`;

            // Optionally, submit the form automatically (if desired)
            productElement.querySelector('form').submit();
        });
    });

    decrementButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productElement = e.target.closest('.product');
            const quantityElement = productElement.querySelector('.quantity');
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                quantity--;
                quantityElement.textContent = quantity;

                // Update hidden quantity input form
                const quantityInput = productElement.querySelector('.quantity-input');
                quantityInput.value = quantity;

                // Update subtotal
                const price = parseFloat(productElement.dataset.price);
                const subtotalElement = productElement.querySelector('.subtotal');
                subtotalElement.textContent = `Rp.${(quantity * price).toFixed(2)}`;

                // Optionally, submit the form automatically (if desired)
                productElement.querySelector('form').submit();
            }
        });
    });
});
