<?php

include('db.php');
if (isset($_POST["add"])) {
    $NAME = $_POST["name"];
    $PRICE = $_POST["price"];
    $insert = "INSERT INTO `cart` (`name`, `price`) VALUES ('$NAME', '$PRICE')";
    mysqli_query($conn, $insert);
    header('location:card.php');
}
