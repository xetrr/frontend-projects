<?php
include('db.php');
$id = $_GET["id"];
$delete = "DELETE FROM `cart` WHERE id=$id";
mysqli_query($conn, $delete);
header('location:card.php');
