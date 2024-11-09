document.querySelectorAll('.pagefilter a.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault(); 

        document.querySelectorAll('.pagefilter a.nav-link').forEach(link => link.classList.remove('active'));

        this.classList.add('active');

        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);

        const offsetTop = targetSection.getBoundingClientRect().top + window.pageYOffset - document.querySelector('.pagefilter').offsetHeight;

        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const rightFilter = document.querySelector('.rightfilter');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');
    const scrollAmount = 100; // Adjust scroll distance as needed

    // Check the scroll position to toggle arrow visibility
    function updateArrows() {
        leftArrow.style.display = rightFilter.scrollLeft > 0 ? 'flex' : 'none';
        rightArrow.style.display =
            rightFilter.scrollLeft < rightFilter.scrollWidth - rightFilter.clientWidth
                ? 'flex'
                : 'none';
    }

    // Scroll right when the right arrow is clicked
    rightArrow.addEventListener('click', () => {
        rightFilter.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });

    // Scroll left when the left arrow is clicked
    leftArrow.addEventListener('click', () => {
        rightFilter.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    // Update arrows on initial load and after scrolling
    updateArrows();
    rightFilter.addEventListener('scroll', updateArrows);
});
