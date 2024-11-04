<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>


.form-area {display: flex; font-family: 'Roboto', sans-serif;}
.form-group{position: relative;}
.floating-label {
    font-size: 16px;
    font-weight: 400;
    color: #475F7B;
    opacity: 1;
    top: 16px;
    left: 20px;
    pointer-events: none;
    position: absolute;
    transition: 240ms;
    margin-bottom: 0;
    z-index: 1;
}
.form-group.focused .floating-label {
    opacity: 1;
    color: #7b7f82;
    top: 4px;
    left: 19px;
    font-size: 12px;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered{
    color: #757575;
    line-height: 55px;
    padding-right: 40px;
    display: block;
    height: 100%;
    padding-bottom: 7px;
    padding-top: 17px;
    padding-left: 17px;
    transition: 240ms;
}
.select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field{
    line-height: initial;
    padding: 0;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;
    line-height: initial;
    padding: 5px;
    font-size: 14px;
    position: relative;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #f1f1f1;
    border: 1px solid #f1f1f1;
    border-radius: 4px;
    cursor: default;
    float: left;
    color: #1f1f1f;
    margin-right: 5px;
    margin-top: 5px;
    width: initial !important;
    padding: 5px 10px;
    padding-right: 24px !important;
    font-size: 13px !important;
    letter-spacing: 0.3px;
}
.select2-container--default .select2-search--inline .select2-search__field{
    width: 100% !important;
    font-size: 16px;
    margin-top: 0px;
    padding: 0;
    padding-left: 5px;
    line-height: 27px;
    padding-top: 6px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    position: absolute;
    font-size: 17px;
    width: 20px;
    height: 20px;
    top: 3px;
    text-align: center;
    color: #e45555;
    right: 0px;
}
</style>
<div class="form-area">
    <div class="form-group m-0 select2Part select2multiple w-100 floating-group">
        <label class="floating-label">Select Tags</label>
        <select name="" id="" class="form-control customSelectMultiple floating-control" multiple>
            <option value="Afganistan">Afghanistan</option>
            <option value="Albania">Albania</option>
            <option value="India">India</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
        </select>
    </div>
</div>

<script>
$(document).ready(function() {
	$('.customSelectMultiple').each(function() {
		var dropdownParents = $(this).parents('.select2Part');
		$(this).select2({
			dropdownParent: dropdownParents,
		}).on("select2:open", function (e) { 
			$(this).parents('.floating-group').addClass('focused');
		}).on("select2:close", function (e) {
			if($(this).val() != ''){
				$(this).parents('.floating-group').addClass('focused');
			}else{
				$(this).parents('.floating-group').removeClass('focused');
			}
		}).on("select2:select", function (e) { 
			$(this).parents('.floating-group').addClass('focused');
		}).on("select2:unselect", function (e) {
			$(this).parents('.floating-group').addClass('focused');
		})
	});
});
</script>