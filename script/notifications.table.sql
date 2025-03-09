CREATE TABLE notifications (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    order_id VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    stall_id INT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (stall_id) REFERENCES stalls(id) ON DELETE CASCADE
);


ALTER TABLE notifications ADD COLUMN order_id VARCHAR(255);
ALTER TABLE notifications ADD COLUMN stall_id INT UNSIGNED;


-- SAMPLE INSERT
INSERT INTO notifications (user_id, order_id, title, message, stall_id) VALUES (5, 'Order ID 0034', 'Preparing Order', 'Your order at Stall Name is now in preparation queue.', 110);