<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <center>
        <div class="main">
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <h2>Shop online</h2>
                <img src="./img/gaza.jpg" style="max-width: 600px;max-height:300px;width:fit-content" alt="image">
                <input type="text" name="name" placeholder="Product Name">
                <br>
                <input type="text" name="price" placeholder="Price">
                <br>
                <input type="file" name="image" id="file" style="display:none">
                <label for="file">upload image</label>
                <button name="upload">set ad</button>
                <br>
                <br>
                <a href="products.php">show all products</a>
            </form>
        </div>
    </center>
</body>

</html>