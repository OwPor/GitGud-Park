<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Flash Deal UI</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
        }
        .product-card {
            width: 250px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .product-image {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .rating {
            color: #f0a500;
            font-size: 14px;
            margin: 10px 0;
        }
        .discount-badge {
            display: inline-flex;
            align-items: center;
            padding: 2px 6px;
            background-color: #ffeaa7;
            color: #d63031;
            font-size: 12px;
            font-weight: bold;
            border-radius: 4px;
            margin-bottom: 8px;
        }
        .discount-badge img {
            width: 12px;
            margin-right: 4px;
        }
        .price-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .original-price {
            color: #888;
            font-size: 14px;
            text-decoration: line-through;
        }
        .current-price {
            color: #e74c3c;
            font-size: 24px;
            font-weight: bold;
        }
        .selling-fast {
            display: inline-block;
            padding: 6px 12px;
            background-color: #f39c12;
            color: white;
            font-size: 12px;
            font-weight: bold;
            border-radius: 20px;
            margin-top: 10px;
        }
        .buy-now {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="product-card">
        <img src="https://via.placeholder.com/250x150" alt="Product Image" class="product-image">
        
        <div class="rating">
            ★★★★★
        </div>

        <div class="discount-badge">
            <img src="https://img.icons8.com/emoji/48/000000/high-voltage.png" alt="Flash Icon" width="12">
            -75%
        </div>

        <div class="price-container">
            <span class="original-price">₱408</span>
            <span class="current-price">₱103</span>
        </div>

        <div class="selling-fast">SELLING FAST</div>

        <a href="#" class="buy-now">Buy Now</a>
    </div>
</body>
</html>
