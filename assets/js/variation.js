let variationFormCount = 0;

    function addVariationForm() {
        variationFormCount++;

        // Create the variation form container
        const variationForm = document.createElement("div");
        variationForm.className = "variation-form";
        variationForm.id = `variation-form-${variationFormCount}`;

        // Set the HTML content for the form
        variationForm.innerHTML = `
            <div class="variation-header">
                <span id="variation-title-${variationFormCount}">Variation ${variationFormCount}</span>
                <button class="variation-btn rename" onclick="renameVariation(${variationFormCount})"><i class="fa-solid fa-pen"></i></button>
            </div>
            <div class="variation-rows-container" id="variation-rows-container-${variationFormCount}">
                ${createVariationRow(variationFormCount)}
                ${createVariationRow(variationFormCount)}
                ${createVariationRow(variationFormCount)}
            </div>
            <div class="variation-btn-group">
                <button class="variation-btn addrem" onclick="addVariationRow(${variationFormCount})">Add New Row</button>
                <button class="variation-btn addrem" onclick="removeVariationForm(${variationFormCount})">Remove Variation</button>
            </div>
        `;

        // Append the new form to the variations list
        document.getElementById("variation-forms-list").appendChild(variationForm);
    }

    function createVariationRow(variationFormId) {
        return `
            <div class="variation-row">
                <input type="text" name="variation_name_${variationFormId}[]" placeholder="Variation Name">
                <input type="number" name="variation_price_${variationFormId}[]" placeholder="Additional Price" min="0" step="0.01">
                <button type="button" class="variation-btn delete" onclick="removeVariationRow(this)"><i class="fa-solid fa-xmark"></i></button>
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