<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order UI</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.order-container {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    width: 350px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.order-type {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.toggle {
    flex: 1;
    padding: 10px;
    margin: 0 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background: #f8f8f8;
    cursor: pointer;
    text-align: center;
}

.toggle.active {
    background: #cd5c08;
    color: #fff;
    border-color: #cd5c08;
}

.payment-method label,
.order-time label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.payment-method select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.order-options {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.order-options label {
    display: flex;
    align-items: center;
    gap: 5px;
}

.schedule {
    display: flex;
    gap: 10px;
}

.schedule input {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.schedule input:disabled {
    background: #eee;
    cursor: not-allowed;
}

.place-order {
    width: 100%;
    padding: 10px;
    background: #cd5c08;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
}

.place-order:hover {
    background: #a44b06;
}

    </style>
</head>
<body>
    <div class="order-container">
        <div class="order-type">
            <button class="toggle active" id="dine-in">Dine In</button>
            <button class="toggle" id="take-out">Take Out</button>
        </div>

        <div class="payment-method">
            <label for="payment">Payment Method</label>
            <select id="payment">
                <option value="cash">Cash</option>
                <option value="credit">Credit Card</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <div class="order-time">
            <label>Order</label>
            <div class="order-options">
                <label>
                    <input type="radio" name="order-time" value="immediately" checked>
                    Immediately
                </label>
                <label>
                    <input type="radio" name="order-time" value="schedule" id="schedule-option">
                    Schedule for later
                </label>
            </div>
            <div class="schedule" id="schedule-fields">
                <input type="date" id="schedule-date" disabled>
                <input type="time" id="schedule-time" disabled>
            </div>
        </div>

        <button class="place-order">Place Order</button>
    </div>

    <script src="script.js"></script>
</body>
<script>
    const dineInBtn = document.getElementById('dine-in');
const takeOutBtn = document.getElementById('take-out');
const scheduleOption = document.getElementById('schedule-option');
const scheduleFields = document.getElementById('schedule-fields');
const scheduleDate = document.getElementById('schedule-date');
const scheduleTime = document.getElementById('schedule-time');

// Toggle buttons for Dine In and Take Out
dineInBtn.addEventListener('click', () => {
    dineInBtn.classList.add('active');
    takeOutBtn.classList.remove('active');
});

takeOutBtn.addEventListener('click', () => {
    takeOutBtn.classList.add('active');
    dineInBtn.classList.remove('active');
});

// Enable/Disable schedule fields based on selection
scheduleOption.addEventListener('change', () => {
    const isScheduled = scheduleOption.checked;
    scheduleDate.disabled = !isScheduled;
    scheduleTime.disabled = !isScheduled;
});

</script>
</html>
