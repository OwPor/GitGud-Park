<div class="input-group m-0">
    <label for="">Variants (Optional)</label>
    <div class="variation-container">
        <div class="d-flex justify-content-end">
            <button type="button" class="variation-btn addvar" onclick="addVariationForm()">+ Add Variation</button>
        </div>
        <div class="variation-forms-wrapper" id="variation-forms-list"></div>
    </div>
</div>

<script>
let variationFormCount = 0;

function addVariationForm() {
    variationFormCount++;

    // Create the variation form container
    const variationForm = document.createElement("div");
    variationForm.className = "variation-form";
    variationForm.id = `variation-form-${variationFormCount}`;

    // Set the HTML content for the form
    variationForm.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <div class="variation-header">
                <span id="variation-title-${variationFormCount}" class="fw-bold fs-5">Variation ${variationFormCount}</span>
                <button type="button" class="variation-btn rename" onclick="renameVariation(${variationFormCount})">
                    <i class="fa-solid fa-pen"></i>
                </button>
            </div>
            <div class="variation-btn-group">
                <button type="button" class="variation-btn addrem" onclick="addVariationRow(${variationFormCount})">Add New Row</button>
                <button type="button" class="variation-btn addrem" onclick="removeVariationForm(${variationFormCount})">Remove Variation</button>
            </div>
        </div>

        <!-- Selection Type Options -->
        <div class="d-flex align-items-center mb-2">
            <label class="me-2">Selection Type:</label>
            <div class="form-check me-2">
                <input class="form-check-input" type="radio" name="selection_type_${variationFormCount}" value="single" checked>
                <label class="form-check-label">Single Selection</label>
            </div>
            <div class="form-check me-2">
                <input class="form-check-input" type="radio" name="selection_type_${variationFormCount}" value="multiple">
                <label class="form-check-label">Multiple Selection</label>
            </div>
            <!-- Required Option -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_required_${variationFormCount}" id="is-required-${variationFormCount}">
                <label class="form-check-label" for="is-required-${variationFormCount}">Required</label>
            </div>
        </div>

        <div class="variation-rows-container" id="variation-rows-container-${variationFormCount}">
            ${createVariationRow(variationFormCount)}
            ${createVariationRow(variationFormCount)}
            ${createVariationRow(variationFormCount)}
        </div>
    `;

    // Append the new form to the variations list
    document.getElementById("variation-forms-list").appendChild(variationForm);
}

function createVariationRow(variationFormId) {
    return `
        <div class="variation-row">
            <div class="variationimage text-center py-2" id="variationimageContainer">
                <i class="fa-solid fa-arrow-up-long mb-1"></i>
                <label for="variationimage">Variation Image</label>
                <input type="file" id="variationimage" accept="image/jpeg, image/png, image/jpg" style="display:none;">
            </div>
            <input type="text" name="variation_name_${variationFormId}[]" placeholder="Variation Name" class="form-control mb-2">
            
            <!-- Additional Price Inputs -->
            <div class="d-flex align-items-center mb-2">
                <label class="me-2">Price Adjustment:</label>
                <div class="d-flex align-items-center me-2">
                    <span>+</span>
                    <span>₱</span>
                    <input type="number" name="variation_additional_price_${variationFormId}[]" placeholder="Add Price" min="0" step="0.01" class="form-control" style="width: 80px;">
                </div>
                <div class="d-flex align-items-center">
                    <span>-</span>
                    <span>₱</span>
                    <input type="number" name="variation_subtract_price_${variationFormId}[]" placeholder="Subtract Price" min="0" step="0.01" class="form-control" style="width: 80px;">
                </div>
            </div>

            <button type="button" class="variation-btn delete" onclick="removeVariationRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    `;
}

function addVariationRow(variationFormId) {
    const variationRowsContainer = document.getElementById(`variation-rows-container-${variationFormId}`);
    variationRowsContainer.insertAdjacentHTML("beforeend", createVariationRow(variationFormId));
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
