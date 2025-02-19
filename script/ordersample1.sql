INSERT INTO stalls 
    (id, user_id, name, description, email, phone, website, logo, created_at, updated_at, park_id)
VALUES 
    (100, 4, 'Food Paradise', 'Best food in town', 'contact@foodparadise.com', '1234567890', 'www.foodparadise.com', 'stall101.jpg', NOW(), NOW(), 1);

INSERT INTO products 
    (id, stall_id, category_id, name, code, description, base_price, discount, start_date, end_date, image, created_at)
VALUES 
    (1, 100, 1, 'Pizza', 'PZ001', 'Delicious cheese pizza', 20.00, 0.00, NULL, NULL, 'pizza.jpg', NOW());

INSERT INTO products 
    (id, stall_id, category_id, name, code, description, base_price, discount, start_date, end_date, image, created_at)
VALUES 
    (2, 100, 1, 'Burger', 'BG001', 'Juicy beef burger', 15.00, 0.00, NULL, NULL, 'burger.jpg', NOW());

INSERT INTO product_variations 
    (id, product_id, name)
VALUES 
    (1, 1, 'Large Size');

INSERT INTO variation_options 
    (id, variation_id, name, add_price, subtract_price, image)
VALUES 
    (1, 1, 'Extra Cheese', 5.00, 0.00, 'extra_cheese.jpg');

INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (1, 4, 55.00, 'Cash', 'Take Out', 'Immediately', NULL, NOW());

INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (1, 1, 100, 55.00, 'Pending', NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (1, 1, 1, 1, 2, 20.00, 40.00, NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (2, 1, 2, NULL, 1, 15.00, 15.00, NOW());

SELECT 
    o.id AS order_id,
    o.total_price,
    o.payment_method,
    o.order_type,
    o.order_class,
    o.scheduled_time,
    o.created_at AS order_date,
    p.image AS file_path,
    p.description AS product_description,
    p.name AS food_name,
    s.name AS food_stall_name,
    CASE 
        WHEN oi.variation_option_id IS NOT NULL THEN pv.name
        ELSE 'No variations'
    END AS variation_details
FROM orders o
JOIN order_stalls os ON os.order_id = o.id
JOIN stalls s ON s.id = os.stall_id
JOIN order_items oi ON oi.order_stall_id = os.id
JOIN products p ON p.id = oi.product_id
LEFT JOIN variation_options vo on vo.id = oi.variation_option_id
LEFT JOIN product_variations pv on vo.variation_id = pv.id
WHERE o.user_id = 1
ORDER BY s.name ASC, o.created_at DESC;

