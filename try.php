<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Choice Group</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Add your CSS styling here */
        .choice-group-form { padding: 20px; border: 1px solid #ccc; margin-bottom: 20px; }
        .choice-group-header { display: flex; align-items: center; justify-content: space-between; }
        .choice-group-image { width: 100px; height: 100px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .choice-group-image .overlay { display: flex; flex-direction: column; align-items: center; }
        .choice-group-row { display: flex; align-items: center; gap: 10px; margin-top: 10px; }
        .choice-group-btn { cursor: pointer; padding: 5px 10px; border: none; background-color: #ddd; }
        .choice-group-btn.delete { color: red; }
    </style>
</head>
<body>

<div id="choice-group-form" class="choice-group-form">
    <div class="choice-group-header">
        <span id="choice-group-title" class="fw-bold fs-5">Choice Group</span>
        <button type="button" class="choice-group-btn rename" onclick="renameChoiceGroup()">
            <i class="fa-solid fa-pen"></i>
        </button>
    </div>
    <div class="containerrach mt-1 mb-3 text-muted">
        <span class="label">How do you want this choice group to be selected by customers?</span>
        <div class="radio-group">
            <input type="radio" id="single_selection" name="selection_type" value="single">
            <label for="single_selection">Single Selection</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="multiple_selection" name="selection_type" value="multiple">
            <label for="multiple_selection">Multiple Selection</label>
        </div>
    </div>

    <div class="choice-group-rows-container my-2" id="choice-group-rows-container">
        <!-- Initial choice group rows -->
        <div class="choice-group-row" id="choice-group-row-1">
            <div class="choice-group-image text-center" id="choice-group-imageContainer-1" onclick="triggerFileInput(1)">
                <div class="overlay">
                    <i class="fa-solid fa-arrow-up-long mb-1"></i><br>
                    <span>Choice Image</span>
                </div>
                <input type="file" id="choice-group-image-1" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displaySelectedImage(1)">
            </div>
            <input type="text" name="choice_group_name[]" placeholder="Choice Group Name">
            <input type="number" name="choice_group_additional_price[]" placeholder="0.00" min="0" step="0.01">
            <input type="number" name="choice_group_subtract_price[]" placeholder="0.00" min="0" step="0.01">
            <button type="button" class="choice-group-btn delete" onclick="removeChoiceGroupRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="choice-group-row" id="choice-group-row-2">
            <div class="choice-group-image text-center" id="choice-group-imageContainer-2" onclick="triggerFileInput(2)">
                <div class="overlay">
                    <i class="fa-solid fa-arrow-up-long mb-1"></i><br>
                    <span>Choice Image</span>
                </div>
                <input type="file" id="choice-group-image-2" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displaySelectedImage(2)">
            </div>
            <input type="text" name="choice_group_name[]" placeholder="Choice Group Name">
            <input type="number" name="choice_group_additional_price[]" placeholder="0.00" min="0" step="0.01">
            <input type="number" name="choice_group_subtract_price[]" placeholder="0.00" min="0" step="0.01">
            <button type="button" class="choice-group-btn delete" onclick="removeChoiceGroupRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="choice-group-row" id="choice-group-row-3">
            <div class="choice-group-image text-center" id="choice-group-imageContainer-3" onclick="triggerFileInput(3)">
                <div class="overlay">
                    <i class="fa-solid fa-arrow-up-long mb-1"></i><br>
                    <span>Choice Image</span>
                </div>
                <input type="file" id="choice-group-image-3" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displaySelectedImage(3)">
            </div>
            <input type="text" name="choice_group_name[]" placeholder="Choice Group Name">
            <input type="number" name="choice_group_additional_price[]" placeholder="0.00" min="0" step="0.01">
            <input type="number" name="choice_group_subtract_price[]" placeholder="0.00" min="0" step="0.01">
            <button type="button" class="choice-group-btn delete" onclick="removeChoiceGroupRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center hech mt-3">
        <div class="checkbox-group">
            <input type="checkbox" id="is_required" name="is_required">
            <label for="is_required">Customer is required to select</label>
        </div>
        <button type="button" class="choice-group-btn addrem" onclick="addChoiceGroupRow()">Add New Row</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
function triggerFileInput(rowId) {
    const inputFile = document.getElementById(`choice-group-image-${rowId}`);
    inputFile.value = ''; // Reset input to allow re-upload
    inputFile.click();
}

function displaySelectedImage(rowId) {
    const inputFile = document.getElementById(`choice-group-image-${rowId}`);
    const imageContainer = document.getElementById(`choice-group-imageContainer-${rowId}`);

    if (inputFile.files && inputFile.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imageContainer.style.backgroundImage = `url(${e.target.result})`;
            imageContainer.querySelector('.overlay').style.display = 'none'; // Hide overlay
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
}

function addChoiceGroupRow() {
    const rowId = Date.now();
    const choiceGroupRowsContainer = document.getElementById("choice-group-rows-container");
    choiceGroupRowsContainer.insertAdjacentHTML("beforeend", createChoiceGroupRow(rowId));
}

function removeChoiceGroupRow(button) {
    const choiceGroupRow = button.parentNode;
    choiceGroupRow.remove();
}

function renameChoiceGroup() {
    const newTitle = prompt("Enter a new name for this choice group:");
    if (newTitle && newTitle.trim()) {
        document.getElementById("choice-group-title").textContent = newTitle.trim();
    }
}

function createChoiceGroupRow(rowId) {
    return `
        <div class="choice-group-row" id="choice-group-row-${rowId}">
            <div class="choice-group-image text-center" id="choice-group-imageContainer-${rowId}" onclick="triggerFileInput(${rowId})">
                <div class="overlay">
                    <i class="fa-solid fa-arrow-up-long mb-1"></i><br>
                    <span>Choice Image</span>
                </div>
                <input type="file" id="choice-group-image-${rowId}" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displaySelectedImage(${rowId})">
            </div>
            <input type="text" name="choice_group_name[]" placeholder="Choice Group Name">
            <input type="number" name="choice_group_additional_price[]" placeholder="0.00" min="0" step="0.01">
            <input type="number" name="choice_group_subtract_price[]" placeholder="0.00" min="0" step="0.01">
            <button type="button" class="choice-group-btn delete" onclick="removeChoiceGroupRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    `;
}
</script>

