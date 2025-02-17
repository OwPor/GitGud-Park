-- Stall Management System of Amethyst Food Park
DROP DATABASE IF EXISTS gitgud;

CREATE DATABASE gitgud;

USE gitgud;

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` char(255) NOT NULL,
  `birth_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `role` enum('Customer','Park Owner','Stall Owner','Admin') NOT NULL DEFAULT 'Customer',
  `profile_img` varchar(255) DEFAULT 'assets/images/profile.jpg',
  `user_session` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `sex`, `phone`, `password`, `birth_date`, `status`, `role`, `profile_img`, `user_session`, `created_at`, `updated_at`) VALUES
(1, 'Alvarez', 'April', 'aprilalvarez@gmail.com', 'male', '9056321314', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6', '2003-12-04', 'Active', 'Stall Owner', 'assets/images/profile.jpg', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6', '2025-01-31 10:31:43', '2025-02-10 02:10:55'),
(2, 'Luzon', 'Alfaith', 'alfaithluzon@gmail.com', 'male', '9123456789', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6\r\n', '2003-12-04', 'Active', 'Customer', 'assets/images/profile.jpg', NULL, '2025-02-10 01:57:20', '2025-02-10 01:58:29'),
(3, 'Haliluddin', 'Naila', 'tomatoregional@soscandia.org', 'male', '9554638281', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6', '2003-12-04', 'Active', 'Park Owner', 'assets/images/profile.jpg', 'c7b8409f0f64251c23625859f9982068667d64c0a768bdace4034f7975a900496727629247e450d1f849214bfff0a426ebbf7af9868a5d0f90bc98d209b5173961bc3c5d3ea35ea8779dc3f97952654e55d36bb7b05d', '2025-01-26 15:50:02', '2025-02-10 01:50:27');


CREATE TABLE `verification` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `verification_token` varchar(255) NOT NULL,
  `token_expiration` datetime NOT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `last_sent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `verification` (`user_id`, `verification_token`, `token_expiration`, `is_verified`, `last_sent`) VALUES
(1, '679494f216b71', '2025-01-26 08:38:26', 1, '1737790706'),
(2, '6796581b7f52d', '2025-01-27 16:43:23', 1, '1737906203'),
(3, '679659aa92ce1', '2025-01-27 16:50:02', 1, '1737906602');


CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_type` varchar(100) NOT NULL,
  `region_province_city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street_building_house` varchar(100) NOT NULL,
  `business_phone` varchar(20) NOT NULL,
  `business_email` varchar(100) NOT NULL,
  `business_permit` varchar(255) NOT NULL,
  `business_status` enum('Approved','Rejected','Pending Approval') NOT NULL DEFAULT 'Pending Approval',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_logo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `business` (`id`, `user_id`, `business_name`, `business_type`, `region_province_city`, `barangay`, `street_building_house`, `business_phone`, `business_email`, `business_permit`, `business_status`, `created_at`, `updated_at`, `business_logo`, `url`) VALUES
(1, 1, 'Sample lang po', 'Food Park', 'Sample', 'Sample', 'Sample', '9554638281', 'hnailataji@gmail.com', 'image.jpg', 'Approved', '2025-02-06 12:12:25', '2025-02-06 12:12:25', 'image.jpg', 'Sample'),
(52, 3, 'Sample', 'Food Park', 'Mindanao, Zamboanga Del Sur, Zamboanga City', 'Sample', 'Sample', '9554638281', 'tomatoregional@soscandia.org', 'uploads/business/permit_67a95b63980837.26890848.jpg', 'Approved', '2025-02-10 01:50:27', '2025-02-10 01:50:57', 'uploads/business/logo_67a95b639859d7.31524292.jpg', '67a95b639dfd9');

CREATE TABLE `operating_hours` (
  `id` int(11) NOT NULL,
  `days` varchar(255) DEFAULT NULL,
  `open_time` varchar(10) DEFAULT NULL,
  `close_time` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `operating_hours` (`id`, `days`, `open_time`, `close_time`, `created_at`, `business_id`) VALUES
(34, 'Monday, Tuesday, Wednesday, Thursday, Friday', '01:00 AM', '01:00 PM', '2025-02-10 01:50:27', 52),
(35, 'Saturday, Sunday', '07:00 AM', '07:00 PM', '2025-02-10 01:50:27', 52);

CREATE TABLE `stalls` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `park_id` int(11) NOT NULL,
  `payment_method` enum('Cash','GCash') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `stalls` (`id`, `user_id`, `name`, `description`, `email`, `phone`, `website`, `logo`, `created_at`, `updated_at`, `park_id`, `payment_method`) VALUES
(107, 1, 'Sample', 'Sample', 'hnailataji@gmail.com', '9554638281', 'Sample', 'uploads/business/stall_67a9602faa65c6.90135347.jpg', '2025-02-10 02:10:55', '2025-02-10 02:10:55', 52, 'Cash');


CREATE TABLE `stall_categories` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `stall_categories` (`id`, `stall_id`, `name`) VALUES
(32, 107, 'Drinks'),
(33, 107, 'Vegetables');

CREATE TABLE `stall_operating_hours` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `days` varchar(255) NOT NULL,
  `open_time` varchar(10) NOT NULL,
  `close_time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `stall_operating_hours` (`id`, `stall_id`, `days`, `open_time`, `close_time`) VALUES
(40, 107, 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday', '01:00 AM', '01:00 PM');

CREATE TABLE `stall_payment_methods` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `stall_payment_methods` (`id`, `stall_id`, `method`) VALUES
(26, 107, 'Cash'),
(27, 107, 'GCash');


CREATE TABLE categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    stall_id INT UNSIGNED NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    stock_warn INT UNSIGNED NOT NULL DEFAULT 0,
    discount DECIMAL(10, 2) DEFAULT 0.00,
    discount_type ENUM('Percentage', 'Fixed') DEFAULT 'Percentage',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (stall_id) REFERENCES stalls(id) ON DELETE CASCADE
);

CREATE TABLE variation_types (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,  -- e.g., "Size", "Color", "Spice Level"
    is_required BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_variation_type (product_id, name)
);

CREATE TABLE product_variants (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    variation_type_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,  -- e.g., "Large", "Red", "Extra Spicy"
    additional_price DECIMAL(10, 2) DEFAULT 0.00,
    subtract_price DECIMAL(10, 2) DEFAULT 0.00,
    image_path VARCHAR(255),
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (variation_type_id) REFERENCES variation_types(id) ON DELETE CASCADE,
    UNIQUE KEY unique_variant (variation_type_id, name)
);
z
CREATE TABLE cart(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    stall_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_session) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (stall_id) REFERENCES stalls(id) ON DELETE CASCADE
);


-- INSERT INTO categories (name) VALUES ('Main Course');

-- INSERT INTO categories (name) VALUES ('Dessert');

-- INSERT INTO categories (name) VALUES ('Drinks');

-- INSERT INTO products (name, code, description, price, category_id, stall_id, file_path) VALUES ('Adobo', 'AD001', 'A Filipino dish that is made of pork or chicken.', 100.00, 1, 1, 'uploads/images/adobo.jpg');

-- UPDATE users SET role = 'Stall' WHERE id = 1;

-- INSERT INTO business (user_id, business_name, business_type, region_province_city, barangay, street_building_house, business_phone, business_email) VALUES (1, "HEY PARK", "Food Park", "ZC", "S", "ST", 999, "aa@#gmailc.om");




-- CREATE TABLE orders (
--     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     user_id VARCHAR(255) NOT NULL,
--     total_amount DECIMAL(10, 2) NOT NULL,
--     status ENUM('Pending', 'Preparing', 'Ready', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     FOREIGN KEY (user_id) REFERENCES users(user_session) ON DELETE CASCADE
-- );


-- NEW ORDERS TABLE
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    order_id VARCHAR(50) NOT NULL,
    food_stall_name VARCHAR(100) NOT NULL,
    food_name VARCHAR(100) NOT NULL,
    variant_id INT UNSIGNED,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status ENUM ('Cart', 'ToPay', 'Preparing', 'ToReceive', 'Completed', 'Cancelled', 'Scheduled') NOT NULL DEFAULT 'Cart',
    order_date DATETIME NOT NULL
);

-- Insert sample orders
INSERT INTO orders (
    user_id, 
    product_id,
    order_id, 
    food_stall_name, 
    food_name, 
    variant_id, 
    quantity, 
    price, 
    payment_method, 
    status, 
    order_date
) VALUES 
('1', 1, 'ORD001', 'YumYim', 'Adobo', '2', 2, 200.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),
('1', 1, 'ORD001', 'YumYim', 'Adobo', '2', 2, 200.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),
('1', 1, 'ORD001', 'YumYim', 'Adobo', '2', 2, 200.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),
('1', 1, 'ORD002', 'YumYim', 'Adobo', '2', 1, 100.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),
('1', 1, 'ORD003', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'ToReceive', '2021-07-01 08:00:00'),
('1', 1, 'ORD004', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00'),
('1', 1, 'ORD005', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'Preparing', '2021-07-01 08:00:00'),
('1', 1, 'ORD006', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'Completed', '2021-07-01 08:00:00'),
('1', 1, 'ORD007', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'ToReceive', '2021-07-01 08:00:00'),
('1', 1, 'ORD008', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'Completed', '2021-07-01 08:00:00'),
('1', 1, 'ORD009', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'Cancelled', '2021-07-01 08:00:00'),
('1', 1, 'ORD010', 'YumYim', 'Adobo', '', 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00');

-- INSERT INTO product_variants (product_id, variation_type, name, additional_price, subtract_price, image_path) VALUES (4, 'Size', 'Large', 20.00, 0.00, 'uploads/images/large.jpg');

-- CREATE TABLE order_items (
--     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     order_id INT UNSIGNED NOT NULL,
--     product_id INT UNSIGNED NOT NULL,
--     quantity INT UNSIGNED NOT NULL,
--     unit_price DECIMAL(10, 2) NOT NULL,
--     subtotal DECIMAL(10, 2) NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
--     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
-- );


-- First, let's insert sample data for a product with variations
INSERT INTO products (id, name, code, description, price, category_id, stall_id, file_path) 
VALUES (1, 'Adobo', 'ADO001', 'Filipino dish', 100.00, 1, 1, '/images/adobo.jpg');

-- Insert variation types
INSERT INTO variation_types (id, product_id, name, is_required) 
VALUES 
(1, 1, 'Size', true),
(2, 1, 'Spice Level', false);

-- Insert product variants
INSERT INTO product_variants (id, variation_type_id, name, additional_price, is_default) 
VALUES 
(1, 1, 'Regular', 0.00, true),
(2, 1, 'Large', 20.00, false),
(3, 2, 'Mild', 0.00, true),
(4, 2, 'Spicy', 10.00, false);

-- Now insert the orders with proper variant references
INSERT INTO orders (
    user_id, 
    product_id,
    order_id, 
    food_stall_name, 
    food_name, 
    variant_id, 
    quantity, 
    price, 
    payment_method, 
    status, 
    order_date
) VALUES 
-- Orders with variants (Large size)
('1', 1, 'ORD001', 'YumYim', 'Adobo', 2, 2, 240.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),
('1', 1, 'ORD001', 'YumYim', 'Adobo', 2, 2, 240.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),
('1', 1, 'ORD002', 'YumYim', 'Adobo', 2, 1, 120.00, 'Cash', 'ToPay', '2021-07-01 08:00:00'),

-- Orders without variants (using 0 for variant_id)
('1', 1, 'ORD003', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'ToReceive', '2021-07-01 08:00:00'),
('1', 1, 'ORD004', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00'),
('1', 1, 'ORD005', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Preparing', '2021-07-01 08:00:00'),
('1', 1, 'ORD006', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Completed', '2021-07-01 08:00:00'),
('1', 1, 'ORD007', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'ToReceive', '2021-07-01 08:00:00'),
('1', 1, 'ORD008', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Completed', '2021-07-01 08:00:00'),
('1', 1, 'ORD009', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Cancelled', '2021-07-01 08:00:00'),
('1', 1, 'ORD010', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00');


-- UNFINISHED --
-- INSERT INTO products (name, code, description, base_price, category_id, stall_id, file_path) 
-- VALUES ('Adobo', 'ADO001', 'Filipino dish', 100.00, 1, 1, '/images/adobo.jpg');

-- -- Insert variation types for the product
-- INSERT INTO variation_types (product_id, name, is_required) 
-- VALUES 
-- (1, 'Size', true),
-- (1, 'Spice Level', false);

-- -- Insert variants for each variation type
-- INSERT INTO product_variants (variation_type_id, name, additional_price, is_default) 
-- VALUES 
-- -- Size variants
-- (1, 'Regular', 0.00, true),
-- (1, 'Large', 20.00, false),
-- (1, 'Extra Large', 40.00, false),
-- -- Spice Level variants
-- (2, 'Mild', 0.00, true),
-- (2, 'Medium', 0.00, false),
-- (2, 'Spicy', 5.00, false);