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

INSERT INTO parks (name, description, location, image, owner_name, contact_number, email, opening_time, closing_time, price_range, status, url)
VALUES ('Amethyst Food Park', 'A food park located in the heart of the city.', 'Johnston St., Zamboanga City', 'assets/images/foodpark.jpg', 'John Doe', '123-456-7890', '222@gmail.com', '08:00:00', '22:00:00', 100.00, 'Open', 'aeb32xc');

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

INSERT INTO stalls (user_id, park_id, name, description, location, img, owner_name, contact_number, email, opening_time, closing_time, price_range, status) VALUES (1, 1, 'YumYim', 'A stall that serves delicious food.', 'Amethyst Food Park', 'uploads/images/foodpark.jpg', 'Jane Doe', '098-765-4321', 'janedoe@jane.com', '08:00:00', '22:00:00', 100.00, 'Open');

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

-- Alter products add stock and stock_warn
-- ALTER TABLE products ADD COLUMN stock INT UNSIGNED NOT NULL DEFAULT 0;
-- ALTER TABLE products ADD COLUMN stock_warn INT UNSIGNED NOT NULL DEFAULT 0;
-- ALTER TABLE products ADD COLUMN discount DECIMAL(10, 2) DEFAULT 0.00;
-- ALTER TABLE products ADD COLUMN discount_type ENUM('Percentage', 'Fixed') DEFAULT 'Percentage';

CREATE TABLE product_variants (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT UNSIGNED NOT NULL,
    variation_type VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    additional_price DECIMAL(10, 2) DEFAULT 0.00,
    subtract_price DECIMAL(10, 2) DEFAULT 0.00,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
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




CREATE TABLE orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('Pending', 'Preparing', 'Ready', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_session) ON DELETE CASCADE
);


-- NEW ORDERS TABLE
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    order_id VARCHAR(50) NOT NULL,
    food_stall_name VARCHAR(100) NOT NULL,
    food_name VARCHAR(100) NOT NULL,
    variation VARCHAR(100),
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status ENUM ('Cart', 'ToPay', 'Preparing', 'ToReceive', 'Completed', 'Cancelled', 'Scheduled') NOT NULL DEFAULT 'Cart',
    order_date DATETIME NOT NULL
);

-- Insert sample orders
INSERT INTO orders (
    user_id, 
    order_id, 
    food_stall_name, 
    food_name, 
    variation, 
    quantity, 
    price, 
    payment_method, 
    status, 
    order_date
) VALUES 
-- To Pay Orders
('USER001', 'ORD-2025-001', 'Tasty Treats', 'Chicken Adobo', 'Large Serving', 2, 150.00, 'Cash', 'ToPay', '2025-02-01 10:30:00'),
('USER001', 'ORD-2025-002', 'Sweet Corner', 'Chocolate Cake', 'Medium Size', 1, 299.00, 'GCash', 'ToPay', '2025-02-01 11:00:00'),

-- Preparing Orders
('USER001', 'ORD-2025-003', 'Burger House', 'Classic Burger', 'With Cheese', 3, 89.00, 'Cash', 'Preparing', '2025-02-01 09:45:00'),
('USER001', 'ORD-2025-004', 'Pizza Palace', 'Pepperoni Pizza', 'Large', 1, 450.00, 'Credit Card', 'Preparing', '2025-02-01 09:15:00'),

-- To Receive Orders
('USER001', 'ORD-2025-005', 'Noodle House', 'Beef Mami', 'Special', 2, 120.00, 'Cash', 'ToReceive', '2025-02-01 08:30:00'),
('USER001', 'ORD-2025-006', 'Sushi Bar', 'California Roll', 'Regular', 3, 250.00, 'GCash', 'ToReceive', '2025-02-01 08:00:00'),

-- Completed Orders
('USER001', 'ORD-2025-007', 'Grilled Masters', 'BBQ Ribs', 'Full Rack', 1, 599.00, 'Cash', 'Completed', '2025-01-31 15:30:00'),
('USER001', 'ORD-2025-008', 'Ice Cream Shop', 'Sundae Supreme', 'Large', 2, 150.00, 'GCash', 'Completed', '2025-01-31 14:45:00'),

-- Cancelled Orders
('USER001', 'ORD-2025-009', 'Dimsum Place', 'Siomai Platter', 'Family Size', 1, 299.00, 'Cash', 'Cancelled', '2025-01-31 13:20:00'),
('USER001', 'ORD-2025-010', 'Milk Tea Shop', 'Pearl Milk Tea', 'Large', 2, 120.00, 'GCash', 'Cancelled', '2025-01-31 12:00:00'),

-- Scheduled Orders
('USER001', 'ORD-2025-011', 'Cake House', 'Birthday Cake', 'Large', 1, 899.00, 'Cash', 'Scheduled', '2025-02-05 14:00:00'),
('USER001', 'ORD-2025-012', 'Party Platters', 'Party Package A', 'For 50 pax', 1, 2500.00, 'Bank Transfer', 'Scheduled', '2025-02-10 11:00:00');

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

