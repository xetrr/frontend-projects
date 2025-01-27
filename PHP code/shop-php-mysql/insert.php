<?php

include('db.php');
if (isset($_POST["upload"])) {
    $NAME = $_POST["name"];
    $PRICE = $_POST["price"];
    $IMAGE = $_FILES["image"];
    $IMAGE_LOCATION = $_FILES['image']['tmp_name'];
    $IMAGE_NAME = $_FILES['image']['name'];
    $IMAGE_UP = "img/" . $IMAGE_NAME;
    $insert = "INSERT INTO `prod` (`name`, `price`, `image`) VALUES ('$NAME', '$PRICE', '$IMAGE_UP')";
    mysqli_query($conn, $insert);
    if (move_uploaded_file($IMAGE_LOCATION, "img/" . $IMAGE_NAME)) {
        echo "<script> alert('uploaded successfully')</script>";
        header('location:products.php');
    } else {
        echo "<script> alert('uploaded failed')</script>";
    }
}
