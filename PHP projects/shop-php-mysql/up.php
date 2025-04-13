<?php
include('db.php');
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $NAME = $_POST["name"];
    $PRICE = $_POST["price"];
    $IMAGE = $_FILES["image"];
    $IMAGE_LOCATION = $_FILES['image']['tmp_name'];
    $IMAGE_NAME = $_FILES['image']['name'];
    $IMAGE_UP = "img/" . $IMAGE_NAME;
    $update = "UPDATE `prod` SET `name`='$NAME',`price`
    ='$PRICE',`image`='$IMAGE_UP' WHERE id = $id";
    mysqli_query($conn, $update);
    if (move_uploaded_file($IMAGE_LOCATION, "img/" . $IMAGE_NAME)) {
        echo "<script> alert('updated successfully')</script>";
        header('location:products.php');
    } else {
        echo "<script> alert('update failed')</script>";
        header('location:products.php');
    }
}
