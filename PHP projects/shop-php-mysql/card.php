<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
</head>

<body>
    <?php
    include('db.php');
    $result  = mysqli_query($conn, "SELECT * FROM `cart`");
    while ($row = mysqli_fetch_array($result)) {
        echo "<center>
        <main>
            <table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>name</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Delete Product</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$row[name]</td>
                        <td>$row[price]</td>
                        <td><a href='del_card.php? id=$row[id]' class='btn btn-danger'>Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </center>" ?>
    <?php } ?>
</body>

</html>