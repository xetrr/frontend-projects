<?php

session_start();


if (isset($_GET["id"])) {
    $conn = mysqli_connect("localhost", "root", "", "todoApp");
    if (!$conn) {
        echo "Failed to connect to the database: " . mysqli_connect_error($conn);
        exit();
    }
    $id = $_GET["id"];
    echo $id;
    $query = "DELETE FROM `tasks` where `id` = '$id'";
    $result  = mysqli_query($conn, $query);
    header("location:../index.php");
}
