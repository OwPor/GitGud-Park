<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Search and Dropdown</title>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- Bootstrap CSS (Optional for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="form-group">
            <select id="emailDropdown" class="form-control" style="width: 100%;"></select>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Bootstrap Bundle JS (Optional for styling) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize the dropdown with Select2
            $('#emailDropdown').select2({
                placeholder: "Search and select an email",
                allowClear: true,
                data: [
                    { id: 'john.doe@example.com', text: 'john.doe@example.com' },
                    { id: 'jane.doe@example.com', text: 'jane.doe@example.com' },
                    { id: 'alice@example.com', text: 'alice@example.com' },
                    { id: 'bob@example.com', text: 'bob@example.com' }
                ]
            });

            // Handle selection
            $('#emailDropdown').on('select2:select', function (e) {
                const selectedEmail = e.params.data.text;
                console.log("Selected email:", selectedEmail);
            });

            // Handle clearing the selection
            $('#emailDropdown').on('select2:unselect', function () {
                console.log("Email selection cleared.");
            });
        });
    </script>
</body>
</html>
