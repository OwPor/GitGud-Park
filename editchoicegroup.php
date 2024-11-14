<?php
    include_once 'links.php'; 
    include_once 'header.php'; 
?>
<style>
    main{
        padding: 40px 200px
    }
</style>
<div class="prohelp d-flex align-items-center gap-4 justify-content-center">
    <span class="helpspn">HELP</span>
    <p class="m-0">Provide all the necessary information in the fields below to successfully add a new choice group to your inventory.</p>
    <a href="">Terms and Conditions <i class="fa-solid fa-arrow-right"></i></a>
</div>
<main>
    <form id="choice-group-form" class="choice-group-form">
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
                <select name="choice_group_availability[]" class="availability-dropdown">
                    <option value="available"><i class="fa-solid fa-circle"></i> Available</option>
                    <option value="unavailable"><i class="fa-solid fa-circle"></i> Unavailable</option>
                </select>
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
                <select name="choice_group_availability[]" class="availability-dropdown">
                    <option value="available"><i class="fa-solid fa-circle"></i> Available</option>
                    <option value="unavailable"><i class="fa-solid fa-circle"></i> Unavailable</option>
                </select>
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
                <select name="choice_group_availability[]" class="availability-dropdown">
                    <option value="available"><i class="fa-solid fa-circle"></i> Available</option>
                    <option value="unavailable"><i class="fa-solid fa-circle"></i> Unavailable</option>
                </select>
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

        <hr>
        <button type="submit" class="btn btn-primary send mt-2">CREATE GROUP CHOICE</button><br><br><br><br>
    </form>
    <script src="./assets/js/editchoicegroup.js?v=<?php echo time(); ?>"></script>
</main> 

<?php
    include_once './footer.php'; 
?>
