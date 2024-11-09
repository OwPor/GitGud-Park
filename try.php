<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Navigation with Active State</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles for the search menu */
        .searchmenu {
            display: flex;
            border-radius: 50px;
            padding: 5px 10px;
            border: #ccc 1px solid;
            align-items: center;
        }
        .searchmenu input {
            border: 0;
            outline: none;
            width: 170px;
        }
        .searchmenu button {
            background-color: #fff;
            border: none;
            margin-right: 8px;
            font-size: 12px;
            color: gray;
        }

        /* Styles for sticky navigation */
        .pagefilter {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .pagefilter a {
            text-decoration: none;
            color: black;
            padding: 18px 12px;
        }
        .pagefilter a:hover,
        .pagefilter a.active {
            border-bottom: 2px solid #CD5C08;
        }
        .pagefilter a i {
            color: #CD5C08;
        }

        /* Placeholder styles for sections */
        section {
            padding: 80px 20px;
            border-bottom: 1px solid #ccc;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="d-flex pagefilter align-items-center mt-4">
    <div class="d-flex align-items-center gap-3 leftfilter">
        <form action="#" method="get" class="searchmenu">
            <button type="submit"><i class="fas fa-search fa-lg"></i></button>
            <input type="text" name="search" placeholder="Search in menu">
        </form>
        <a href="#popular" class="nav-link"><i class="fa-solid fa-fire-flame-curved"></i> Popular</a>
        <a href="#new" class="nav-link"><i class="fa-solid fa-ribbon"></i> New</a>
        <a href="#promo" class="nav-link"><i class="fa-solid fa-percent"></i> Promo</a>
    </div>
    <div class="d-flex rightfilter gap-3">
        <a href="#category1" class="nav-link">Category 1</a>
        <a href="#category2" class="nav-link">Category 2</a>
        <a href="#category3" class="nav-link">Category 3</a>
    </div>
</div>

<section id="popular">
    <h5>Popular</h5>
    <p>Content for the popular section...</p>
</section>
<section id="new">
    <h5>New</h5>
    <p>Content for the new section...</p>
</section>
<section id="promo">
    <h5>Promo</h5>
    <p>Content for the promo section...</p>
</section>
<section id="category1">
    <h5>Category 1</h5>
    <p>Content for category 1...</p>
</section>
<section id="category2">
    <h5>Category 2</h5>
    <p>Content for category 2...</p>
</section>
<section id="category3">
    <h5>Category 3</h5>
    <p>Content for category 3...</p>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.pagefilter a');
        const sections = document.querySelectorAll('section');

        // Smooth scroll to section on link click
        links.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const targetSection = document.querySelector(this.getAttribute('href'));
                window.scrollTo({
                    top: targetSection.offsetTop - document.querySelector('.pagefilter').offsetHeight,
                    behavior: 'smooth'
                });
            });
        });

        // Update active link on scroll
        window.addEventListener('scroll', function () {
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - document.querySelector('.pagefilter').offsetHeight - 10;
                if (window.pageYOffset >= sectionTop) {
                    currentSection = section.getAttribute('id');
                }
            });

            links.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').substring(1) === currentSection) {
                    link.classList.add('active');
                }
            });
        });
    });
</script>

</body>
</html>
