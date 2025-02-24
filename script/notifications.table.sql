CREATE TABLE notifications (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- SAMPLE INSERT
INSERT INTO notifications (user_id, title, message) VALUES (5, 'Order ID 0034: Preparing Order', 'Your order at Stall Name is now in preparation queue.');