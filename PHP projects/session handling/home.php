<?php
include('config.php');
session_start();
$user_id  = $_SESSION["user_id"];
if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_GET["logout"])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="home.php">home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="edit.php">edit</a>
        </li>

    </ul>

    <div class="container">
        <div class="profile">
            <?php
            $query = "SELECT * FROM `user_from` WHERE id = '$user_id'";
            $select = mysqli_query($conn, $query);
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            } ?>

            <center>
                <?php if ($fetch['image'] == '') {
                    echo '<img src="images/default.jpg" alt="" style="max-width: 300px ; max-height: 200px">';
                } else {
                    echo '<img src="uploaded/' . $fetch['image'] . '" alt="" style="max-width: 300px ; max-height: 200px">';
                }
                ?>
                <h3><?php echo $fetch['name']; ?></h3>
                <a href="edit.php" class="btn btn-primary"> update profile</a>
                <a href="home.php?logout=<?php $user_id; ?>" class="btn btn-danger"> logout</a>
            </center>
        </div>
    </div>
</body>

</html>