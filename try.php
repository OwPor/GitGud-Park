<style>
/* Dropdown Container */
.custom-dropdown {
  position: relative;
  display: inline-block;
  font-family: Arial, sans-serif;
}

/* Dropdown Button */
.dropdown-toggle {
  background-color: #fff; /* White background */
  color: #000; /* Black text */
  border: 1px solid #ddd; /* Light gray border */
  padding: 10px 15px;
  font-size: 16px;
  cursor: pointer;
  border-radius: 4px;
  width: 200px;
  text-align: left;
}

.dropdown-toggle:hover {
  background-color: #f5f5f5; /* Slightly lighter background */
}

/* Dropdown Menu */
.dropdown-menu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #fff; /* White background */
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Subtle shadow */
  border-radius: 4px;
  width: 200px;
  z-index: 10;
  border: 1px solid #ddd; /* Border matching the button */
}

.custom-dropdown:hover .dropdown-menu {
  display: block; /* Show menu on hover */
}

/* Dropdown Items */
.dropdown-item {
  padding: 10px 15px;
  color: #000; /* Black text */
  cursor: pointer;
  font-size: 14px;
  border-bottom: 1px solid #f0f0f0; /* Separator */
  position: relative;
}

.dropdown-item:last-child {
  border-bottom: none; /* Remove border for the last item */
}

.dropdown-item:hover {
  background-color: #f5f5f5; /* Lighter background */
}

/* Selected Item Checkmark */
.dropdown-item.selected::after {
  content: '✔';
  font-size: 14px;
  position: absolute;
  right: 10px;
  color: #000; /* Checkmark color */
}



</style>


<div class="custom-dropdown">
  <button class="dropdown-toggle" id="dropdownButton">by Popularity</button>
  <div class="dropdown-menu" id="dropdownMenu">
    <div class="dropdown-item" data-value="by Popularity">by Popularity</div>
    <div class="dropdown-item" data-value="by Likes">by Likes</div>
    <div class="dropdown-item" data-value="by Date">by Date</div>
  </div>
</div>


<script>
    // Get elements
const dropdownMenu = document.getElementById("dropdownMenu");
const dropdownButton = document.getElementById("dropdownButton");
const dropdownItems = document.querySelectorAll(".dropdown-item");

// Default selection (by Popularity)
dropdownItems.forEach(item => {
  if (item.getAttribute("data-value") === "by Popularity") {
    item.classList.add("selected");
  }
});

// Add event listeners to items
dropdownItems.forEach(item => {
  item.addEventListener("click", function () {
    // Update button text
    dropdownButton.textContent = this.getAttribute("data-value");

    // Remove 'selected' class from all items
    dropdownItems.forEach(i => i.classList.remove("selected"));

    // Add 'selected' class to clicked item
    this.classList.add("selected");
  });
});

</script>