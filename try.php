<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Accounts</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <!-- Account Table -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Birthday</th>
          <th>Sex</th>
          <th>Status</th>
          <th>Role</th>
          <th>Date Created</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="accountTable">
        <tr>
          <td>Naila</td>
          <td>Haliluddin</td>
          <td>example@gmail.com</td>
          <td>+639123456789</td>
          <td>12/04/2003</td>
          <td>Female</td>
          <td class="status">Active</td>
          <td>Customer</td>
          <td>07/29/2024</td>
          <td class="action">
            <button class="btn btn-danger btn-sm" onclick="openDeactivateModal(this, 'Naila Haliluddin')">Deactivate</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Deactivate Modal -->
  <div class="modal fade" id="deactivateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-4">
          <h5 class="modal-title mb-4">Select Duration of Deactivation</h5>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="deactivationDuration" value="3 days" id="deactivate3Days">
            <label class="form-check-label" for="deactivate3Days">3 Days</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="deactivationDuration" value="7 days" id="deactivate7Days">
            <label class="form-check-label" for="deactivate7Days">7 Days</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="deactivationDuration" value="1 month" id="deactivate1Month">
            <label class="form-check-label" for="deactivate1Month">1 Month</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="deactivationDuration" value="Forever" id="deactivateForever">
            <label class="form-check-label" for="deactivateForever">Forever</label>
          </div>
          <div class="text-center mt-4">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeactivate">Deactivate</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Activate Modal -->
  <div class="modal fade" id="activateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-4">
          <h5 class="modal-title mb-4">Activate Account</h5>
          <p>Are you sure you want to activate this account?</p>
          <div class="text-center mt-4">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" id="confirmActivate">Activate</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript -->
  <script>
    let selectedRow; // Reference to the selected row

    function openDeactivateModal(button, name) {
      selectedRow = button.closest('tr');
      const modal = new bootstrap.Modal(document.getElementById('deactivateModal'));
      modal.show();
    }

    function openActivateModal(button, name) {
      selectedRow = button.closest('tr');
      const modal = new bootstrap.Modal(document.getElementById('activateModal'));
      modal.show();
    }

    document.getElementById('confirmDeactivate').addEventListener('click', () => {
      const duration = document.querySelector('input[name="deactivationDuration"]:checked').value;
      const statusCell = selectedRow.querySelector('.status');
      const actionCell = selectedRow.querySelector('.action');

      // Update status and action
      statusCell.textContent = `Deactivated for ${duration}`;
      actionCell.innerHTML = `
        <button class="btn btn-success btn-sm" onclick="openActivateModal(this)">Activate</button>
      `;

      const modal = bootstrap.Modal.getInstance(document.getElementById('deactivateModal'));
      modal.hide();
    });

    document.getElementById('confirmActivate').addEventListener('click', () => {
      const statusCell = selectedRow.querySelector('.status');
      const actionCell = selectedRow.querySelector('.action');

      // Update status and action
      statusCell.textContent = 'Active';
      actionCell.innerHTML = `
        <button class="btn btn-danger btn-sm" onclick="openDeactivateModal(this)">Deactivate</button>
      `;

      const modal = bootstrap.Modal.getInstance(document.getElementById('activateModal'));
      modal.hide();
    });
  </script>
</body>
</html>
