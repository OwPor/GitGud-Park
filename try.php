<?php
    session_start();

    include_once 'links.php'; 
    include_once 'bootstrap.php'; 
    include_once 'secondheader.php';

    require_once './classes/db.class.php';
    require_once './classes/park.class.php';

    $userObj = new User();
    $parkObj = new Park();

    $stalllogo = $businessname = $description = $businessemail = $businessphonenumber = $website = '';

    if (isset($_GET['owner_email']) && isset($_GET['owner_id']) && isset($_GET['park_id'])) {
        $owner_email = $_GET['owner_email'];
        $owner_id = $_GET['owner_id'];
        $park_id = $_GET['park_id'];

        $user = $userObj->getUser($owner_id);
    } 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $businessname = clean_input($_POST['businessname']);
        $description = clean_input($_POST['description']);
        $businessemail = clean_input($_POST['businessemail']);
        $businessphonenumber = clean_input($_POST['businessphonenumber']);
        $website = clean_input($_POST['website']);

        if (isset($_FILES['stalllogo']) && $_FILES['stalllogo']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/business/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            $fileExtension = pathinfo($_FILES['stalllogo']['name'], PATHINFO_EXTENSION);
            $uniqueFileName = uniqid('stall_', true) . '.' . $fileExtension;
            $uploadPath = $uploadDir . $uniqueFileName;
    
            if (move_uploaded_file($_FILES['stalllogo']['tmp_name'], $uploadPath)) {
                $stalllogo = $uploadPath; // Store path in DB
            }
        }

        $operatingHoursJson = $_POST['operating_hours'];
        $operatingHours = json_decode($operatingHoursJson, true);

        $stall = $parkObj->addStall($owner_id, $park_id, $businessname, $description, $businessemail, $businessphonenumber, $website, $stalllogo, $operatingHours);

    }
    
?>

<div class="form-group m-0 select2Part select2multiple w-100 floating-group">
    <label class="floating-label">Categories <span style="color: #CD5C08;">*</span></label>
    <select name="categories" id="categories" class="form-control customSelectMultiple floating-control" multiple>
        <option value="Category">Drinks</option>
        <option value="Category">Vegetables</option>
        <option value="Category">Desserts</option>
    </select>
</div>

<script>
    $(document).ready(function() {
    $('.customSelectMultiple').each(function() {
        var dropdownParents = $(this).parents('.select2Part');

        $(this).select2({
            dropdownParent: dropdownParents,
        });

        if ($(this).val() && $(this).val().length > 0) {
            $(this).parents('.form-group').addClass('focused');
        }

        $(this)
            .on("select2:open", function () {
                $(this).parents('.form-group').addClass('focused');
            })
            .on("select2:close", function () {
                if ($(this).val() && $(this).val().length > 0) {
                    $(this).parents('.form-group').addClass('focused');
                } else {
                    $(this).parents('.form-group').removeClass('focused');
                }
            })
            .on("select2:select", function () {
                $(this).parents('.form-group').addClass('focused');
            })
            .on("select2:unselect", function () {
                if ($(this).val() && $(this).val().length > 0) {
                    $(this).parents('.form-group').addClass('focused');
                } else {
                    $(this).parents('.form-group').removeClass('focused');
                }
            });
    });
});
</script>

<?php

// in park.class.php

function addStall($user_id, $park_id, $businessname, $description, $businessemail, $businessphonenumber, $website, $stalllogo, $operatingHours) { 

    $conn = $this->db->connect(); 

    $sql = "INSERT INTO stalls (user_id, park_id, name, description, email, phone, website, logo) 
            VALUES (:user_id, :park_id, :businessname, :description, :businessemail, :businessphonenumber, :website, :stalllogo);";
    
    $query = $conn->prepare($sql);

    if ($query->execute(array(
        ':user_id' => $user_id,
        ':park_id' => $park_id,
        ':businessname' => $businessname,
        ':description' => $description,
        ':businessemail' => $businessemail,
        ':businessphonenumber' => $businessphonenumber,
        ':website' => $website,
        ':stalllogo' => $stalllogo
    ))) {

        $stall_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO stall_operating_hours (stall_id, days, open_time, close_time) VALUES (:stall_id, :days, :open_time, :close_time)");

        foreach ($operatingHours as $schedule) {
            $days = implode(', ', $schedule['days']);
            $openTime = $schedule['openTime'];
            $closeTime = $schedule['closeTime'];
    
            $stmt->execute(array(
                ':stall_id' => $stall_id,
                ':days' => $days,
                ':open_time' => $openTime,
                ':close_time' => $closeTime
            ));
        }
    }

}
?>