<?php

session_start();


// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "todoApp");
if (!$conn) {
    echo "Failed to connect to the database: " . mysqli_connect_error($conn);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title  = htmlspecialchars(htmlentities($_POST["title"]));

    // Correct the SQL syntax
    $query = "INSERT INTO `tasks` (`title`) VALUES ('$title')";

    $result = mysqli_query($conn, $query);
    if ($result && mysqli_affected_rows($conn) == 1) {
        $_SESSION["success"] = 'data insertesd successfully';
    }

    //redirection 
    header("location:../index.php");
}
