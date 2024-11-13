<script>
    let variationFormCount = 0;

function addVariationForm() {
    variationFormCount++;

    const variationForm = document.createElement("div");
    variationForm.className = "variation-form";
    variationForm.id = `variation-form-${variationFormCount}`;

    variationForm.innerHTML = `
        <div class="variation-header">
            <span id="variation-title-${variationFormCount}" class="fw-bold fs-5">Variation ${variationFormCount}</span>
            <button type="button" class="variation-btn rename" onclick="renameVariation(${variationFormCount})">
                <i class="fa-solid fa-pen"></i>
            </button>
        </div>
        <div class="containerrach mt-1 mb-3 text-muted">
            <span class="label">How do you want this variation to be selected by customers?</span>
            <div class="radio-group">
                <input type="radio" id="single_selection" name="selection_type_${variationFormCount}" value="single">
                <label for="single_selection">Single Selection</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="multiple_selection" name="selection_type_${variationFormCount}" value="multiple">
                <label for="multiple_selection">Multiple Selection</label>
            </div>
        </div>

        <div class="variation-rows-container" id="variation-rows-container-${variationFormCount}">
            ${createVariationRow(variationFormCount, 1)}
            ${createVariationRow(variationFormCount, 2)}
            ${createVariationRow(variationFormCount, 3)}
        </div>
        <div class="d-flex justify-content-between align-items-center hech mt-3">
            <div class="checkbox-group">
                <input type="checkbox" id="is_required_${variationFormCount}" name="is_required_${variationFormCount}">
                <label for="is_required_${variationFormCount}">Customer is required to select</label>
            </div>
            <div class="variation-btn-group">
                <button type="button" class="variation-btn addrem" onclick="addVariationRow(${variationFormCount})">Add New Row</button>
                <button type="button" class="variation-btn addrem" onclick="removeVariationForm(${variationFormCount})">Remove Variation</button>
            </div>
        </div>
    `;

    document.getElementById("variation-forms-list").appendChild(variationForm);
}

function createVariationRow(variationFormId, rowId = Date.now()) {
    return `
        <div class="variation-row" id="variation-row-${variationFormId}-${rowId}">
            <div class="variationimage text-center py-2" id="variationimageContainer-${variationFormId}-${rowId}">
                <i class="fa-solid fa-arrow-up-long mb-1"></i>
                <label for="variationimage-${variationFormId}-${rowId}">Variation Image</label>
                <input type="file" id="variationimage-${variationFormId}-${rowId}" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displaySelectedImage(${variationFormId}, ${rowId})">
            </div>

            <input type="text" name="variation_name_${variationFormId}[]" placeholder="Variation Name">

            <div class="d-flex align-items-center addpeso" data-bs-toggle="tooltip" data-bs-placement="top" title="This will be added to the selling price">
                <input type="number" name="variation_additional_price_${variationFormId}[]" placeholder="0.00" min="0" step="0.01">
            </div>
            <div class="d-flex align-items-center minuspeso" data-bs-toggle="tooltip" data-bs-placement="top" title="This will be minus to the selling price">
                <input type="number" name="variation_subtract_price_${variationFormId}[]" placeholder="0.00" min="0" step="0.01">
            </div>

            <button type="button" class="variation-btn delete" onclick="removeVariationRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    `;
}

function displaySelectedImage(variationFormId, rowId) {
    const inputFile = document.getElementById(`variationimage-${variationFormId}-${rowId}`);
    const imageContainer = document.getElementById(`variationimageContainer-${variationFormId}-${rowId}`);

    if (inputFile.files && inputFile.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imageContainer.style.backgroundImage = `url(${e.target.result})`;
            imageContainer.style.backgroundSize = 'cover';
            imageContainer.style.backgroundPosition = 'center';
        };
        reader.readAsDataURL(inputFile.files[0]);
    }
}

function addVariationRow(variationFormId) {
    const rowId = Date.now();
    const variationRowsContainer = document.getElementById(`variation-rows-container-${variationFormId}`);
    variationRowsContainer.insertAdjacentHTML("beforeend", createVariationRow(variationFormId, rowId));
}

function removeVariationRow(button) {
    const variationRow = button.parentNode;
    variationRow.remove();
}

function removeVariationForm(variationFormId) {
    const variationForm = document.getElementById(`variation-form-${variationFormId}`);
    variationForm.remove();
}

function renameVariation(variationFormId) {
    const newTitle = prompt("Enter a new name for this variation:");
    if (newTitle && newTitle.trim()) {
        document.getElementById(`variation-title-${variationFormId}`).textContent = newTitle.trim();
    }
}

</script>