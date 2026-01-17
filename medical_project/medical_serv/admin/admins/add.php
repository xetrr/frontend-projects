<?php
require "../../config.php";
require BLA . "inc/header.php";
require BL . 'functions/validate.php';
?>




<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email =  $_POST["email"];
    $password =  $_POST["password"];
    if (checkEmpty($name) and checkEmpty($email) and checkEmpty($password)) {
        if (isValidEmail($email)) {
            $newPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql  = "INSERT INTO admins (`admin_name` , `admin_email`, `admin_password`) VALUES ('$name','$email','$newPassword')";
            $success_message  = db_insert($sql);
        } else {
            $error_message = "Enter a valid Email!";
        }
    } else {
        $error_message = "All input fields are required!";
    }
    require BL . 'functions/messages.php';
}
?>






<div class="col-sm-6 offset-sm-3 border p-3">
    <h3 class="text-center p-3 bg-primary text-white">Add new admin</h3>
    <form class="row g-3" action="" method="POST">
        <div class="form-group">
            <label for="">name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="">password</label>
            <input type="text" name="password" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Save</button>
    </form>
</div>

<?php require BLA . "inc/footer.php"; ?>