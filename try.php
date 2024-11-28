<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Processing</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    display: flex;
    width: 90%;
    height: 90%;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

/* Pending Payments Section */
.pending-payments {
    width: 30%;
    background: #f9f9f9;
    border-right: 1px solid #ddd;
    padding: 20px;
}

h2 {
    margin: 0 0 10px 0;
    color: #333;
}

.search-bar input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.order-list {
    overflow-y: auto;
    max-height: calc(100% - 100px);
}

.order-item {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    background: white;
}

.order-item.selected {
    border: 2px solid orange;
}

/* Payment Processing Section */
.payment-processing {
    width: 70%;
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
}

.stall {
    margin-bottom: 20px;
}

.stall h3 {
    margin-bottom: 10px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.totals div {
    margin-bottom: 10px;
    font-size: 16px;
}

.totals input {
    padding: 5px;
    width: 120px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
}

button.confirm {
    background-color: orange;
    color: white;
}

button.cancel {
    background-color: gray;
    color: white;
}

    </style>
</head>
<body>
    <div class="container">
        <!-- Pending Payments Section -->
        <div class="pending-payments">
            <h2>Pending Payment</h2>
            <div class="search-bar">
                <input type="text" placeholder="Search Order ID">
            </div>
            <div class="order-list">
                <div class="order-item selected">
                    <p>Order ID: <span>0001</span></p>
                    <p>Total Price: <span>120.00</span></p>
                    <p>Time Ordered: <span>01:00 PM</span></p>
                </div>
                <div class="order-item">
                    <p>Order ID: <span>0023</span></p>
                    <p>Total Price: <span>120.00</span></p>
                    <p>Time Ordered: <span>01:01 PM</span></p>
                </div>
                <!-- Add similar items here -->
            </div>
        </div>

        <!-- Payment Processing Section -->
        <div class="payment-processing">
            <div class="header">
                <h2>Payment Processing</h2>
                <div class="order-id">
                    Order ID <span>0001</span>
                </div>
            </div>

            <!-- Stall 1 -->
            <div class="stall">
                <h3>Stall 1</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Turon ni Bai</td>
                            <td>3</td>
                            <td>112.00</td>
                        </tr>
                        <tr>
                            <td>McDonald Big Mac</td>
                            <td>19</td>
                            <td>555.00</td>
                        </tr>
                        <tr>
                            <td>Jolly Spaghetti</td>
                            <td>1</td>
                            <td>66.55</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Stall 2 -->
            <div class="stall">
                <h3>Stall 2</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Turon ni Bai</td>
                            <td>3</td>
                            <td>112.00</td>
                        </tr>
                        <tr>
                            <td>McDonald Big Mac</td>
                            <td>19</td>
                            <td>555.00</td>
                        </tr>
                        <tr>
                            <td>Jolly Spaghetti</td>
                            <td>1</td>
                            <td>66.55</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Totals and Actions -->
            <div class="totals">
                <div>
                    Total Due: <span>766.00</span>
                </div>
                <div>
                    Total Discount: <span>20.00</span>
                </div>
                <div>
                    Total Products: <span>6</span>
                </div>
                <div>
                    Amount Received: 
                    <input type="number" placeholder="Enter here">
                </div>
                <div>
                    Change Due: <span>0.00</span>
                </div>
            </div>
            <div class="actions">
                <button class="confirm">Confirm Payment</button>
                <button class="cancel">Cancel Order</button>
            </div>
        </div>
    </div>
</body>
</html>
