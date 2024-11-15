<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
?>
<style>
    main{
        padding: 40px 200px
    }
    .choice-group-image {
        background-image: url('assets/images/foodpark.jpg');
        background-size: cover;
        background-position: center;
        height: 80px;
        width: 80px;
    }
</style>
<div class="prohelp d-flex align-items-center gap-4 justify-content-center">
    <span class="helpspn">HELP</span>
    <p class="m-0">Edit the details of this choice group to update it in your inventory.</p>
    <a href="">Terms and Conditions <i class="fa-solid fa-arrow-right"></i></a>
</div>
<main>
    <form id="choice-group-form" class="choice-group-form">
        <div class="choice-group-header">
            <span id="choice-group-title" class="fw-bold fs-5">Choice of First Pizza</span>
            <button type="button" class="choice-group-btn rename" onclick="renameChoiceGroup()">
                <i class="fa-solid fa-pen"></i>
            </button>
        </div>
        <div class="containerrach mt-1 mb-3 text-muted">
            <span class="label">How do you want this choice group to be selected by customers?</span>
            <div class="radio-group">
                <input type="radio" id="single_selection" name="selection_type" value="single" checked>
                <label for="single_selection">Single Selection</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="multiple_selection" name="selection_type" value="multiple">
                <label for="multiple_selection">Multiple Selection</label>
            </div>
        </div>

        <div class="choice-group-rows-container my-2" id="choice-group-rows-container">
            <!-- Sample choice group rows with edit mode pre-populated -->
            <?php 
                $choices = [
                    ["Pepperoni", 120],
                    ["Hawaiian", 100],
                    ["Vegetarian Special", 150],
                    ["Meat Special", 150],
                    ["Tomatoes", 150]
                ];
                foreach ($choices as $index => $choice) {
                    echo '
                    <div class="choice-group-row" id="choice-group-row-'.($index+1).'">
                        <div class="choice-group-image text-center" id="choice-group-imageContainer-'.($index+1).'" onclick="triggerFileInput('.($index+1).')">
                            <div class="overlay">
                                <i class="fa-solid fa-arrow-up-long mb-1"></i><br>
                                <span>Choice Image</span>
                            </div>
                            <input type="file" id="choice-group-image-'.($index+1).'" accept="image/jpeg, image/png, image/jpg" style="display:none;" onchange="displaySelectedImage('.($index+1).')">
                        </div>
                        <input type="text" name="choice_group_name[]" value="'.$choice[0].'" placeholder="Choice Group Name">
                        <div class="d-flex align-items-center addpeso">
                            <input type="number" name="choice_group_additional_price[]" value="'.$choice[1].'" placeholder="0.00" min="0" step="0.01">
                        </div>
                        <div class="d-flex align-items-center minuspeso">
                            <input type="number" name="choice_group_subtract_price[]" placeholder="0.00" min="0" step="0.01">
                        </div>
                        <select name="choice_group_availability[]" class="availability-dropdown">
                            <option value="available" selected><i class="fa-solid fa-circle"></i> Available</option>
                            <option value="unavailable"><i class="fa-solid fa-circle"></i> Unavailable</option>
                        </select>
                        <button type="button" class="choice-group-btn delete" onclick="removeChoiceGroupRow(this)">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>';
                }
            ?>
        </div>

        <div class="d-flex justify-content-between align-items-center hech mt-3">
            <div class="checkbox-group">
                <input type="checkbox" id="is_required" name="is_required" checked>
                <label for="is_required">Customer is required to select</label>
            </div>
            <button type="button" class="choice-group-btn addrem" onclick="addChoiceGroupRow()">Add New Row</button>
        </div>

        <hr>
        <button type="submit" class="btn btn-primary send mt-2">UPDATE GROUP CHOICE</button><br><br><br><br>
    </form>
</main> 

<?php
    include_once './footer.php'; 
?> 

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
            imageContainer.querySelector('.overlay').style.display = 'none'; 
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
            <div class="d-flex align-items-center addpeso">
                <input type="number" name="choice_group_additional_price[]" placeholder="0.00" min="0" step="0.01">
            </div>
            <div class="d-flex align-items-center minuspeso">
                <input type="number" name="choice_group_subtract_price[]" placeholder="0.00" min="0" step="0.01">
            </div>
            <select name="choice_group_availability[]" class="availability-dropdown">
                <option value="available"><i class="fa-solid fa-circle"></i> Available</option>
                <option value="unavailable"><i class="fa-solid fa-circle"></i> Unavailable</option>
            </select>
            <button type="button" class="choice-group-btn delete" onclick="removeChoiceGroupRow(this)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    `;
}
</script>
