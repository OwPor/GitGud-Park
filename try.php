<div class="bg-white border rounded-2 p-4 w-75">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Sales Today</h5>
        <span class="small py-1 px-2 rounded-5 salesdr" style="color: #CD5C08;">Download Report<i class="fa-regular fa-circle-down ms-2"></i></span>
    </div>
    <div class="w-100 d-flex my-4">
        <div class="cartot btn-group w-50" role="group">
            <button type="button" class="btn-toggle active rounded" id="outletView">Outlet View</button>
            <button type="button" class="btn-toggle rounded" id="chartView">Chart View</button>
        </div>
        <div class="w-25 text-end">
            <h4 class="m-0 fw-bold">53</h4>
            <span class="small">Total Orders</span>
        </div>
        <div class="w-25 text-end">
            <h4 class="m-0 fw-bold">₱433</h4>
            <span class="small">Total Sales</span>
        </div>
    </div>

    <!-- Outlet View (Table) -->
    <table class="salestable w-100" id="outletViewTable">
        <tr>
            <th class="w-50">Product Name</th>
            <th class="text-end w-25">Order Count</th>
            <th class="text-end w-25">Sales</th>
        </tr>
    </table>
    <div class="d-flex gap-3 saletabpag align-items-center justify-content-center mt-3" id="pagination">
        <!-- Pagination will be dynamically generated -->
    </div>

    <!-- Chart View (Graph) -->
    <div id="chartContainer" class="d-none">
        <canvas id="salesChart" width="400" height="200"></canvas>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data for products
    const products = [
        { name: "Product 1", count: 10, sales: 100 },
        { name: "Product 2", count: 20, sales: 200 },
        { name: "Product 3", count: 30, sales: 300 },
        { name: "Product 4", count: 25, sales: 250 },
        { name: "Product 5", count: 15, sales: 150 },
        { name: "Product 6", count: 18, sales: 180 },
        { name: "Product 7", count: 22, sales: 220 },
        { name: "Product 8", count: 16, sales: 160 },
        { name: "Product 9", count: 12, sales: 120 },
        { name: "Product 10", count: 28, sales: 280 },
    ];

    // Pagination variables
    const rowsPerPage = 5;
    let currentPage = 1;

    // Elements
    const outletViewTable = document.getElementById("outletViewTable");
    const paginationContainer = document.getElementById("pagination");
    const outletViewButton = document.getElementById("outletView");
    const chartViewButton = document.getElementById("chartView");
    const chartContainer = document.getElementById("chartContainer");

    // Render table with pagination
    function renderTable() {
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const paginatedProducts = products.slice(startIndex, endIndex);

        // Clear existing rows
        outletViewTable.innerHTML = `
            <tr>
                <th class="w-50">Product Name</th>
                <th class="text-end w-25">Order Count</th>
                <th class="text-end w-25">Sales</th>
            </tr>
        `;

        // Add rows for paginated products
        paginatedProducts.forEach(product => {
            const row = `
                <tr>
                    <td>${product.name}</td>
                    <td class="text-end">${product.count}</td>
                    <td class="text-end">₱${product.sales}</td>
                </tr>
            `;
            outletViewTable.innerHTML += row;
        });

        renderPagination();
    }

    // Render pagination buttons
    function renderPagination() {
        const totalPages = Math.ceil(products.length / rowsPerPage);
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("span");
            pageButton.textContent = i;
            pageButton.classList.add(i === currentPage ? "active" : "");
            pageButton.addEventListener("click", () => {
                currentPage = i;
                renderTable();
            });
            paginationContainer.appendChild(pageButton);
        }
    }

    // Toggle views
    outletViewButton.addEventListener("click", () => {
        outletViewTable.classList.remove("d-none");
        chartContainer.classList.add("d-none");
        paginationContainer.classList.remove("d-none");
        outletViewButton.classList.add("active");
        chartViewButton.classList.remove("active");
    });

    chartViewButton.addEventListener("click", () => {
        outletViewTable.classList.add("d-none");
        chartContainer.classList.remove("d-none");
        paginationContainer.classList.add("d-none");
        outletViewButton.classList.remove("active");
        chartViewButton.classList.add("active");
        loadChart(); // Generate the chart
    });

    // Generate the Chart.js line graph
    function loadChart() {
        const ctx = document.getElementById("salesChart").getContext("2d");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: products.map(product => product.name),
                datasets: [
                    {
                        label: "Order Count",
                        data: products.map(product => product.count),
                        borderColor: "#CD5C08",
                        backgroundColor: "rgba(205, 92, 8, 0.1)",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                    },
                    {
                        label: "Sales (₱)",
                        data: products.map(product => product.sales),
                        borderColor: "#1e90ff",
                        backgroundColor: "rgba(30, 144, 255, 0.1)",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: "top",
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Products",
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Values",
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    }

    // Initial render
    renderTable();
</script>


=