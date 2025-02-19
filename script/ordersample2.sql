INSERT INTO categories 
    (id, stall_id, name, created_at, updated_at)
VALUES 
    (12, 100, 'Burgers', NOW(), NOW());

INSERT INTO products 
    (id, stall_id, category_id, name, code, description, base_price, discount, start_date, end_date, image, created_at)
VALUES 
    (27, 100, 12, 'Delight Burger', 'DB001', 'Juicy delight burger', 75.00, 0.00, NULL, NULL, 'uploads/delightburger.jpg', NOW());

-- Insert order record
INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (8, 4, 150.00, 'Cash', 'Dine In', 'Immediately', NULL, NOW());

-- Insert corresponding order_stalls record (we use id 100)
INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (100, 8, 100, 150.00, 'Pending', NOW());

-- Insert order_item record (we use id 200)
INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (200, 100, 27, NULL, 2, 75.00, 150.00, NOW());

INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (9, 4, 225.00, 'GCash', 'Take Out', 'Immediately', NULL, NOW());

INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (101, 9, 100, 225.00, 'Preparing', NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (201, 101, 27, NULL, 3, 75.00, 225.00, NOW());

INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (10, 4, 75.00, 'Cash', 'Dine In', 'Immediately', NULL, NOW());

INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (102, 10, 100, 75.00, 'Ready', NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (202, 102, 27, NULL, 1, 75.00, 75.00, NOW());

INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (11, 4, 300.00, 'GCash', 'Take Out', 'Immediately', NULL, NOW());

INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (103, 11, 100, 300.00, 'Completed', NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (203, 103, 27, NULL, 4, 75.00, 300.00, NOW());

INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (12, 4, 150.00, 'Cash', 'Dine In', 'Immediately', NULL, NOW());

INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (104, 12, 100, 150.00, 'Cancelled', NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (204, 104, 27, NULL, 2, 75.00, 150.00, NOW());

INSERT INTO orders 
    (id, user_id, total_price, payment_method, order_type, order_class, scheduled_time, created_at)
VALUES 
    (13, 4, 225.00, 'GCash', 'Take Out', 'Scheduled', '2025-02-20 12:00:00', NOW());

INSERT INTO order_stalls 
    (id, order_id, stall_id, subtotal, status, created_at)
VALUES 
    (105, 13, 100, 225.00, 'Scheduled', NOW());

INSERT INTO order_items 
    (id, order_stall_id, product_id, variation_option_id, quantity, price, subtotal, created_at)
VALUES 
    (205, 105, 27, NULL, 3, 75.00, 225.00, NOW());

