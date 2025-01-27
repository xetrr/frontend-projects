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
    <link rel="stylesheet" href="css/style.css">
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
    <?php
    $id = $_GET["id"];
    $product = "SELECT * FROM `prod` WHERE id = $id";
    $result = mysqli_query($conn, $product);
    while ($row = mysqli_fetch_array($result)) {
        echo " 
        <form action='up.php' method='POST' enctype='multipart/form-data'>
                <input type='text' name='id' value = '$row[id]'>
                <br> 
                <img src='$row[image]' class='card-img-top' style='max-width: 600px;max-height:300px;width:fit-content'>
                <input type='text' name='name' value='$row[name]'>
                <br>
                <input type='text' name='price' value = '$row[price]'>
                <br>
                <input type='file' name='image' id='file' style='display:none'>
                <label for='file'>change image</label>
                <button name='update'>Edit ad</button>
                <br>
                <br>
                <a href='products.php'>show all products</a>
            </form>"
    ?>
    <?php } ?>


</body>

</html>