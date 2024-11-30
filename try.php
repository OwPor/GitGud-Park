<div id="container"  class="row row-cols-1 row-cols-md-3 g-3">
        <div class="col">
            hdhdhd
        </div>
        <div class="col">
            hdhdh
        </div>
        <div class="col">
            dhdhdh
        </div>
        <div class="col">
          hdhdhdj
        </div>
        <div class="col">
            djhdhd
        </div>
        
        <div class="col">
            hdhdhd
        </div>
        <div class="col">
            hdhdh
        </div>
        <div class="col">
            dhdhdh
        </div>
        <div class="col">
          hdhdhdj
        </div>
        <div class="col">
            djhdhd
        </div>
        <div class="col">
            hdhdhd
        </div>
        <div class="col">
            hdhdh
        </div>
        <div class="col">
            dhdhdh
        </div>
        <div class="col">
          hdhdhdj
        </div>
        <div class="col">
            djhdhd
        </div>
        <div class="col">
            hdhdhd
        </div>
        <div class="col">
            hdhdh
        </div>
        <div class="col">
            dhdhdh
        </div>
        <div class="col">
          hdhdhdj
        </div>
        <div class="col">
            djhdhd
        </div>
        <div class="col">
            hdhdhd
        </div>
        <div class="col">
            hdhdh
        </div>
        <div class="col">
            dhdhdh
        </div>
        <div class="col">
          hdhdhdj
        </div>
        <div class="col">
            djhdhd
        </div>
        <div class="col">
            hdhdhd
        </div>
        <div class="col">
            hdhdh
        </div>
        <div class="col">
            dhdhdh
        </div>
        <div class="col">
          hdhdhdj
        </div>
        <div class="col">
            djhdhd
        </div>
</div> 
<div class="text-center mt-3">
    <button id="seeMore" class="btn btn-primary">See More</button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("container");
    const seeMoreButton = document.getElementById("seeMore");

    // Initial data simulation
    const data = Array.from({ length: 100 }, (_, i) => `Item ${i + 1}`);
    let displayedCount = 0;
    const itemsPerPage = 15;

    // Function to render items
    const renderItems = () => {
        const remainingItems = data.slice(displayedCount, displayedCount + itemsPerPage);
        remainingItems.forEach(item => {
            const col = document.createElement("div");
            col.classList.add("col");
            col.innerHTML = `<div class="p-3 border bg-light">${item}</div>`;
            container.appendChild(col);
        });
        displayedCount += remainingItems.length;

        // Hide the button if all items are displayed
        if (displayedCount >= data.length) {
            seeMoreButton.style.display = "none";
        }
    };

    // Initial render
    renderItems();

    // Event listener for "See More"
    seeMoreButton.addEventListener("click", renderItems);
});
</script>