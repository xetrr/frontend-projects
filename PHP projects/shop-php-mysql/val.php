<?php
include('db.php');
$id = $_GET["id"];
$onHold = "SELECT * FROM `prod` WHERE id = $id";
$up = mysqli_query($conn, $onHold);
$addCart = mysqli_fetch_array($up);

?>

<!DOCTYPE html>
<html lang="en">
<style>
    .none {
        display: none;
    }

    .main {
        width: 30%;
        padding: 20px;
        box-shadow: 1px 1px 10px silver;
        margin-top: 50px;
    }
</style>

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
        <h3>Cart</h3>
        <div class="main">

            <form action="insert_card.php" method="post">
                <h2>buy this product</h2>
                <input class="none" type="text" name="id" value='<?php echo $addCart['id'] ?>'>
                <input class="none" type="text" name="name" value='<?php echo $addCart['name'] ?>'>
                <input class="none" type="text" name="price" value='<?php echo $addCart['price'] ?>'>
                <button name="add" type="submit" class="btn btn-warning">Add to Cart</button>
                <br>
                <a href="shop.php">Back to shop</a>
            </form>
        </div>
    </center>
</body>

</html>