-- Stall Management System of Amethyst Food Park
DROP DATABASE IF EXISTS gitgud;

CREATE DATABASE gitgud;

USE gitgud;
    
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    sex VARCHAR(10) NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    password CHAR(255) NOT NULL,
    birth_date DATE NOT NULL,
    status ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
    role ENUM('Customer', 'Park Owner', 'Stall Owner', 'Admin') NOT NULL DEFAULT 'Customer',
    profile_img VARCHAR(255) DEFAULT 'assets/images/profile.jpg',
    user_session VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE verification (
    user_id INT UNSIGNED PRIMARY KEY NOT NULL,
    verification_token VARCHAR(255) NOT NULL,
    token_expiration DATETIME NOT NULL,
    is_verified TINYINT DEFAULT 0,
    last_sent VARCHAR(255) NULL
);

CREATE TABLE parks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(50),
    image VARCHAR(255),
    owner_name VARCHAR(100),
    contact_number VARCHAR(20),
    email VARCHAR(100),
    opening_time TIME,
    closing_time TIME,
    price_range DECIMAL(10, 2) NOT NULL,
    status ENUM('Open', 'Closed', 'Maintenance', 'Pending Approval') NOT NULL DEFAULT 'Pending Approval',
    url VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- INSERT INTO parks (name, description, location, image, owner_name, contact_number, email, opening_time, closing_time, price_range, status, url)
-- VALUES ('Amethyst Food Park', 'A food park located in the heart of the city.', 'Johnston St., Zamboanga City', 'assets/images/foodpark.jpg', 'John Doe', '123-456-7890', '222@gmail.com', '08:00:00', '22:00:00', 100.00, 'Open', 'aeb32xc');

CREATE TABLE stalls (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    park_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(50),
    img VARCHAR(255),
    owner_name VARCHAR(100),
    contact_number VARCHAR(20),
    email VARCHAR(100),
    opening_time TIME,
    closing_time TIME,
    price_range DECIMAL(10, 2) NOT NULL,
    status ENUM('Open', 'Closed', 'Maintenance', 'Pending Approval') NOT NULL DEFAULT 'Pending Approval',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (park_id) REFERENCES parks(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- INSERT INTO stalls (user_id, park_id, name, description, location, img, owner_name, contact_number, email, opening_time, closing_time, price_range, status) VALUES (1, 1, 'YumYim', 'A stall that serves delicious food.', 'Amethyst Food Park', 'uploads/images/foodpark.jpg', 'Jane Doe', '098-765-4321', 'janedoe@jane.com', '08:00:00', '22:00:00', 100.00, 'Open');

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

CREATE TABLE product_variations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
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

CREATE TABLE business (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    business_name VARCHAR(100) NOT NULL,
    business_type VARCHAR(100) NOT NULL,
    region_province_city VARCHAR(100) NOT NULL,
    barangay VARCHAR(100) NOT NULL,
    street_building_house VARCHAR(100) NOT NULL,
    business_phone VARCHAR(20) NOT NULL,
    business_email VARCHAR(100) NOT NULL,
    business_permit VARCHAR(255) NOT NULL,
    business_status ENUM('Approved', 'Rejected', 'Pending Approval') NOT NULL DEFAULT 'Pending Approval',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


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
    variation_id INT UNSIGNED,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status ENUM ('Cart', 'ToPay', 'Preparing', 'ToReceive', 'Completed', 'Cancelled', 'Scheduled') NOT NULL DEFAULT 'Cart',
    order_date DATETIME NOT NULL,
    scheduled_date DATETIME
);

INSERT INTO orders (
    user_id, 
    product_id,
    order_id, 
    food_stall_name, 
    food_name, 
    variation_id, 
    quantity, 
    price, 
    payment_method, 
    status, 
    order_date,
    scheduled_date
) VALUES 
-- Orders with variations (Large size)
('1', 1, 'ORD001', 'YumYim', 'Adobo', 2, 2, 240.00, 'Cash', 'ToPay', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD001', 'YumYim', 'Adobo', 2, 2, 240.00, 'Cash', 'ToPay', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD002', 'YumYim', 'Adobo', 2, 1, 120.00, 'Cash', 'ToPay', '2021-07-01 08:00:00', ''),

-- Orders without variations (using 0 for variation_id)
('1', 1, 'ORD003', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'ToReceive', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD004', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD005', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Preparing', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD006', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Completed', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD007', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'ToReceive', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD008', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Completed', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD009', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Cancelled', '2021-07-01 08:00:00', ''),
('1', 1, 'ORD010', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00', '2021-07-01 12:00:00');

-- Insert sample orders
INSERT INTO orders (
    user_id, 
    product_id,
    order_id, 
    food_stall_name, 
    food_name, 
    variation_id, 
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

INSERT INTO product_variations (product_id, variation_type, name, additional_price, subtract_price, image_path) VALUES (4, 'Size', 'Large', 20.00, 0.00, 'uploads/images/large.jpg');

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



-- NAILA
CREATE TABLE `operating_hours` (
  `id` int(11) NOT NULL,
  `days` varchar(255) DEFAULT NULL,
  `open_time` varchar(10) DEFAULT NULL,
  `close_time` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




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
('1', 1, 'ORD010', 'YumYim', 'Adobo', 0, 1, 100.00, 'Cash', 'Scheduled', '2021-07-01 08:00:00', '2021-07-01 12:00:00');


-- UNFINISHED --
-- INSERT INTO products (name, code, description, base_price, category_id, stall_id, file_path) 
-- VALUES ('Adobo', 'ADO001', 'Filipino dish', 100.00, 1, 1, '/images/adobo.jpg');

-- -- Insert variation types for the product
-- INSERT INTO variation_types (product_id, name, is_required) 
-- VALUES 
-- (1, 'Size', true),
-- (1, 'Spice Level', false);

-- -- Insert variants for each variation type
INSERT INTO product_variations (product_id, variation_type_id, name, additional_price, is_default) 
VALUES 
-- Size variants
(1, 1, 'Regular', 0.00, true),
(1, 1, 'Large', 20.00, false),
(1, 1, 'Extra Large', 40.00, false),
-- Spice Level variants
(1, 2, 'Mild', 0.00, true),
(1, 2, 'Medium', 0.00, false),
(1, 2, 'Spicy', 5.00, false);