<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        .card {
            float: right;
            margin-top: 30px;
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <center>
        <h3>All Products</h3>
    </center>
    <?php
    $products = "SELECT * FROM `prod`";
    $result = mysqli_query($conn, $products);
    while ($row = mysqli_fetch_array($result)) {
        echo " 
        <center>
            <main>
                <div class='card' style='width: 18rem;'>
                    <img src='$row[image]' class='card-img-top'>
                    <div class='card-body'>
                        <h5 class='card-title'>$row[name]</h5>
                        <p class='card-text'>$row[price]</p>
                        <a href='delete.php?id=$row[id]' class='btn btn-danger'>Delete</a>
                        <a href='edit.php?id=$row[id]' class='btn btn-primary'>Edit</a>
                    </div>
                </div>
            </main>
        </center>"
    ?>
    <?php } ?>

</body>

</html>