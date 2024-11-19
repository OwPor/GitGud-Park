// Select All checkbox
function toggleSelectAll(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.item-checkbox, .stall-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
}

// Stall-specific checkbox
function toggleStallItems(stallCheckbox, stallClass) {
    const items = document.querySelectorAll(`.${stallClass} .item-checkbox`);
    items.forEach(item => {
        item.checked = stallCheckbox.checked;
    });
}
function updateQuantity(button, change) {
    const quantitySpan = button.parentElement.querySelector('.ordquanum');
    let quantity = parseInt(quantitySpan.innerText);
    quantity = Math.max(1, quantity + change);
    quantitySpan.innerText = quantity;
}

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