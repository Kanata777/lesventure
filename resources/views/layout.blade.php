<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Lesventure</title>
    <link rel="stylesheet" href="/bulma-1.0.4/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>
        /* Hero Section */
        .hero-custom {
            background: url('/image/bgpict2.jpg') center center / cover no-repeat;
            height: 70vh;
            display: flex;
            align-items: center;
        }

        .hero-custom .hero-body {
            padding: 2rem 1.5rem;
        }

        .hero-custom h1.title {
            margin-top: 3rem;
            margin-bottom: 1rem;
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        .hero-custom h2.subtitle {
            font-size: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title-animate {
            animation: fadeInDown 0.6s ease-out 0.5s both;
        }

        .subtitle-animate {
            animation: fadeInUp 1s ease-out 1s both;
        }

        /* Fitur Utama */
        .feature-box {
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            transform: scale(1);
            will-change: transform;
            /* Optimasi performa */
            cursor: pointer;
            position: relative;
            /* Tambahkan ini */
            z-index: 1;
            /* Pastikan di atas elemen lain */
        }

        .feature-box:hover {
            transform: scale(1.08) !important;
            /* Gunakan !important sementara untuk testing */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
            z-index: 10;
        }

        .icon-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            transition: all 0.3s ease;
        }

        .feature-box:hover .icon-wrapper {
            transform: scale(2.0);
        }

        .has-text-black {
            color: #000 !important;
        }

        /* Animasi Tombol */
        .animated-button {
            border: none;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .animated-button:hover {
            transform: scale(1.05);
            z-index: 10;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .animated-button:active {
            transform: scale(0.95);
        }

        .animated-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.5);
        }

        .fadeInUp {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Produk Populer */
        #produk h2.title {
            font-family: 'Arial Black', Arial, sans-serif;
            font-size: 2rem;
        }

        .product-box h3.title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            color: black;
        }

        .product-box p {
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.9rem;
            color: black;
        }

        .product-box .button {
            font-family: 'Verdana', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: #000;
        }

        .product-box img {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product-box:hover {
            transform: scale(1.03) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
            z-index: 2;
        }

        .product-box:hover img {
            transform: scale(1.1) !important;
        }

        .product-box {
            transition: all 0.3s ease;
            will-change: transform;
        }

        /* Carousel */
        .carousel {
            overflow: hidden;
            position: relative;
            width: 100%;
            max-height: 300px;
            margin-bottom: 2rem;
        }

        .carousel-container {
            display: flex;
            width: 300%;
            animation: slide 15s infinite;
        }

        .carousel-item {
            width: 100%;
            flex-shrink: 0;
        }

        .carousel-item img {
            width: 100%;
            object-fit: cover;
            height: 300px;
            border-radius: 10px;
        }

        @keyframes slide {
            0% {
                transform: translateX(0%);
            }

            33% {
                transform: translateX(-100%);
            }

            66% {
                transform: translateX(-200%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        /* Hero Section */
        .hero-products {
            background: linear-gradient(rgba(0, 0, 0, 0.5));
            height: 300px;
            display: flex;
            align-items: center;
            margin-bottom: 3rem;
        }

        /* Filter Section */
        .filter-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .filter-title {
            font-weight: 600;
            font-size: 1.25rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .filter-category {
            margin-bottom: 1.5rem;
        }

        .category-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }

        .filter-item {
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            display: block;
            color: #4a4a4a;
        }

        .filter-price {
            margin-left: 1rem;
            color: #3273dc;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .filter-item:hover {
            color: #3273dc;
            transform: translateX(5px);
        }

        /* Product Cards */
        .product-card {
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .product-card .card-content {
            padding: 1.25rem;
        }

        .product-card .title {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .product-card:hover .image img {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .columns {
                flex-direction: column;
            }

            .filter-column {
                margin-bottom: 2rem;
            }
        }
    </style>

    <style>
        /* Hero Section */
        .hero-products {
            background: linear-gradient(rgba(0, 0, 0, 0.5), url('/image/bgpict2.jpg') center center/cover no-repeat);
            height: 300px;
            display: flex;
            align-items: center;
            margin-bottom: 3rem;
        }

        /* Product Card Hover Effects */
        .product-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            z-index: 1;
            background: white;
        }

        .product-card:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }

        .product-card:hover img {
            transform: scale(1.1) !important;
        }

        .product-card .card-content {
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .product-card:hover .card-content {
            background-color: #f9f9f9;
        }

        /* Filter Section */
        .filter-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .filter-title {
            font-weight: 600;
            font-size: 1.25rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .filter-category {
            margin-bottom: 1.5rem;
        }

        .category-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }

        .filter-item {
            margin-left: 1rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            display: block;
            color: #4a4a4a;
        }

        .filter-item:hover {
            color: #3273dc;
            transform: translateX(5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .columns {
                flex-direction: column;
            }

            .filter-column {
                margin-bottom: 2rem;
            }

            .product-card:hover {
                transform: scale(1.03) !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        @yield('konten')
    </div>

    <script>
        window.addEventListener('load', () => {
            const buttons = document.querySelectorAll('.animated-button');
            buttons.forEach((btn, index) => {
                btn.style.animationDelay = `${0.2 * index}s`;
                btn.classList.add('fadeInUp');
            });
        });

        function handleClick(element) {
            element.style.transform = 'scale(0.95)';
            setTimeout(() => {
                element.style.transform = 'scale(1.08)';
            }, 100);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Animasi saat halaman dimuat
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Add animation when page loads
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px) scale(0.95)';
                card.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
            });
        });
    </script>
</body>

</html>