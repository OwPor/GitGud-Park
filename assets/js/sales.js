const rowsPerPage = 5; // Number of rows per page
    const table = document.querySelector(".salestable");
    const pagination = document.querySelector(".saletabpag");

    // Toggle between views
    const outletViewButton = document.getElementById("outletView");
    const chartViewButton = document.getElementById("chartView");
    const outletViewTable = document.getElementById("outletViewTable");
    const chartContainer = document.getElementById("chartContainer");

    // Toggle between views
    outletViewButton.addEventListener("click", () => {
        outletViewTable.classList.remove("d-none");
        chartContainer.classList.add("d-none");
        outletViewButton.classList.add("active");
        chartViewButton.classList.remove("active");
        pagination.classList.remove("d-none"); // Show pagination
    });

    chartViewButton.addEventListener("click", () => {
        outletViewTable.classList.add("d-none");
        chartContainer.classList.remove("d-none");
        outletViewButton.classList.remove("active");
        chartViewButton.classList.add("active");
        pagination.classList.add("d-none"); // Hide pagination
        loadChart(); // Call the function to load the chart
    });


    // Generate the Chart.js line graph
    function loadChart() {
        const ctx = document.getElementById("salesChart").getContext("2d");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Product 1", "Product 2", "Product 3", "Product 4", "Product 5",
                    "Product 6", "Product 7", "Product 8", "Product 9", "Product 10"
                ],
                datasets: [
                    {
                        label: "Order Count",
                        data: [10, 20, 30, 25, 15, 18, 22, 16, 12, 28],
                        borderColor: "#6A9C89",
                        backgroundColor: "#C1D8C3",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4, // Curved lines
                    },
                    {
                        label: "Sales (₱)",
                        data: [100, 200, 300, 250, 150, 180, 220, 160, 120, 280],
                        borderColor: "#CD5C08",
                        backgroundColor: "#FFF5E4",
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

    function generatePagination() {
    const rows = Array.from(table.querySelectorAll("tr")).slice(1); // Exclude header row
    const pageCount = Math.ceil(rows.length / rowsPerPage);
    const maxVisiblePages = 5; // Maximum number of visible page numbers
    let currentPageGroup = 1; // Start at the first group

    pagination.innerHTML = ""; // Clear existing pagination

    // Function to show a specific set of pages
    function showPageGroup(group) {
        pagination.innerHTML = ""; // Clear existing pagination

        const startPage = (group - 1) * maxVisiblePages + 1;
        const endPage = Math.min(group * maxVisiblePages, pageCount);

        // Add back arrow if not the first group
        if (group > 1) {
            const backArrow = document.createElement("i");
            backArrow.className = "fa-solid fa-arrow-left";
            backArrow.addEventListener("click", () => {
                currentPageGroup--;
                showPageGroup(currentPageGroup);
                showPage((currentPageGroup - 1) * maxVisiblePages + 1); // Set active to the first page in the new group
            });
            pagination.appendChild(backArrow);
        }

        // Add visible page numbers
        for (let i = startPage; i <= endPage; i++) {
            const pageNumber = document.createElement("span");
            pageNumber.textContent = i;
            pageNumber.classList.add("page-number");
            pageNumber.addEventListener("click", () => showPage(i));
            pagination.appendChild(pageNumber);
        }

        // Add next arrow if not the last group
        if (group < Math.ceil(pageCount / maxVisiblePages)) {
            const nextArrow = document.createElement("i");
            nextArrow.className = "fa-solid fa-arrow-right";
            nextArrow.addEventListener("click", () => {
                currentPageGroup++;
                showPageGroup(currentPageGroup);
                showPage((currentPageGroup - 1) * maxVisiblePages + 1); // Set active to the first page in the new group
            });
            pagination.appendChild(nextArrow);
        }
    }

    // Show rows for a specific page
    function showPage(page) {
        const rows = Array.from(table.querySelectorAll("tr")).slice(1); // Exclude header row
        rows.forEach((row, index) => {
            row.style.display =
                index >= (page - 1) * rowsPerPage && index < page * rowsPerPage
                    ? "table-row"
                    : "none";
        });

        // Update active page styling
        const pageNumbers = pagination.querySelectorAll(".page-number");
        pageNumbers.forEach((pageNumber) => pageNumber.classList.remove("active"));
        const activePageNumber = Array.from(pageNumbers).find((p) => parseInt(p.textContent) === page);
        if (activePageNumber) activePageNumber.classList.add("active");
    }

    // Show the first group and initialize
    showPageGroup(currentPageGroup);
    showPage(1);
}

// Initialize pagination
generatePagination();