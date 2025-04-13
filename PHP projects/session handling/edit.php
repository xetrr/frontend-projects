<?php
include('config.php');
session_start();
$user_id  = $_SESSION["user_id"];
if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST["update"])) {
    $update_name = mysqli_real_escape_string($conn, $_POST["update_name"]);
    $update_email = mysqli_real_escape_string($conn, $_POST["update_email"]);
    mysqli_query($conn, "UPDATE `user_from` SET `name`='$update_name',`email`='$update_email'
     WHERE  id = '$user_id'");


    $old_pass = $_POST["old_pass"];
    $update_pass = mysqli_real_escape_string($conn, $_POST["old_pass"]);
    $new_pass = mysqli_real_escape_string($conn, $_POST["new_pass"]);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST["confirm_pass"]);

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $message[] = 'old password not matched';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'confrim password not matched';
        } else {
            mysqli_query($conn, "UPDATE `user_from` SET `password`='$new_pass'
     WHERE  id = '$user_id'");
            $message[] = 'password updated!';
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    $query = "SELECT * FROM `user_from` WHERE id = '$user_id'";
    $select = mysqli_query($conn, $query);
    if (mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    }


    ?>

    <center>

        <?php
        if ($fetch['image'] == '') {
            echo '<img src="images/default.jpg" alt="" style="max-width: 300px ; max-height: 200px">';
        } else {
            echo '<img src="uploaded/' . $fetch['image'] . '" alt="" style="max-width: 300px ; max-height: 200px">';
        }
        if (isset($message)) {

            foreach ($message as $message) {
                echo "<div class= 'message'>$message</div>";
            }
        } ?>
        <form action="" method="post" enctype="multipart/form-data" style="max-width:400px ;">
            <div class=" form-group">
                <input type="hidden" name="old_pass" value="<?php echo $fetchp['password'] ?>">
                <input type="text" class="form-control" value="<?php echo $fetch['name'] ?>" name="update_name">
            </div>
            <div class=" form-group">
                <input type="email" class="form-control" value="<?php echo $fetch['email'] ?>" name="update_email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="old_pass" placeholder="old_password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="new_pass" placeholder="new_password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_pass" placeholder="confirm_password">
            </div>

            <input type="submit" value="update profile" name="update" class=" mt-5 btn btn-primary">
        </form>
    </center>
</body>

</html>