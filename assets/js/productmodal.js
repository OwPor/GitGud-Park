document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('menumodal');
    const modalTitle = modal.querySelector('.card-title'); // Product name
    const modalDescription = modal.querySelector('.card-text.text-muted.m-0'); // Product description
    const modalPrice = modal.querySelector('.proprice'); // Product price
    const modalImage = modal.querySelector('.card-img-top'); // Product image

    document.querySelectorAll('.card-link').forEach(card => {
        card.addEventListener('click', () => {
            const name = card.getAttribute('data-name');
            const description = card.getAttribute('data-description');
            const price = card.getAttribute('data-price');
            const image = card.getAttribute('data-image');

            modalTitle.textContent = name;
            modalDescription.textContent = description;
            modalPrice.textContent = `₱${price}`;
            modalImage.src = image;
        });
    });
});
