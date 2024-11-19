<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order UI</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <style>
    .btn-toggle {
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      border-radius: 5px;
    }
    .btn-toggle.active {
      background-color: #cd5c08;
      color: white;
    }
    .btn-orange {
      background-color: #cd5c08;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
    }
    .btn-orange:hover {
      background-color: #b25007;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card p-4">
    <h4 class="text-end">Total: <span class="text-danger">P1,072</span></h4>

    <!-- Order Type -->
    <div class="mb-3">
      <label class="form-label">Order Type</label>
      <div class="btn-group d-flex" role="group">
        <button type="button" class="btn btn-toggle active" id="dineIn">Dine In</button>
        <button type="button" class="btn btn-toggle" id="takeOut">Take Out</button>
      </div>
    </div>

    <!-- Payment Method -->
    <div class="mb-3">
      <label class="form-label">Payment Method</label>
      <select class="form-select" id="paymentMethod">
        <option value="cash">Cash</option>
        <option value="gcash">GCash</option>
        <option value="paymaya">PayMaya</option>
      </select>
    </div>

    <!-- Order Time -->
    <div>
      <label class="form-label">Order</label>
      <div class="d-flex align-items-center mb-3">
        <input class="form-check-input me-2" type="radio" name="orderTime" id="immediately" checked>
        <label for="immediately" class="me-4">Immediately</label>

        <input class="form-check-input me-2" type="radio" name="orderTime" id="scheduleLater">
        <label for="scheduleLater">Schedule for later</label>
      </div>

      <div class="row g-3">
        <div class="col-md-4">
          <input type="date" class="form-control" id="scheduleDate" disabled>
        </div>
        <div class="col-md-4">
          <input type="time" class="form-control" id="scheduleTime" disabled>
        </div>
      </div>
    </div>

    <!-- Place Order -->
    <div class="mt-4">
      <button class="btn btn-orange w-100">Place Order</button>
    </div>
  </div>
</div>

<script>
  // Toggle Order Type buttons
  document.querySelectorAll('.btn-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.btn-toggle').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

  // Enable/Disable Date and Time fields
  const scheduleDate = document.getElementById('scheduleDate');
  const scheduleTime = document.getElementById('scheduleTime');
  document.getElementById('immediately').addEventListener('click', () => {
    scheduleDate.disabled = true;
    scheduleTime.disabled = true;
  });
  document.getElementById('scheduleLater').addEventListener('click', () => {
    scheduleDate.disabled = false;
    scheduleTime.disabled = false;
  });
</script>
</body>
</html>
