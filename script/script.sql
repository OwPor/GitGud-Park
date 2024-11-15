-- Stall Management System of Amethyst Food Park
DROP DATABASE gitgud;

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
    role ENUM('Customer', 'Park Owner', 'Stall Owner', 'Admin') NOT NULL DEFAULT 'Customer',
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

INSERT INTO parks (name, description, location, image, owner_name, contact_number, email, opening_time, closing_time, price_range, status)
VALUES ('Amethyst Food Park', 'A food park located in the heart of the city.', 'Johnston St., Zamboanga City', 'assets/images/foodpark.jpg', 'John Doe', '123-456-7890', '222@gmail.com', '08:00:00', '22:00:00', 100.00, 'Open');

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
    FOREIGN KEY (park_id) REFERENCES parks(id) ON DELETE CASCADE
);

INSERT INTO stalls (name, description, location, img, owner_name, contact_number, email, opening_time, closing_time, price_range, status, park_id)
VALUES ('YumYim', 'A stall that serves delicious food.', 'Amethyst Food Park', 'assets/images/foodpark.jpg', 'Jane Doe', '098-765-4321', 'aaa@gmail.com', '08:00:00', '22:00:00', 100.00, 'Open', 1);

INSERT INTO stalls (name, description, location, img, owner_name, contact_number, email, opening_time, closing_time, price_range, status, park_id)
VALUES ('Ihhh', 'AHHHHH.', 'Amethyst Food Park', 'assets/images/foodpark.jpg', 'Jane Doe', '098-765-4321', 'aaa@gmail.com', '08:00:00', '22:00:00', 100.00, 'Closed', 1);

CREATE TABLE categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO categories (name, description)
VALUES ('Main Course', 'Main dishes that are served in a meal.');

CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    stall_id INT UNSIGNED NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (stall_id) REFERENCES stalls(id) ON DELETE CASCADE
);

INSERT INTO products (name, code, description, price, category_id, stall_id) VALUES ('Adobo', 'AD001', 'A Filipino dish that is made of pork or chicken.', 100.00, 1, 1);





CREATE TABLE stalls (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    location VARCHAR(50),
    owner_name VARCHAR(100),
    contact_number VARCHAR(20),
    email VARCHAR(100),
    opening_time TIME,
    closing_time TIME,
    price_range DECIMAL(10, 2) NOT NULL,
    status ENUM('Open', 'Closed', 'Maintenance', 'Pending Approval') NOT NULL DEFAULT 'Pending Approval',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE menu_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    stall_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    discount_percentage DECIMAL(5, 2) DEFAULT 0,
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (stall_id) REFERENCES stalls(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('Pending', 'Preparing', 'Ready', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    menu_item_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    stall_id INT UNSIGNED NOT NULL,
    rating TINYINT UNSIGNED NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (stall_id) REFERENCES stalls(id) ON DELETE CASCADE
);
