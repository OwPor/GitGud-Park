<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination Example</title>
    <style>
        /* Basic styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Pagination styling */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 20px 0;
            justify-content: center;
        }
        .pagination li {
            margin: 0 5px;
            cursor: pointer;
            padding: 8px 12px;
            border: 1px solid #ddd;
            color: #333;
        }
        .pagination li.active {
            background-color: #00e676;
            color: white;
            font-weight: bold;
            border: none;
        }
        .pagination li:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <table id="dataTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <ul class="pagination" id="pagination"></ul>

    <script>
        const rowsPerPage = 5;
        const data = Array.from({ length: 50 }, (_, i) => ({
            date: `07/29/2024 22:${String(i).padStart(2, '0')}`,
            reason: i % 2 === 0 ? "Restock" : "Inventory Adjustment"
        }));

        let currentPage = 1;
        let maxVisiblePages = 10;

        function displayTableData(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const rows = data.slice(start, end);

            const tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
            tableBody.innerHTML = '';
            rows.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${row.date}</td><td>${row.reason}</td>`;
                tableBody.appendChild(tr);
            });
        }

        function displayPagination(totalPages) {
            const paginationElement = document.getElementById('pagination');
            paginationElement.innerHTML = '';

            const createPageItem = (page, isActive = false) => {
                const li = document.createElement('li');
                li.textContent = page;
                if (isActive) li.classList.add('active');
                li.addEventListener('click', () => {
                    currentPage = page;
                    updatePagination();
                    displayTableData(currentPage);
                });
                return li;
            };

            const createArrow = (direction) => {
                const li = document.createElement('li');
                li.textContent = direction === 'left' ? '◀' : '▶';
                li.addEventListener('click', () => {
                    if (direction === 'left' && currentPage > 1) {
                        currentPage--;
                    } else if (direction === 'right' && currentPage < totalPages) {
                        currentPage++;
                    }
                    updatePagination();
                    displayTableData(currentPage);
                });
                return li;
            };

            // Add left arrow if current page is beyond the first visible set
            if (currentPage > maxVisiblePages) {
                paginationElement.appendChild(createArrow('left'));
            }

            // Calculate which pages to show
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationElement.appendChild(createPageItem(i, i === currentPage));
            }

            // Add right arrow if there are more pages left to show
            if (endPage < totalPages) {
                paginationElement.appendChild(createArrow('right'));
            }
        }

        function updatePagination() {
            const totalPages = Math.ceil(data.length / rowsPerPage);
            displayPagination(totalPages);
        }

        displayTableData(currentPage);
        updatePagination();
    </script>
</body>
</html>
