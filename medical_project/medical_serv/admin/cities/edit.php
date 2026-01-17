<?php
require "../../config.php";
require BLA . "inc/header.php";
require BL . 'functions/validate.php';
?>


<?php
if (isset($_POST["submit"])) {
    $name = $_POST["city"];
    if (!isEmpty($_POST["city"]) && isGreaterThan($name, 3)) {
        $sql  = "INSERT INTO cities (`city_name`) VALUES ('$name')";
        $success_message  = db_insert($sql);
    } else {
        $error_message = "Enter a valid city name!";
    }
} else {
    $error_message = "All input fields are required!";
    require BL . 'functions/messages.php';
}

?>

<div class="col-sm-6 offset-sm-3 border p-3">
    <h3 class="text-center p-3 bg-primary text-white">Edit city</h3>
    <form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="form-group">
            <label for="">name of the city</label>
            <input type="text" name="city" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-success">Save</button>
    </form>
</div>


<?php require BLA . "inc/footer.php"; ?>