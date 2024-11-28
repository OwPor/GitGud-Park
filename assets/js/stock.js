    // Add event listeners to the edit icons
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            // Find the row associated with the clicked edit icon
            const row = this.closest('tr');

            // Extract the item and reason values
            const items = row.querySelector('.items').textContent.trim();
            const reason = row.querySelector('.reason').textContent.trim();

            // Determine which table the row belongs to
            const isStockIn = row.closest('table').id === 'stockin-table';

            // Populate the respective form
            if (isStockIn) {
                document.getElementById('stockin').value = items;

                const reasonDropdown = document.getElementById('stockinreason');
                for (let option of reasonDropdown.options) {
                    if (option.textContent === reason) {
                        option.selected = true;
                        break;
                    }
                }
            } else {
                document.getElementById('stockout').value = items;

                const reasonDropdown = document.getElementById('stockoutreason');
                for (let option of reasonDropdown.options) {
                    if (option.textContent === reason) {
                        option.selected = true;
                        break;
                    }
                }
            }
        });
    });

    // Add event listeners to the delete icons
    document.querySelectorAll('.fa-trash').forEach(icon => {
        icon.addEventListener('click', function () {
            // Find the row associated with the clicked delete icon
            const row = this.closest('tr');

            // Display a confirmation dialog
            const confirmDelete = confirm("Are you sure you want to delete this stock?");
            if (confirmDelete) {
                // Remove the row if the user confirms
                row.remove();

                // Optional: Add logic to handle server-side deletion if needed
                console.log("Stock deleted successfully");
            } else {
                console.log("Deletion canceled");
            }
        });
    });
